<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categories extends CI_Model {

    public function __construct() {
        parent::__construct('grocery_category');
    }
    private $tableName = 'grocery_category';

    public function category_list() {
        $this->db->select('a.*, b.CatName ParentName, b.sort ParentSort');
        $this->db->from($this->tableName.' a');
        $this->db->join($this->tableName.' b', 'a.ParentId = b.CategoryId', 'left');
        $this->db->where('a.Status', 1);
        $this->db->order_by('b.sort', 'ASC');
        $this->db->order_by('a.sort', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            echo '<pre>';
            print_r($query->result_array());die;
            return $query->result_array();
        }
        return false;
    }
    
    public function category_listin() {
        
        $CI = & get_instance();
        $CI->load->model('SiteSettings');
        $setting_detail = $CI->SiteSettings->retrieve_editdata('setting_id', '1');
        $SettingData = $setting_detail[0];
        //echo ($SettingData['home_page_cat']);
        $idarr = trim($SettingData['home_page_cat'], '[]');
        $myq = 'SELECT a.*, b.CatName ParentName , b.sort ParentSort FROM `grocery_category`a LEFT JOIN `grocery_category` b ON a.ParentId = b.CategoryId WHERE a.Status="1" AND a.ParentId IN ('.$idarr.') Order by a.sort ASC';
        //echo $myq;die;
        $query = $this->db->query($myq);
        if ($query->num_rows() > 0) {
            //return $query->result_array();
            return json_decode($SettingData['home_page_cat']);
        }
        return false;
    }

    public function category_list_product() {
        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->where('Status', 1);
        $this->db->order_by('sort', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function get_active_categories() {
        $this->db->select('CategoryId');
        $this->db->from($this->tableName);
        $this->db->where('Status', 1);
        $this->db->order_by('sort', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Category Search Item
    public function category_search_item($CategoryId) {
        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->where('CategoryId', $CategoryId);
        $this->db->limit('500');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    
    //Count customer
    public function parent_category() {
        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->where('ParentId', 0);
        $this->db->where('Status', 1);
        $this->db->order_by('sort', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    //Count customer
    public function parent_category_seeting() {
        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->where('ParentId', 0);
        $this->db->where('Status', 1);
        $this->db->order_by('sort', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    
    public function get_last_sort_number(){
        $this->db->select('max(sort) larger_sort');
        $this->db->from($this->tableName);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array()[0]['larger_sort'];
        }
        return false;
    }
    
    //Count customer
    public function category_entry($data) {
        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->where('Status', 1);
        $this->db->where('CatName', $data['CatName']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            $this->db->insert('grocery_category', $data);
            return TRUE;
        }
    }
    //Get limited products inside all sub cat hierarchy
    public function getCatPrducts($catId, $productName = null, $startFrom = 0, $limit = 10, $brand = null){
        $inCats = Array();
        $func = function($value) {
            return $value["CategoryId"];
        };
        if(empty($catId))
            $catId = 0;
        $queryFirst = "SELECT  CategoryId
                            from    (select * from grocery_category
                                     order by ParentId, CategoryId) products_sorted,
                                    (select @pv := $catId) initialisation
                            where   find_in_set(ParentId, @pv) and Status = 1
                            and     length(@pv := concat(@pv, ',', CategoryId))";
        $firstQueryResult = $this->db->query($queryFirst);
        // echo '<pre>';print_r($firstQueryResult->result_array());die;
        if ($firstQueryResult->num_rows() > 0) {
            $inCats = array_map($func, $firstQueryResult->result_array());
            //$inCats = join(",", $inCats);
        }
        array_push($inCats, $catId);
        $inCats = join(",", $inCats);
        
        $whereString = is_null($productName) ? " " : " AND gp.ProductName Like('%$productName%') ";
        if(!is_null($brand)){
            $whereString .= "AND gp.Brand = $brand ";
        }
        $query = "SELECT 
                        gpv.ProductId VId, gpv.ProductName VName, gpv.ProductImg VImage, gpv.ParentProduct VParent, gpv.SalePrice VPrice, gc.Alias catAlias, gc.CatName catName, gp.*, gu2.UnitName SaleUnitName, 
                        CASE WHEN gu.UnitName = NULL THEN 'Piece' ELSE gu.UnitName END AS UnitName 
                    FROM grocery_products gp
                    join grocery_category gc on gp.Category = gc.CategoryId 
                    LEFT JOIN grocery_unit gu ON gu.UnitId = gp.Unit
                    LEFT JOIN grocery_products gpv on gpv.ParentProduct = gp.ProductId
                    left join grocery_unit gu2 on gp.SaleUnit = gu2.UnitId
                    WHERE gp.Status = 1 $whereString AND  gc.Status = 1 AND
                    gp.Category IN(
                        $inCats
                    )
                    ORDER BY gp.sort, gp.ParentProduct DESC
                    LIMIT $startFrom, $limit";
        $countQuery = "SELECT 
                        count(1) total
                    FROM grocery_products gp
                    join grocery_category gc on gp.Category = gc.CategoryId 
                    LEFT JOIN grocery_unit gu ON gu.UnitId = gp.Unit
                    LEFT JOIN grocery_products gpv on gpv.ParentProduct = gp.ProductId
                    left join grocery_unit gu2 on gp.SaleUnit = gu2.UnitId
                    WHERE gp.Status = 1 $whereString AND gc.Status = 1 AND
                    gp.Category IN(
                        $inCats
                    )";
        $returnData["total"] = 0;
        $countResult = $this->db->query($countQuery);
        if ($countResult->num_rows() > 0) {
            $returnData["total"] = $countResult->result()[0]->total;
        }
        else{
            return false;
        }
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            $returnData["products"] = $query->result_array();
            $returnData["products"] = $this->product_data_after_varient_sort($returnData["products"]);
            return $returnData;
        }
        else{
            return false;
        }
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
        return $tempProducts;
        //$returnData['products'] = $tempProducts;
        //return $returnData;
    }
    function update_category_sort_order($catData){
        try {
            for ($i=0; $i < count($catData); $i++) { 
                if($catData[$i]->nso == $catData[$i]->pso)
                    continue;
                $data = array(
                    'sort' => $catData[$i]->nso
                );
                $this->update($data, 'CategoryId', $catData[$i]->id);
            }
            return true;   
        } catch (Exception $e) {
            return false;
        }
    }
    public function get_child_categories($catId) {
        $inCats = Array();
        $func = function($value) {
            return $value["CategoryId"];
        };
        if(empty($catId))
            $catId = 0;
        $queryFirst = "SELECT  CategoryId
                            from    (select * from grocery_category
                                     order by ParentId, CategoryId) products_sorted,
                                    (select @pv := $catId) initialisation
                            where   find_in_set(ParentId, @pv) and Status = 1
                            and     length(@pv := concat(@pv, ',', CategoryId))";
        $firstQueryResult = $this->db->query($queryFirst);
        if ($firstQueryResult->num_rows() > 0) {
            $inCats = array_map($func, $firstQueryResult->result_array());
        }
        array_push($inCats, $catId);
        $inCats = join(",", $inCats);

        $query = "SELECT 
                    sort, CategoryId, CatName 
                    FROM $this->tableName
                    WHERE Status = 1 AND 
                    ParentId IN(
                        $inCats
                    )
                    ORDER BY sort ASC";

        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else
            return false;
    }
}
