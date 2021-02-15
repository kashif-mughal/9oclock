<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lvalue {

    //Retrieve  value List  
    public function value_list() {
        $CI = & get_instance();
        $value_list = $this->last_value();
        $i = 0;
        $total = 0;
        $data = array(
            'title' => 'Manage Value',
            'value_list' => $value_list,
        );
        $valueList = $CI->parser->parse('value/value', $data, true);
        return $valueList;
    }

    public function last_value(){
        $CI = & get_instance();
        $CI->load->model('Values');
        $day = 1;
        $value_list = null;
        date_default_timezone_set('Asia/Karachi');
        while (empty($value_list)) {
            if(--$day == -30)
                break;
            $Date = date_format(new DateTime(), 'Y-m-d');
            $dt = date ( 'Y-m-d' , strtotime ( $Date . " $day days" ));
            $value_list = $CI->Values->search_last_value("CreatedOn", $dt);
        }
        if(is_null($value_list) || !is_array($value_list))
            return null;
        for ($i=0; $i < count($value_list); $i++) { 
            $productObject = (object) [
                                 'id' => $value_list[$i]['ProductId'],
                                 'pName' => $value_list[$i]['ProductName'],
                                 'price' => $value_list[$i]['SalePrice'],
                                 'img' => base_url($value_list[$i]['ProductImg'])
                                ];

            $value_list[$i]["Jsn"] = htmlentities(json_encode($productObject), ENT_QUOTES, 'UTF-8');
        }
        $valueObj = Array();
        $valueObj["Value"] = Array();
        $valueObj["Cat"] = Array();
        $valueObj["SaleUnitQty"] = Array();
        $valueObj["Brands"] = Array();
        $valueObj["Tags"] = Array();
        for ($i=0; $i < count($value_list); $i++) { 
            if(!$valueObj["Value"][$value_list[$i]["CatName"]])
                $valueObj["Value"][$value_list[$i]["CatName"]] = Array();
            array_push($valueObj["Value"][$value_list[$i]["CatName"]], $value_list[$i]);
            array_push($valueObj["Cat"], $value_list[$i]["CatName"]);
            array_push($valueObj["SaleUnitQty"], $value_list[$i]["SaleUnitQuantity"]);
            array_push($valueObj["Brands"], $value_list[$i]["BrandName"]);
            if(!empty($value_list[$i]["tags"])){
                $tagsArr = explode(",", $value_list[$i]["tags"]);
                for ($j=0; $j < count($tagsArr); $j++) { 
                    array_push($valueObj["Tags"], $tagsArr[$j]);
                }
            }
        }
        $valueObj["Cat"] = array_unique($valueObj["Cat"]);
        $valueObj["Brands"] = array_unique($valueObj["Brands"]);
        $valueObj["Brands"] = array_filter($valueObj["Brands"]);
        $valueObj["SaleUnitQty"] = array_unique($valueObj["SaleUnitQty"]);
        $valueObj["Tags"] = array_unique($valueObj["Tags"]);
        //echo '<pre>'; print_r($valueObj);die;
        return $valueObj;
    }

    //Sub value Add
    public function value_add_form() {
        $CI = & get_instance();
        $data = array(
            'title' => 'Add Value'
        );
        $valueForm = $CI->parser->parse('value/add_value_form', $data, true);
        return $valueForm;
    }

    // public function get_value_paginate(){
    //     $paginationConfig = $this->get_pagination_config('Cvalue/fetch_paginate');
    //     $this->pagination->initialize($paginationConfig);
    //     if(empty($this->input->get('page')))
    //         $page = 0;
    //     else
    //         $page = $this->input->get('page');
    //     $links = $this->pagination->create_links();
    //     $content = $this->lorder->view_orders($links, $paginationConfig["per_page"], $page, "order/orders","Manage Orders");
    // }

    //value Edit Data
    public function value_edit_data($ValueId) {
        $CI = & get_instance();
        $CI->load->model('Values');
        $value_detail = $CI->Values->retrieve_editdata('ValueId', $ValueId);

        $data = array(
            'title' => 'Value Edit',
            'ValueData' => $value_detail[0]
        );
        $chapterList = $CI->parser->parse('value/edit_value_form', $data, true);
        return $chapterList;
    }

}

?>