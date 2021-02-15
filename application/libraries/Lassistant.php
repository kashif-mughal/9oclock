<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lassistant {

    //Retrieve  assistant List  
    public function assistant_list() {
        $CI = & get_instance();
        $assistant_list = $this->last_assistant();
        $i = 0;
        $total = 0;
        $data = array(
            'title' => 'Manage Assistant',
            'assistant_list' => $assistant_list,
        );
        $assistantList = $CI->parser->parse('assistant/assistant', $data, true);
        return $assistantList;
    }

    public function last_assistant(){
        $CI = & get_instance();
        $CI->load->model('Assistants');
        $day = 1;
        $assistant_list = null;
        date_default_timezone_set('Asia/Karachi');
        while (empty($assistant_list)) {
            if(--$day == -30)
                break;
            $Date = date_format(new DateTime(), 'Y-m-d');
            $dt = date ( 'Y-m-d' , strtotime ( $Date . " $day days" ));
            $assistant_list = $CI->Assistants->search_last_assistant("CreatedOn", $dt);
        }
        //echo '<pre>'; print_r($assistant_list);die;
        if(is_null($assistant_list) || !is_array($assistant_list))
            return null;
        for ($i=0; $i < count($assistant_list); $i++) { 
            $productObject = (object) [
                                 'id' => $assistant_list[$i]['ProductId'],
                                 'pName' => $assistant_list[$i]['ProductName'],
                                 'price' => $assistant_list[$i]['SalePrice'],
                                 'img' => base_url($assistant_list[$i]['ProductImg']),
                                 'saleUnitQty' => $assistant_list[$i]['SaleUnitQty'],
                                 'saleUnit' => $assistant_list[$i]['UnitName']
                                ];

            $assistant_list[$i]["Jsn"] = htmlentities(json_encode($productObject), ENT_QUOTES, 'UTF-8');
        }
        $assistantObj = Array();
        $assistantObj["Assistant"] = Array();
        $assistantObj["Cat"] = Array();
        $assistantObj["SaleUnitQty"] = Array();
        $assistantObj["Brands"] = Array();
        $assistantObj["Tags"] = Array();
        for ($i=0; $i < count($assistant_list); $i++) { 
            if(!$assistantObj["Assistant"][$assistant_list[$i]["CatName"]])
                $assistantObj["Assistant"][$assistant_list[$i]["CatName"]] = Array();
            array_push($assistantObj["Assistant"][$assistant_list[$i]["CatName"]], $assistant_list[$i]);
            array_push($assistantObj["Cat"], $assistant_list[$i]["CatName"]);
            array_push($assistantObj["SaleUnitQty"], $assistant_list[$i]["SaleUnitQuantity"]);
            array_push($assistantObj["Brands"], $assistant_list[$i]["BrandName"]);
            if(!empty($assistant_list[$i]["tags"])){
                $tagsArr = explode(",", $assistant_list[$i]["tags"]);
                for ($j=0; $j < count($tagsArr); $j++) { 
                    array_push($assistantObj["Tags"], $tagsArr[$j]);
                }
            }
        }
        $assistantObj["Cat"] = array_unique($assistantObj["Cat"]);
        $assistantObj["Brands"] = array_unique($assistantObj["Brands"]);
        $assistantObj["Brands"] = array_filter($assistantObj["Brands"]);
        $assistantObj["SaleUnitQty"] = array_unique($assistantObj["SaleUnitQty"]);
        $assistantObj["Tags"] = array_unique($assistantObj["Tags"]);
        //echo '<pre>'; print_r($assistantObj);die;
        return $assistantObj;
    }

    //Sub assistant Add
    public function assistant_add_form() {
        $CI = & get_instance();
        $data = array(
            'title' => 'Add Assistant'
        );
        $assistantForm = $CI->parser->parse('assistant/add_assistant_form', $data, true);
        return $assistantForm;
    }

    // public function get_assistant_paginate(){
    //     $paginationConfig = $this->get_pagination_config('Cassistant/fetch_paginate');
    //     $this->pagination->initialize($paginationConfig);
    //     if(empty($this->input->get('page')))
    //         $page = 0;
    //     else
    //         $page = $this->input->get('page');
    //     $links = $this->pagination->create_links();
    //     $content = $this->lorder->view_orders($links, $paginationConfig["per_page"], $page, "order/orders","Manage Orders");
    // }

    //assistant Edit Data
    public function assistant_edit_data($AssistantId) {
        $CI = & get_instance();
        $CI->load->model('Assistants');
        $assistant_detail = $CI->Assistants->retrieve_editdata('AssistantId', $AssistantId);

        $data = array(
            'title' => 'Assistant Edit',
            'AssistantData' => $assistant_detail[0]
        );
        $chapterList = $CI->parser->parse('assistant/edit_assistant_form', $data, true);
        return $chapterList;
    }

}

?>