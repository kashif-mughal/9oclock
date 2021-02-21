<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');

class Lbanner {

    public function get_banners_list() {
        $CI = & get_instance();
        $CI->load->model('SiteSettings');
        $CI->load->model('Categories');
        $CI->load->model('Banner');
        $categories = $CI->Categories->parent_category_seeting();
        $setting_detail = $CI->SiteSettings->retrieve_editdata('setting_id', $SettingId);
        $banner = $CI->Banner->get_banners();

        $data = array(
            'title' => 'Home Banner',
            'SettingData' => $setting_detail[0],
            'categories' => $categories,
            'banner' => $banner
        );
        $bannerList = $CI->parser->parse('banner/manage_banner', $data, true);
        return $bannerList;
    }

    public function edit_banner_image($id) {
        $CI = & get_instance();
        $CI->load->model('SiteSettings');
        $CI->load->model('Categories');
        $CI->load->model('Banner');
        $categories = $CI->Categories->parent_category_seeting();
        $setting_detail = $CI->SiteSettings->retrieve_editdata('setting_id', $SettingId);
        $banner = $CI->Banner->get_image_by_id($id);
        
        $data = array(
            'title' => 'Edit Banner',
            'SettingData' => $setting_detail[0],
            'categories' => $categories,
            'bannerImage' => $banner
        );
        $banner_image = $CI->parser->parse('banner/edit_banner', $data, true);
        return $banner_image;
    }


}

?>