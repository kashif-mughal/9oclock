<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ccopun extends CI_Controller {

    public $menu;

    function __construct() {
        parent::__construct();
        $this->load->library('lcopun');
        $this->load->model('Copuns');
    }

    //Default loading for copun system.
    public function index() {
        $content = $this->lcopun->copun_add_form();
        $this->template->full_admin_html_view($content);
    }

    //Manage copun form
    public function manage_copun() {
        $content = $this->lcopun->copun_list();
        $this->template->full_admin_html_view($content);
        
    }

    //Apply copun
    public function apply_copun(){
        $copun = $this->input->post('copun');
        $ov = $this->input->post('ov');
        if(empty($copun))
        {
            print_r('{"Success": false, "Message": "Empty copun"}');
            return;
        }else{
            $copun_detail = $this->Copuns->get_copun($copun);
            if(!$copun_detail){
                print_r('{"Success": false, "Message": "Copun not found"}');
                $this->set_and_reset_copun_in_session($copun, 0, 0);
                return;
            }else{
                $copun = $copun_detail[0];
                if($copun['Infinite'] == 0){
                    // $copun['StartFrom'] = '2020-11-26 02:22:34';
                    // $copun['EndOn'] = '2020-11-29 02:22:34';;
                    if($copun['StartFrom'] == '0000-00-00 00:00:00 ' || $copun['EndOn'] == '0000-00-00 00:00:00 '){
                        print_r('{"Success": false, "Message": "Copun expired."}');
                        $this->set_and_reset_copun_in_session($copun, 0, 0);
                        return;
                    }
                    date_default_timezone_set("Asia/Karachi");
                    $start = new DateTime($copun['StartFrom']);
                    $end = new DateTime($copun['EndOn']);
                    $currentDt = new DateTime();
                    if(!($start < $currentDt && $end > $currentDt)){
                        print_r('{"Success": false, "Message": "Copun expired"}');
                        $this->set_and_reset_copun_in_session($copun, 0, 0);
                        return;
                    }
                }
                $minpurchase = empty($copun["MinPurchase"]) ? -1 : $copun["MinPurchase"];
                if($ov < $minpurchase){
                    print_r('{"Success": false, "Message": "Minimum purchase for this copun is '. $minpurchase .'"}');
                    $this->set_and_reset_copun_in_session($copun, 0, 0);
                    return;
                }
                $this->set_and_reset_copun_in_session($copun, $minpurchase, 1);
                
                print_r('{"Success": true, 
                    "Message": "Success", 
                    "Data": {
                        "copunId": '. $copun["CopunId"] .',
                        "copunDiscountType": "'. $copun["DiscountType"] .'",
                        "copunDiscountValue": '. $copun["DiscountValue"] .',
                        "copunMinPurchase": '. $minpurchase .'
                    }
                }');
                return;
            }
        }
    }
    public function empty_copun(){
        $this->set_and_reset_copun_in_session($copun, 0, 0);
        echo 1;
        return;
    }
    private function set_and_reset_copun_in_session($copun, $minpurchase, $set){
        if($set == 1){
            $this->session->set_userdata(array('copunId' => $copun['CopunId']));
            $this->session->set_userdata(array('copunName' => $copun['CopunName']));
            $this->session->set_userdata(array('copunDiscountType' => $copun['DiscountType']));
            $this->session->set_userdata(array('copunDiscountValue' => $copun['DiscountValue']));
            $this->session->set_userdata(array('copunMinPurchase' => $minpurchase));
        }else{
            $this->session->unset_userdata('copunId');
            $this->session->unset_userdata('copunName');
            $this->session->unset_userdata('copunDiscountType');
            $this->session->unset_userdata('copunDiscountValue');
            $this->session->unset_userdata('copunMinPurchase');
        }
    }
    //Insert copun and upload
    public function insert_copun() {
        if(is_null($this->input->post('Infinite'))){
            if(empty($this->input->post('StartFrom')) || empty($this->input->post('EndOn'))){
                $this->session->set_userdata(array('error_message' => 'StartFrom and EndOn are required if not Infinite'));
                redirect(base_url('Ccopun'));
                return;
            }else{
                $startDate = strtotime($this->input->post('StartFrom'));
                $endDate = strtotime($this->input->post('EndOn'));
                if($startDate > $endDate){
                    $this->session->set_userdata(array('error_message' => 'Start date should be less then End date'));
                    redirect(base_url('Ccopun'));
                    return;
                }
            }
        }
        $data = array(
            'CopunName' => $this->input->post('CopunName'),
            'StartFrom' => $this->input->post('StartFrom'),
            'EndOn' => $this->input->post('EndOn'),
            'DiscountType' => $this->input->post('DiscountType'),
            'DiscountValue' => $this->input->post('DiscountValue'),
            'MinPurchase' => $this->input->post('MinPurchase'),
            'Status' => 1
        );
        if(!is_null($this->input->post('Infinite'))){
            $data['Infinite'] = $this->input->post('Infinite');
        }
        $result = $this->Copuns->copun_entry($data);

        if ($result == TRUE) {
            $this->session->set_userdata(array('message' => 'Successfully Added'));
            if (isset($_POST['add-customer'])) {
                redirect(base_url('Ccopun/manage_copun'));
            } elseif (isset($_POST['add-customer-another'])) {
                redirect(base_url('Ccopun'));
            }
        } else {
            $this->session->set_userdata(array('error_message' => 'Something went wrong'));
            redirect(base_url('Ccopun'));
        }
    }

    //copun Update Form
    public function copun_update_form($CopunId) {
        $content = $this->lcopun->copun_edit_data($CopunId);
        $this->template->full_admin_html_view($content);
    }

    // copun Update
    public function copun_update() {
        $CopunId = $this->input->post('CopunId');
        $data = array(
            'CopunName' => $this->input->post('CopunName'),
            'ModifiedOn' => date_format(new DateTime(), 'Y-m-d H:i:s'),
            'StartFrom' => $this->input->post('StartFrom'),
            'EndOn' => $this->input->post('EndOn'),
            'DiscountType' => $this->input->post('DiscountType'),
            'DiscountValue' => $this->input->post('DiscountValue'),
            'MinPurchase' => $this->input->post('MinPurchase'),
        );
        if(!is_null($this->input->post('Infinite'))){
            $data['Infinite'] = $this->input->post('Infinite');
        }
        $this->Copuns->update($data, 'CopunId', $CopunId);
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Ccopun/manage_copun'));
    }

    // copun delete
    public function copun_delete() {
        $CopunId = $_POST['CopunId'];
        $this->Copuns->soft_delete_by_key('CopunId', $CopunId);
        return true;
    }

}
