<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cbanner extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->auth->check_admin_auth();
        $this->load->library('lsetting');
        $this->load->model('SiteSettings');    
      
      $this->load->library('lbanner');
      $this->load->model('Banner');
    }

   //Default Banner on Home Page.
    public function index() {
      $content = $this->lsetting->setting_form();

      $content = $this->lbanner->get_banners_list();
      $this->template->full_admin_html_view($content);
    }
    
    public function edit_image($id) {
      // redirect to edit page with image id and url.
      $content = $this->lsetting->setting_form();
      $content = $this->lbanner->edit_banner_image($id);
      return $this->template->full_admin_html_view($content);
    }

    // Update Image Positions
    public function update_image_list() {
      $postData = $this->input->post();
      $postDataArray = json_decode($postData['position']);

      $data = $this->Banner->update_image_orders($postDataArray);
      echo $data;
    }

    public function image_delete() {
      $image_id = $this->input->post();
      $id = json_decode($image_id['id']);
      $this->Banner->soft_delete_by_key("id", $id);
      $this->session->set_userdata(array('message' => display('successfully_delete')));
      //redirect(base_url('Cbanner'));
      return true;
    }

    //Insert Banner Image
    public function insert_banner_image() {
		$this->load->model('Banner');
      $post_data = $this->input->post();
	
      if(!$post_data["image_url"]) {
        redirect(base_url('Cbanner'));
      }

      if ($_FILES["image"]["name"]) {
        $image_path = '/assets/img/banner/' . $_FILES['image']['name'];
        // print_r($image_path);die;
        $image_exist = $this->Banner->get_image($image_path);
        if($image_exist == 0) {
          //Chapter add start
          $config['upload_path'] = './assets/img/banner/';
          $config['allowed_types'] = 'gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
          $config['max_size'] = "*";
          $config['max_width'] = "*";
          $config['max_height'] = "*";
          $config['encrypt_name'] = FALSE;

          $this->load->library('upload', $config);
          if (!$this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_userdata(array('error_message' => $this->upload->display_errors()));
            redirect(base_url('Cbanner'));
          } else {
              $image = $this->upload->data();
              $image_url = "assets/img/banner/" . $image['file_name'];
          }
          $last_image_order = $this->Banner->get_last_image_order();
          $data = array(
            'image_path' => $image_url,
            'image_url' => $post_data["image_url"],
            'image_order' => ($last_image_order[0]['image_order'])+1,
            'status' => 1
          );
            $this->db->insert('grocery_banner', $data);
            redirect(base_url('Cbanner'));
        }
        else {
          $this->Banner->update_status($image_exist[0]["id"], 1);
          redirect(base_url('Cbanner'));
        }
        
        
      } // $_FILES["image"]["name"] Ends
        
    } // Insert Banner Image End

    //Update Banner Image
    public function update_edited_banner_image() {
      $this->load->model('Banner');
      $post_data = $this->input->post();
      // print_r($post_data);
      // print_r($_FILES['image']['name']);die;
      if(!$post_data["image_url"]) {
        return false;
      }
      $image_selected = '';
      $image_exist_by_id = $this->Banner->get_image_by_id($post_data["imageId"]);
      if($image_exist_by_id) {
        // if ($_FILES['image']['name'] != $image_exist_by_id["image_url"]) {
        //   print_r($_FILES['image']['name']);die;
        //   $image_selected = '/assets/img/banner/' . $_FILES['image']['name'];
        // }
        // else {
        //   $image_selected = $image_exist_by_id["image_url"];
        // }
        //$image_exist = $this->Banner->get_image($image_path);
        
        // print_r($image_exist_by_id[0]["image_path"]);
        // $existing_image_path = str_replace('/assets/img/banner/', '', $image_exist_by_id[0]["image_path"]);
        // print_r(" |||||||||| ");
        // print_r($_FILES['image']['name']);
        // print_r(" |||||||||| ");

        if($existing_image_path != $post_data["image_path"]) {
          //Chapter add start
          $config['upload_path'] = './assets/img/banner/';
          $config['allowed_types'] = 'gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
          $config['max_size'] = "*";
          $config['max_width'] = "*";
          $config['max_height'] = "*";
          $config['encrypt_name'] = FALSE;

          $this->load->library('upload', $config);
          if (!$this->upload->do_upload('image')) {
              $error = array('error' => $this->upload->display_errors());
              $this->session->set_userdata(array('error_message' => $this->upload->display_errors()));
              redirect(base_url('Cbanner'));
          } else {
              $image = $this->upload->data();
              $image_url = "assets/img/banner/" . $image['file_name'];
          }
        }
      }
        $curr_image_path = 'assets/img/banner/' . $_FILES['image']['name'];
        $curr_image_url = $post_data["image_url"];
        $curr_image_order = $image_exist_by_id[0]["image_order"];

        $this->db->set('image_path', $curr_image_path);
        $this->db->set('image_url', $curr_image_url);
        $this->db->set('image_order', $curr_image_order);
        $this->db->set('Status', 1);
        $this->db->where('id', $post_data["imageId"]);
        $this->db->update('banner_images');
        
        redirect(base_url('Cbanner'));
    }

}