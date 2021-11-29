<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products extends CI_Model {

    public function __construct() {
        parent::__construct('grocery_products');
    }
    private $tableName = 'grocery_products';
    //Count Product
    public function count_product() {
        return $this->db->count_all("product_information");
    }

    private function product_data_after_varient_sort($returnData){
        $tempProducts = array();
        for ($i=0; $i < count($returnData); $i++) { 
            $key = array_search($returnData[$i]['ParentProduct'], array_column($tempProducts, 'ProductId'));
            if($key === false){
                $returnData[$i]['VarientData'] = null;
                if(!empty($returnData[$i]['VName'])){
                    $returnData[$i]['VarientData'] = array();
                    array_push($returnData[$i]['VarientData'], array(
                        'VId' => $returnData[$i]['VId'],
                        'VName' => $returnData[$i]['VName'],
                        'VImage' => $returnData[$i]['VImage'],
                        'VValue' => $returnData[$i]['VPrice'],
                        'VPId' => $returnData[$i]['VParent']
                    ));
                }
                array_push($tempProducts, $returnData[$i]);
                //print_r($tempProducts);die;
            }else{
                if(!empty($returnData[$i]['VName'])){
                    array_push($tempProducts[$key]['VarientData'], array(
                        'VId' => $returnData[$i]['VId'],
                        'VName' => $returnData[$i]['VName'],
                        'VImage' => $returnData[$i]['VImage'],
                        'VValue' => $returnData[$i]['VPrice'],
                        'VPId' => $returnData[$i]['VParent']
                    ));
                }
            }
        }
        $returnData = $tempProducts;
        return $returnData;
    }

    public function get_product_and_image_by_name(){
        $this->db->select("gp.ProductName, REPLACE(gp.ProductName, ' ', '') pName, gpi.Img, gpi.Size");
        $this->db->from($this->tableName." gp");
        $this->db->join("grocery_product_images gpi", "gpi.ProductId = gp.ProductId", 'left');
        $this->db->where("gp.Status", 1);
        $this->db->where("gpi.Status", 1);
        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function insert_with_last_day_previous_update($data, $productId, $dt){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->db->insert('grocery_product_images', $data);
        $st = array(
            'Status' => 0
        );
        $this->db->where("ProductId", $productId);
        $this->db->where("CreatedOn < '". $dt ."'");
        $this->db->update('grocery_product_images', $st);
    }

    //Product List
    public function product_list() {

        $query = "SELECT gpv.ProductId VId, gpv.ProductName VName, gpv.ProductImg VImage, gpv.ParentProduct VParent, gpv.SalePrice VPrice, p.ProductId, p.ProductName, c.CatName, p.Unit, p.Price, p.SalePrice, p.ModifiedOn,
                        CASE WHEN p.IsFeatured = 0 THEN 'No' ELSE 'YES' END AS IsFeatured,
                        CASE WHEN p.IsHot = 0 THEN 'No' ELSE 'YES' END AS IsHot, 
                        -- p.IsFeatured, p.IsHot,
                        p.ProductImg from grocery_products p 
                        join grocery_category c on p.Category = c.CategoryId 
                        LEFT JOIN grocery_products gpv on gpv.ParentProduct = p.ProductId
                        where c.Status = 1 AND p.Status = 1 order by p.ModifiedOn, gpv.ParentProduct desc";
        $query = $this->db->query($query);

        if ($query->num_rows() > 0) {
            //echo '<pre>';print_r($this->product_data_after_varient_sort($query->result_array()));die;
            return $this->product_data_after_varient_sort($query->result_array());
            //return $query->result_array();
        }
        return false;
    }

    public function get_featured_and_products() {
        $query = "SELECT ts.QuantityAvailable, gpv.ProductId VId, gpv.ProductName VName, gpv.ProductImg VImage, gpv.ParentProduct VParent, gpv.SalePrice VPrice, gc.Alias catAlias, gp.*, gu2.UnitName SaleUnitName, CASE WHEN gp.Unit > 0 THEN gu.UnitName ELSE 'KG' END AS UnitName 
        from grocery_products gp join grocery_category gc on gp.Category = gc.CategoryId 
        left join grocery_unit gu on gp.Unit = gu.UnitId 
        left join grocery_unit gu2 on gp.SaleUnit = gu2.UnitId
        LEFT JOIN grocery_products gpv on gpv.ParentProduct = gp.ProductId
        LEFT JOIN tblstock ts on gp.ProductId = ts.ItemId
        where (gp.IsFeatured = 1 OR gp.IsHot = 1) and gc.Status = 1 and gp.Status = 1 order by gp.ModifiedOn, gp.ParentProduct DESC Limit 20";

        $query = $this->db->query($query);
//echo 'kashif123<pre>'; print_r($query->result_array());die;
        if ($query->num_rows() > 0) {
            //echo 'kashif<pre>'; print_r($this->product_data_after_varient_sort($query->result_array()));die;
            return $this->product_data_after_varient_sort($query->result_array());
        }
        return false;
    }

    public function getProductFromCatAndAllSubCats($catID) {
                
    }

    public function all_product_list() {

        $this->db->select('p.ProductId, p.ProductName, c.CatName, p.Unit, p.Price, p.SalePrice, p.ModifiedOn,
                         p.IsFeatured, p.IsHot');
        $this->db->from('grocery_products p');
        $this->db->join('grocery_category c', 'p.Category=c.Id');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function product_list_for_dropdown() {
        $query = $this->db->select('product_model, product_id, product_name')
                ->from('product_information')
                ->where('sub_product', '0')
                ->order_by('product_information.product_id', 'desc')
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }


    //Product List
    public function product_list_count() {

         $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->where('Status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

    //Product tax list
    public function retrieve_product_tax() {
        $result = $this->db->select('*')
                ->from('tax_information')
                ->get()
                ->result();

        return $result;
    }

    //Tax selected item
    public function tax_selected_item($tax_id) {
        $result = $this->db->select('*')
                ->from('tax_information')
                ->where('tax_id', $tax_id)
                ->get()
                ->result();

        return $result;
    }

    //Product generator id check 
    public function product_id_check($product_id) {
        $query = $this->db->select('*')
                ->from('product_information')
                ->where('product_id', $product_id)
                ->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Count Product
    public function product_entry($data) {
        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->where('Status', 1);
        $this->db->where('ProductName', $data['ProductName']);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            $this->db->insert($this->tableName, $data);
            return $this->db->insert_id();
        }
    }
    //Adding product varient
    public function insert_grocery_product_varient($data){
        $this->db->insert('grocery_product_varient', $data);
    }
    //Removing product varient
    public function remove_grocery_product_varient($ProductId){
        $this->db->where('ProductId', $ProductId);
        $this->db->delete('grocery_product_varient');
        return true;
    }

    // Supplier product information
    public function supplier_product_editdata($product_id) {
        $this->db->select('a.*,b.*');
        $this->db->from('supplier_product a');
        $this->db->join('supplier_information b', 'a.supplier_id=b.supplier_id');
        $this->db->where('a.product_id', $product_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

//selected supplier product
    public function supplier_selected($product_id) {
        $this->db->select('*');
        $this->db->from('supplier_product');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Retrieve company Edit Data
    public function retrieve_company() {
        $this->db->select('*');
        $this->db->from('company_information');
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Product By Search 
    public function product_search_item($product_id) {

        $query = $this->db->select('product_information.product_id p_id, supplier_information.*,product_information.*,supplier_product.*')
                ->from('product_information')
                ->join('supplier_product', 'product_information.product_id = supplier_product.product_id', 'left')
                ->join('supplier_information', 'supplier_product.supplier_id = supplier_information.supplier_id', 'left')
                ->order_by('product_information.product_id', 'desc')
                ->where('product_information.product_id', $product_id)
                ->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Duplicate Entry Checking 
    public function product_model_search($product_model) {
        $this->db->select('*');
        $this->db->from('product_information');
        $this->db->where('product_model', $product_model);
        $query = $this->db->get();
        return $this->db->affected_rows();
    }

    //Product Details
    public function product_details_info($product_id) {
        $this->db->select('*');
        $this->db->from('product_information');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // Product Purchase Report
    public function product_purchase_info($product_id) {
        $this->db->select('a.*,b.*,sum(b.quantity) as quantity,sum(b.total_amount) as total_amount,c.supplier_name');
        $this->db->from('product_purchase a');
        $this->db->join('product_purchase_details b', 'b.purchase_id = a.purchase_id');
        $this->db->join('supplier_information c', 'c.supplier_id = a.supplier_id');
        $this->db->where('b.product_id', $product_id);
        $this->db->order_by('a.purchase_id', 'asc');
        $this->db->group_by('a.purchase_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // Invoice Data for specific data
    public function invoice_data($product_id) {
        $this->db->select('a.*,b.*,c.customer_name');
        $this->db->from('invoice a');
        $this->db->join('invoice_details b', 'b.invoice_id = a.invoice_id');
        $this->db->join('customer_information c', 'c.customer_id = a.customer_id');
        $this->db->where('b.product_id', $product_id);
        $this->db->order_by('a.invoice_id', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function previous_stock_data($product_id, $startdate) {

        $this->db->select('date,sum(quantity) as quantity');
        $this->db->from('product_report');
        $this->db->where('product_id', $product_id);
        $this->db->where('date <=', $startdate);
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

// Invoice Data for specific data
    public function invoice_data_supplier_rate($product_id, $startdate, $enddate) {

        $this->db->select('
                    date,
                    sum(quantity) as quantity,
                    rate,
                    -rate*sum(quantity) as total_price,
                    account
                ');

        $this->db->from('product_report');
        $this->db->where('product_id', $product_id);

        $this->db->where('date >=', $startdate);
        $this->db->where('date <=', $enddate);

        $this->db->group_by('account');
        $this->db->order_by('date', 'asc');
        $query = $this->db->get();
        //echo $this->db->last_query();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // csv export info
    public function product_csv_file() {
        $query = $this->db->select('a.product_id,b.supplier_id,a.category_id,a.product_name,a.price,b.supplier_price,a.unit,a.tax,a.product_model,a.product_details,a.image,a.status')
                ->from('product_information a')
                ->join('supplier_product b', 'a.product_id = b.product_id', 'left')
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function update_cache_file(){
        $query = $this->db->query("SELECT * from product_information where sub_product <> '0' and status <> 0");
        foreach ($query->result() as $row) {
            $json_product[] = array('label' => "(". $row->product_id .")-" . $row->product_name, 'value' => $row->product_id, 'sub_product' => $row->sub_product, 'product_uuid' => $row->product_uuid);
        }
        $cache_file = './my-assets/js/admin_js/json/product.json';
        $productList = json_encode($json_product);
        file_put_contents($cache_file, $productList);
    }
    public function search($q, $fromTable, $limit = 10){
        $currentDate = date_format(new DateTime(), 'Y-m-d');
        $query = "SELECT gp.*, gc.CatName from grocery_products gp join grocery_category gc on gp.category = gc.CategoryId where gp.ProductId NOT IN(SELECT ProductId from $fromTable ga WHERE ga.CreatedOn = '$currentDate' AND ga.Status = 1) AND gp.Status = 1 AND gc.Status = 1 AND gp.ProductName like('%$q%') limit $limit";
        $query = $this->db->query($query);
        
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_value_cart_products($userId = null){
        if(is_null($userId)){
            $userId = $this->session->userdata('user_id');
        }
        if(empty($userId))
            return false;
        $this->db->select("gp.*, god.ItemQuantity, gu.UnitName");
        $this->db->from($this->tableName." gp");
        $this->db->join("grocery_order_detail god", "god.ItemId = gp.ProductId");
        $this->db->join("grocery_order go", "go.OrderId = god.OrderId");
        $this->db->join("grocery_unit gu", "gu.UnitId = gp.Unit");
        $this->db->where("go.CustomerId", $userId);
        $this->db->where("gp.Status", 1);
        $this->db->where("god.Status", 1);
        $this->db->where("go.Status", 1);
        $this->db->distinct("gp.ProductName");
        $this->db->order_by("go.CreatedOn", "DESC");

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    
    // model for auto complete search
    public function getUsers($postData){
      $response = array();

      $this->db->select('*');

      if($postData['search'] )
      {
          $this->db->where("ProductName like '%".$postData['search']."%' ");
          $result = $this->db->get('grocery_products')->result();

          foreach($result as $row )
          {
              $response[] = array("label"=>$row->ProductName);
          }
      }

      return $response;
    }

    public function similarProducts($categoryId, $brandId) {
        $this->db->select('*');
        $this->db->from($this->tableName);
        $where1 = "Category = " . $categoryId . " OR Brand = " . $brandId;
        //$where1 = "Category = " . $categoryId;
        //$where2 = "Brand = " . $brandId . " OR Category = " . $categoryId;
        $this->db->where($where1);
        //$this->db->where($where2);
        $this->db->limit(30);
        $response = $this->db->get();

        // $response = $this->db->query("SELECT * FROM " . $this->tableName . " WHERE Category = " . $categoryId . " OR Brand = " . $brandId . " AND Status = 1 ORDER BY DESC");
        if ($response->result_array() > 0) {
            return $response->result_array();
        }
        return false;
    }

}
