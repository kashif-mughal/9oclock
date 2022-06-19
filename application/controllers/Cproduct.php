<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cproduct extends CI_Controller {

    public $product_id;
    public $globaPerPageProducts = 100;
    function __construct() {
        parent::__construct();
        $this->load->database();
        
        $this->load->library('lproduct');
        $this->load->model('Products');
    }

    //Index page load
    public function index() {
        $this->auth->check_admin_auth();
        $content = $this->lproduct->product_add_form();
        $this->template->full_admin_html_view($content);
    }

    public function productandimage(){
        $result = $this->Products->get_product_and_image_by_name();
        $formated = [];
        for ($i=0; $i < count($result); $i++) {
            if(!$formated[strtolower($result[$i]["pName"])]["thumb"])
                $formated[strtolower($result[$i]["pName"])]["thumb"] = [];
            if(!$formated[strtolower($result[$i]["pName"])]["large"])
                $formated[strtolower($result[$i]["pName"])]["large"] = [];
            if($result[$i]["Size"])
                array_push($formated[strtolower($result[$i]["pName"])][$result[$i]["Size"]], $result[$i]["Img"]);
        }
        //echo json_encode($formated);
        //print_r(json_encode($result));
        print_r(json_encode($formated));
    }

    public function sendreportmail(){
        $message = $this->input->post("report");
        $to_email = $this->input->post("to_email");        
        $from = "admin@9oclockshop.co.uk";
        $subject = "Image upload utility Report";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: ' . '<' . $from .'>' . "\r\n";
        mail($to_email, $subject, $message, $headers);
    }
    public function uploadimage(){
        $productName = $this->input->post("prodName");
        $productName = str_replace("~~", "%", $productName);
        $imgSize = $this->input->post("imgSize");
        $pInfo = $this->lproduct->product_by_name($productName);
        $pId = 0;
        if($pInfo){
            $pId = $pInfo["ProductId"];
        }
        else{
            echo json_encode(json_decode('{"Success":0, "Message":"Product not found", "Code":1}'));
            return;
        }

        try{
            $fileNewName = 'assets2/img/products/' . md5(uniqid(mt_rand())) . '.jpg';
            $imageData = base64_decode($_POST['image']);
            $h = fopen('./' . $fileNewName , 'w');
            fwrite($h, $imageData);
            fclose($h);

            $data = array(
                'ProductId' => $pId,
                'Img' => $fileNewName,
                'Size' => $imgSize,
                'CreatedOn' => date_format(new DateTime(), 'Y-m-d H:i:s'),
                'Status' => 1
            );
            $this->Products->insert_with_last_day_previous_update($data, $pId, date_format(new DateTime(), 'Y-m-d'));
            echo json_encode(json_decode('{"Success":1, "Message":"'. $fileNewName .'", "Code":0}'));
            return;
        }
        catch(Exception $ex){
            echo json_encode(json_decode('{"Success":0, "Message":"Image Upload Error --> '. $ex->getMessage() .'", "Code":2}'));
            return;
        }
    }

    public function products($categoryId = null) {
        $catId = $this->input->get('categoryId');
        $name = $this->input->get('q');
        $name = str_replace("~~", "%", $name);
        //echo $name; die;
        $page = $this->input->get('page');
        $brand = $this->input->get('brand');
        if(empty($brand) || !is_numeric($brand))
            $brand = null;
        $perpage = $this->input->get('perpage');
        if(empty($page) || !is_numeric($page) || $page < 0)
            $page = 0;
        if(empty($perpage) || !is_numeric($perpage) || $perpage < 0)
            $perpage = $this->globaPerPageProducts;
        $content = $this->lproduct->products_by_category($catId, $name, $page, $perpage, $brand);

        $this->template->full_html_view($content);

    }
    public function fetch(){
        $catId = $this->input->get('categoryId');
        $name = $this->input->get('q');
        $name = str_replace("~~", "%", $name);
        $page = $this->input->get('page');
        $brand = $this->input->get('brand');
        if(empty($brand))
            $brand = null;
        $perpage = $this->input->get('perpage');
        if(empty($page) || !is_numeric($page) || $page < 0)
            $page = 0;
        if(empty($perpage) || !is_numeric($perpage) || $perpage < 0)
            $perpage = $this->globaPerPageProducts;
        $products = $this->lproduct->internal_products_by_category($catId, $name, $page, $perpage, $brand);
        for ($i=0; $i < count($products['products']); $i++) { 
            $productObject = (object) [
                           'id' => $products['products'][$i]['ProductId'],
                           'pName' => $products['products'][$i]['ProductName'],
                           'price' => $products['products'][$i]['SalePrice'],
                           'img' => base_url().$products['products'][$i]['Images']->Thumb[0],
                           'saleUnitQty' => $products['products'][$i]['SaleUnitQty'],
                           'saleUnit' => $products['products'][$i]['UnitName']
                       ];
                       $products['products'][$i]['Jsn'] = htmlentities(json_encode($productObject), ENT_QUOTES, 'UTF-8');
        }

        echo json_encode($products);
        return;
    }

    //Insert Product and uload
    public function insert_product() {
        //Chapter chapter add start
        $config['upload_path'] = './assets/img/products/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
        $config['max_size'] = "*";
        $config['max_width'] = "*";
        $config['max_height'] = "*";
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);


        if ($_FILES['image']['name']) {
            if (!$this->upload->do_upload('image')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_userdata(array('error_message' => $this->upload->display_errors()));
                redirect(base_url('Cproduct'));
            } else {
                $image = $this->upload->data();
                $image_url = "assets/img/products/" . $image['file_name'];
				
				$largeImageData = array(
					'ProductId'  => $product_id,
					'Img'        => $image_url,
					'Size'       => 'large',
					'ModifiedOn' => date_format(new DateTime(), 'Y-m-d H:i:s'),
					'Status'     => 1
				);

				$this->db->insert('grocery_product_images', $largeImageData);
            }
        }


        $isFeatured = ($this->input->post('IsFeatured') == 'on') ? 1 : 0;
        $isHot = ($this->input->post('IsHot') == 'on') ? 1 : 0;
        $data = array(
            'ProductName' => $this->input->post('ProductName'),
            'ParentProduct' => $this->input->post('ParentProduct'),
            'Unit' => $this->input->post('Unit'),
            'OriginalPrice' => $this->input->post('OriginalPrice'),
            'Price' => $this->input->post('Price'),
            'SalePrice' => empty($this->input->post('SalePrice')) ? $this->input->post('Price') : $this->input->post('SalePrice'),
            'IsFeatured' => $isFeatured,
            'IsHot' => $isHot,
            'Category' => $this->input->post('CategoryId'),
            'CreatedOn' => date_format(new DateTime(), 'Y-m-d H:i:s'),
            'status' => 1,
            'SaleUnitQty' => $this->input->post('SaleUnitQty'),
            'SaleUnit' => $this->input->post('SaleUnit'),
            'ProductImg' =>(!empty($image_url) ? $image_url : 'assets/img/product.png'),
            'tags' => $this->input->post('allTags'),
            'Brand' => $this->input->post('BrandId'),
            'Description' => $this->input->post('Description')
        );
        $result = $this->Products->product_entry($data);
        if (is_numeric($result)) {
            $fName = "";
            $fNames = array();
            $multipleUpload = array();

            $this->upload->initialize($config);
            if (isset($_FILES['multipleUpload'])) {
                $files = $_FILES;
                $cpt = count($_FILES ['multipleUpload'] ['name']);

                for ($i = 0; $i < $cpt; $i ++) {
                    $name = time().$files ['multipleUpload'] ['name'] [$i];
                    $_FILES ['multipleUpload'] ['name'] = $name;
                    $_FILES ['multipleUpload'] ['type'] = $files ['multipleUpload'] ['type'] [$i];
                    $_FILES ['multipleUpload'] ['tmp_name'] = $files ['multipleUpload'] ['tmp_name'] [$i];
                    $_FILES ['multipleUpload'] ['error'] = $files ['multipleUpload'] ['error'] [$i];
                    $_FILES ['multipleUpload'] ['size'] = $files ['multipleUpload'] ['size'] [$i];

                    if(!($this->upload->do_upload('multipleUpload')) || $files ['multipleUpload'] ['error'] [$i] !=0) {
                        $error = array('error' => $this->upload->display_errors());
                        $this->session->set_userdata(array('error_message' => $this->upload->display_errors()));
                        redirect(base_url('Cproduct'));
                    } else {
                        $view = $this->upload->data();
                        array_push($multipleUpload, "assets/img/products/" . $view['file_name']);
                        array_push($fNames, $name);
                    }
                }
            }
			
            $imgUrl = !empty($image_url) ? $image_url : 'assets/img/product.png';
            $data = array(
                'ProductId'  => $result,
                'Img'        => $imgUrl,
                'Size'       => 'large',
                'ModifiedOn' => date_format(new DateTime(), 'Y-m-d H:i:s'),
                'CreatedOn'  => date_format(new DateTime(), 'Y-m-d H:i:s'),
                'Status'     => 1
            );
			
            $this->db->insert('grocery_product_images', $data);
			
            if(count($multipleUpload) > 0){
                for ($i=0; $i < count($multipleUpload); $i++) { 
                    $data = array(
                        'ProductId'  => $result,
                        'Img'        => $multipleUpload[$i],
                        'Size'       => 'thumb',
                        'ModifiedOn' => date_format(new DateTime(), 'Y-m-d H:i:s'),
                        'CreatedOn'  => date_format(new DateTime(), 'Y-m-d H:i:s'),
                        'Status'     => 1
                    );

                    $this->db->insert('grocery_product_images', $data);
                }
            }
			$this->session->set_userdata(array('message' => 'Successfully Added'));
            if (isset($_POST['add-product'])) {
                redirect(base_url('Cproduct/manage_product'));
            } elseif (isset($_POST['add-customer-another'])) {
                redirect(base_url('Cproduct'));
            }
        } else {
            $this->session->set_userdata(array('error_message' => 'Already Inserted'));
            redirect(base_url('Cproduct'));
        }
    }

    //Product Update Form
    public function product_update_form($product_id) {
        $content = $this->lproduct->product_edit_data($product_id);
        $this->template->full_admin_html_view($content);
    }
    // Product Update [POST]
    public function product_update() {
        $product_id = $this->input->post('product_id');
        $config['upload_path'] = './assets/img/products/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
        $config['max_size'] = "*";
        $config['max_width'] = "*";
        $config['max_height'] = "*";
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
		$largeImageName = "";
		
        if ($_FILES['image']['name']) {
            if (!$this->upload->do_upload('image')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_userdata(array('error_message' => $this->upload->display_errors()));
                redirect(base_url('Cproduct'));
            } else {
                $image = $this->upload->data();
                $image_url = "assets/img/products/" . $image['file_name'];
				
				$largeImageData = array(
					'ProductId'  => $product_id,
					'Img'        => $image_url,
					'Size'       => 'large',
					'ModifiedOn' => date_format(new DateTime(), 'Y-m-d H:i:s'),
					'Status'     => 1
				);

				$this->db->insert('grocery_product_images', $largeImageData);	
            }
        }
		
        $fName = "";
        $fNames = array();
        $multipleUpload = array();

        $this->upload->initialize($config);
        if (isset($_FILES['multipleUpload'])) {
            $files = $_FILES;
            $cpt = count($_FILES ['multipleUpload'] ['name']);
            for ($i = 0; $i < $cpt; $i ++) {
                if(empty($files ['multipleUpload'] ['name'] [$i]))
                    continue;
                $name = time().$files ['multipleUpload'] ['name'] [$i];
                $_FILES ['multipleUpload'] ['name'] = $name;
                $_FILES ['multipleUpload'] ['type'] = $files ['multipleUpload'] ['type'] [$i];
                $_FILES ['multipleUpload'] ['tmp_name'] = $files ['multipleUpload'] ['tmp_name'] [$i];
                $_FILES ['multipleUpload'] ['error'] = $files ['multipleUpload'] ['error'] [$i];
                $_FILES ['multipleUpload'] ['size'] = $files ['multipleUpload'] ['size'] [$i];

                if(!($this->upload->do_upload('multipleUpload')) || $files ['multipleUpload'] ['error'] [$i] !=0) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_userdata(array('error_message' => $this->upload->display_errors()));
                    redirect(base_url('Cproduct'));
                } else {
                    $view = $this->upload->data();
                    array_push($multipleUpload, "assets/img/products/" . $view['file_name']);
                    array_push($fNames, $name);
                }
            }
        }

		//print_r($multipleUpload);die;
        if(count($multipleUpload) > 0){
            for ($i=0; $i < count($multipleUpload); $i++) { 
                $data = array(
                    'ProductId'  => $product_id,
                    'Img'        => $multipleUpload[$i],
                    'Size'       => 'thumb',
                    'ModifiedOn' => date_format(new DateTime(), 'Y-m-d H:i:s'),
                    'Status'     => 1
                );

                $this->db->insert('grocery_product_images', $data);
            }
        }

        $this->load->model('Products');
        $isFeatured = ($this->input->post('isFeatured') == 1) ? 1 : 0;
        $isHot = ($this->input->post('isHot') == 1) ? 1 : 0;
        $status = ($this->input->post('status') == 1) ? 1 : 0;
        $data = array(
            'ProductName' => $this->input->post('product_name'),
            'ParentProduct' => $this->input->post('ParentProduct'),
            'Unit' => $this->input->post('Unit'),
            'OriginalPrice' => $this->input->post('OriginalPrice'),
            'Price' => $this->input->post('price'),
            'SalePrice' => empty($this->input->post('SalePrice')) ? $this->input->post('Price') : $this->input->post('SalePrice'),
            'IsFeatured' => $isFeatured,
            'IsHot' => $isHot,
            'Category' => $this->input->post('CategoryId'),
            'Status' => $status,
            'Brand' => $this->input->post('BrandId'),
            'SaleUnitQty' => $this->input->post('SaleUnitQty'),
            'SaleUnit' => $this->input->post('SaleUnit'),
            'ModifiedOn' => date_format(new DateTime(), 'Y-m-d H:i:s'),
            'tags' => $this->input->post('allTags'),
            'stock' => $this->input->post('stock'),
            'season' => $this->input->post('season'),
            'sort' => $this->input->post('sort'),
            'Description' => $this->input->post('Description')
            //'status' => $this->input->post('status')
        );
        if($_FILES['image']['name'])
            $data['ProductImg'] = (!empty($image_url) ? $image_url : 'assets/img/product.png');
        $this->Products->update($data, 'ProductId', $product_id);
        
        if($_FILES['image']['name']){
            $data = array(
                'Img'        => (!empty($image_url) ? $image_url : 'assets/img/product.png'),
                'ModifiedOn' => date_format(new DateTime(), 'Y-m-d H:i:s')
            );
            $this->db->where('ProductId', $product_id);
            $this->db->where('Size', 'large');
            $this->db->update('grocery_product_images', $data);
        }
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Cproduct/manage_product'));
    }
    public function manage_product() {
        $CI = & get_instance();
        
        $this->auth->check_admin_auth();
        
        $CI->load->library('lproduct');
        
        $content = $this->lproduct->product_list();
        
        $this->template->full_admin_html_view($content);
    }

    public function del_img(){
        $this->auth->check_admin_auth();
        $imgUrl = $this->input->get("imgNm");
        $data = array(
            'Status' => 0
        );
        $this->db->where('Img', $imgUrl);
        $this->db->update('grocery_product_images', $data);
        echo '1';
    }
    //Add Product CSV
    public function add_product_csv() {
        $CI = & get_instance();
        $data = array(
            'title' => display('add_product_csv')
        );
        $content = $CI->parser->parse('product/add_product_csv', $data, true);
        $this->template->full_admin_html_view($content);
    }

    //CSV Upload File
    function uploadCsv() {
        $product_id = $this->generator(8);
        $count = 0;
        $fp = fopen($_FILES['upload_csv_file']['tmp_name'], 'r') or die("can't open file");

        if (($handle = fopen($_FILES['upload_csv_file']['tmp_name'], 'r')) !== FALSE) {

            while ($csv_line = fgetcsv($fp, 1024)) {
                //keep this if condition if you want to remove the first row
                for ($i = 0, $j = count($csv_line); $i < $j; $i++) {
                    $insert_csv = array();
                    $insert_csv = array();
                    $insert_csv['product_id'] = (!empty($csv_line[0]) ? $csv_line[0] : null);
                    $insert_csv['supplier_id'] = (!empty($csv_line[1]) ? $csv_line[1] : null);
                    $insert_csv['category_id'] = (!empty($csv_line[2]) ? $csv_line[2] : null);
                    $insert_csv['product_name'] = (!empty($csv_line[3]) ? $csv_line[3] : null);
                    $insert_csv['price'] = (!empty($csv_line[4]) ? $csv_line[4] : null);
                    $insert_csv['supplier_price'] = (!empty($csv_line[5]) ? $csv_line[5] : null);
                    $insert_csv['unit'] = (!empty($csv_line[6]) ? $csv_line[6] : null);
                    $insert_csv['tax'] = (!empty($csv_line[7]) ? $csv_line[7] : null);
                    $insert_csv['product_model'] = (!empty($csv_line[8]) ? $csv_line[8] : null);
                    $insert_csv['product_details'] = (!empty($csv_line[9]) ? $csv_line[9] : null);
                    $insert_csv['image'] = (!empty($csv_line[10]) ? $csv_line[10] : null);
                    $insert_csv['status'] = (!empty($csv_line[11]) ? $csv_line[11] : null);
                }


                $data = array(
                    'product_id' => $insert_csv['product_id'],
                    'category_id' => $insert_csv['category_id'],
                    'product_name' => $insert_csv['product_name'],
                    'price' => $insert_csv['price'],
                    'unit' => $insert_csv['unit'],
                    'tax' => $insert_csv['tax'],
                    'product_model' => $insert_csv['product_model'],
                    'product_details' => $insert_csv['product_details'],
                    'image' => $insert_csv['image'],
                    'status' => $insert_csv['status']
                );
                $supp_prd = array(
                    'product_id' => $insert_csv['product_id'],
                    'supplier_id' => $insert_csv['supplier_id'],
                    'supplier_price' => $insert_csv['supplier_price'],
                    'products_model' => $insert_csv['product_model'],
                );

                if ($count > 0) {

                    $splprd = $this->db->select('*')
                    ->from('supplier_product')
                    ->where('supplier_id', $supp_prd['supplier_id'])
                    ->where('products_model', $supp_prd['product_model'])
                    ->get()
                    ->num_rows();

                    if ($splprd == 0) {
                        $this->db->insert('supplier_product', $supp_prd);
                    } else {
                        $supp_prd = array(
                            'supplier_id' => $insert_csv['supplier_id'],
                            'supplier_price' => $insert_csv['supplier_price'],
                            'products_model' => $insert_csv['product_model']
                        );
                        $this->db->where('products_model', $supp_prd['product_model']);
                        $this->db->where('supplier_id', $supp_prd['supplier_id']);
                        $this->db->update('supplier_product', $supp_prd);
                    }
                    $result = $this->db->select('*')
                    ->from('product_information')
                    ->where('product_model', $data['product_model'])
                    ->get()
                    ->num_rows();
                    if ($result == 0 && !empty($data['product_model'])) {

                        $this->db->insert('product_information', $data);


                        $this->db->select('*');
                        $this->db->from('product_information');
                        $this->db->where('status', 1);
                        $query = $this->db->get();
                        foreach ($query->result() as $row) {
                            $json_product[] = array('label' => $row->product_name . "-(" . $row->product_model . ")", 'value' => $row->product_id);
                        }
                        $cache_file = './my-assets/js/admin_js/json/product.json';
                        $productList = json_encode($json_product);
                        file_put_contents($cache_file, $productList);
                    } else {

                        $data = array(
                            'category_id' => $insert_csv['category_id'],
                            'product_name' => $insert_csv['product_name'],
                            'price' => $insert_csv['price'],
                            'unit' => $insert_csv['unit'],
                            'tax' => $insert_csv['tax'],
                            'product_model' => $insert_csv['product_model'],
                            'product_details' => $insert_csv['product_details'],
                            'image' => (!empty($insert_csv['image']) ? $insert_csv['image'] : base_url('my-assets/image/product.png')),
                            'status' => $insert_csv['status']
                        );
                        $this->db->where('product_model', $data['product_model']);
                        $this->db->update('product_information', $data);
                        $this->db->select('*');
                        $this->db->from('product_information');
                        $this->db->where('status', 1);
                        $query = $this->db->get();
                        foreach ($query->result() as $row) {
                            $json_product[] = array('label' => $row->product_name . "-(" . $row->product_model . ")", 'value' => $row->product_id);
                        }
                        $cache_file = './my-assets/js/admin_js/json/product.json';
                        $productList = json_encode($json_product);
                        file_put_contents($cache_file, $productList);
                    }
                }
                $count++;
            }
        }
        fclose($fp) or die("can't close file");
        $this->session->set_userdata(array('message' => display('successfully_added')));
        redirect(base_url('Cproduct/manage_product'));
    }
    public function product_delete() {
        $product_id = $_POST['product_id'];
        $this->Products->soft_delete_by_key("ProductId", $product_id);
        $this->session->set_userdata(array('message' => display('successfully_delete')));
        return true;
    }
    //Retrieve Single Item  By Search
    public function product_details($product_id) {
        $this->product_id = $product_id;
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('lproduct');
        $content = $CI->lproduct->product_details($product_id);
        $this->template->full_admin_html_view($content);
    }
    public function exportCSV() {
        // file name 
        $this->load->model('Products');
        $filename = 'product_' . date('Ymd') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
        $usersData = $this->Products->product_csv_file();
        $file = fopen('php://output', 'w');
        $header = array('product_id', 'supplier_id', 'category_id', 'product_name', 'price', 'supplier_price', 'unit', 'tax', 'product_model', 'product_details', 'image', 'status');
        fputcsv($file, $header);
        foreach ($usersData as $line) {
            fputcsv($file, $line);
        }
        fclose($file);
        exit;
    }
    
    public function viewProduct($id) {
        $content = $this->lproduct->product_inner_data($id);
        $this->template->full_html_view($content);
    }

}
