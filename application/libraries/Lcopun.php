<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Lcopun {



    //Retrieve  copun List	

    public function copun_list() {

        $CI = & get_instance();

        $CI->load->model('Copuns');

        $copun_list = $CI->Copuns->_list("ModifiedOn");  //It will get only Credit copuns

        $i = 0;

        $total = 0;

        if (!empty($copun_list)) {

            foreach ($copun_list as $k => $v) {

                $i++;

                $copun_list[$k]['sl'] = $i + $CI->uri->segment(3);
                if($copun_list[$k]['StartFrom'] != '0000-00-00 00:00:00')
                {
                    $copun_list[$k]['StartFrom'] = date('Y-m-d', strtotime($copun_list[$k]['StartFrom']));
                }else{
                    $copun_list[$k]['StartFrom'] = "N/A";
                }
                if($copun_list[$k]['EndOn'] != '0000-00-00 00:00:00')
                {
                    $copun_list[$k]['EndOn'] = date('Y-m-d', strtotime($copun_list[$k]['EndOn']));
                }else{
                    $copun_list[$k]['EndOn'] = "N/A";
                }
                if($copun_list[$k]['Infinite'] == 0)
                {
                    $copun_list[$k]['Infinite'] = "No";
                }else{
                    $copun_list[$k]['Infinite'] = "Yes";
                }
                if(is_null($copun_list[$k]['MinPurchase']))
                {
                    $copun_list[$k]['MinPurchase'] = "N/A";
                }
            }

        }
        $data = array(

            'title' => 'Manage Copun',

            'copun_list' => $copun_list,

        );

        $copunList = $CI->parser->parse('copun/copun', $data, true);

        return $copunList;

    }



    //Sub copun Add

    public function copun_add_form() {

        $CI = & get_instance();

        $data = array(

            'title' => 'Add copun'

        );

        $copunForm = $CI->parser->parse('copun/add_copun_form', $data, true);

        return $copunForm;

    }



    //copun Edit Data

    public function copun_edit_data($CopunId) {

        $CI = & get_instance();
        $CI->load->model('Copuns');
        $copun_detail = $CI->Copuns->retrieve_editdata('CopunId', $CopunId);

        $data = array(
            'title' => 'Copun Edit',
            'CopunData' => $copun_detail[0]
        );
        $chapterList = $CI->parser->parse('copun/edit_copun_form', $data, true);
        return $chapterList;
    }

}



?>