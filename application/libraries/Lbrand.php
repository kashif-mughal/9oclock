<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Lbrand {



    //Retrieve  brand List	

    public function brand_list() {

        $CI = & get_instance();

        $CI->load->model('Brands');

        $brand_list = $CI->Brands->_list();  //It will get only Credit brands

        $i = 0;

        $total = 0;

        if (!empty($brand_list)) {

            foreach ($brand_list as $k => $v) {

                $i++;

                $brand_list[$k]['sl'] = $i + $CI->uri->segment(3);
                if(empty($brand_list[$k]['ParentName']))
                {
                    $brand_list[$k]['ParentName'] = 'None';
                }

            }

        }
        $data = array(

            'title' => 'Manage Brand',

            'brand_list' => $brand_list,

        );

        $brandList = $CI->parser->parse('brand/brand', $data, true);

        return $brandList;

    }



    //Sub brand Add

    public function brand_add_form() {

        $CI = & get_instance();

        $CI->load->model('Brands');
        $data = array(

            'title' => 'Add brand'

        );

        $brandForm = $CI->parser->parse('brand/add_brand_form', $data, true);

        return $brandForm;

    }



    //brand Edit Data

    public function brand_edit_data($BrandId) {

        $CI = & get_instance();

        $CI->load->model('Brands');

        $brand_detail = $CI->Brands->retrieve_editdata('BrandId', $BrandId);


        $data = array(

            'title' => 'Brand Edit',

            'BrandData' => $brand_detail[0]

        );

        $chapterList = $CI->parser->parse('brand/edit_brand_form', $data, true);

        return $chapterList;

    }



}



?>