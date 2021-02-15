<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Lsetting {

    public function setting_form($SettingId = 1) {
        $CI = & get_instance();
        $CI->load->model('SiteSettings');
        $CI->load->model('Categories');
        $categories = $CI->Categories->parent_category_seeting();
        $setting_detail = $CI->SiteSettings->retrieve_editdata('setting_id', $SettingId);

        $data = array(
            'title' => 'Site Setting',
            'SettingData' => $setting_detail[0],
            'categories' => $categories
        );
        $chapterList = $CI->parser->parse('setting/edit_site_setting', $data, true);
        return $chapterList;

    }
}

?>