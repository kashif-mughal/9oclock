<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cunit extends CI_Controller {

    public $menu;

    function __construct() {
        parent::__construct();
        $this->auth->check_admin_auth();
        $this->load->library('lunit');
        $this->load->model('Units');
    }

    //Default loading for unit system.
    public function index() {
        $content = $this->lunit->unit_add_form();
        $this->template->full_admin_html_view($content);
    }

    //Manage unit form
    public function manage_unit() {
        $content = $this->lunit->unit_list();
        $this->template->full_admin_html_view($content);
        
    }

    //Insert unit and upload
    public function insert_unit() {

        $data = array(
            'UnitName' => $this->input->post('UnitName'),
            'CreatedOn' => date_format(new DateTime(), 'Y-m-d H:i:s'),
            'Status' => 1
        );

        $result = $this->Units->unit_entry($data);

        if ($result == TRUE) {
            $this->session->set_userdata(array('message' => 'Successfully Added'));
            if (isset($_POST['add-customer'])) {
                redirect(base_url('Cunit/manage_unit'));
            } elseif (isset($_POST['add-customer-another'])) {
                redirect(base_url('Cunit'));
            }
        } else {
            $this->session->set_userdata(array('error_message' => 'Already Inserted'));
            redirect(base_url('Cunit'));
        }
    }

    //unit Update Form
    public function unit_update_form($unitId) {
        $content = $this->lunit->unit_edit_data($unitId);
        $this->template->full_admin_html_view($content);
    }

    // unit Update
    public function unit_update() {
        $unitId = $this->input->post('UnitId');
        $data = array(
            'UnitName' => $this->input->post('UnitName')
        );
        $this->Units->update($data, 'UnitId', $unitId);
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Cunit/manage_unit'));
    }

    // unit delete
    public function unit_delete() {
        $unitId = $_POST['UnitId'];
        $this->Units->soft_delete_by_key('UnitId', $unitId);
        return true;
    }

}
