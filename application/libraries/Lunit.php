<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lunit {

    //Retrieve  unit List  
    public function unit_list() {
        $CI = & get_instance();
        $CI->load->model('Units');
        $unit_list = $CI->Units->_list();  //It will get only Credit units
        $i = 0;
        $total = 0;
        if (!empty($unit_list)) {
            foreach ($unit_list as $k => $v) {
                $i++;
                $unit_list[$k]['sl'] = $i + $CI->uri->segment(3);
            }
        }
        $data = array(
            'title' => 'Manage Unit',
            'unit_list' => $unit_list,
        );
        $unitList = $CI->parser->parse('unit/unit', $data, true);
        return $unitList;
    }

    //Sub unit Add
    public function unit_add_form() {
        $CI = & get_instance();
        $data = array(
            'title' => 'Add Unit'
        );
        $unitForm = $CI->parser->parse('unit/add_unit_form', $data, true);
        return $unitForm;
    }

    //unit Edit Data
    public function unit_edit_data($UnitId) {
        $CI = & get_instance();
        $CI->load->model('Units');
        $unit_detail = $CI->Units->retrieve_editdata('UnitId', $UnitId);

        $data = array(
            'title' => 'Unit Edit',
            'UnitData' => $unit_detail[0]
        );
        $chapterList = $CI->parser->parse('unit/edit_unit_form', $data, true);
        return $chapterList;
    }

}

?>