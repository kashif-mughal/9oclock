<?php
require_once 'vendor/autoload.php';
use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;
use WindowsAzure\ServiceBus\Models\BrokeredMessage;
use WindowsAzure\ServiceBus\Models\ReceiveMessageOptions;


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cepos extends CI_Controller {

    protected $connectionString;
    function __construct() {
        parent::__construct();
        $this->template->current_menu = 'home';
        $this->load->model('Auths');
        $this->connectionString = "Endpoint=https://nineoclockshop.servicebus.windows.net/;SharedAccessKeyName=NinOClockShopPolicy;SharedAccessKey=DWYni8DGT3iYmhTV5vfN/227Vaa6IJ1nL4Xo9j+j+Bg=;";
    }

    public function calldata(){

        // $query = $this->db->query("SELECT DISTINCT json_object('abc',DataReceived) as dt FROM `service_bus_consumption_log` WHERE TblName like '%tblTax%'");
        // echo '<pre>';
        // $res = array();
        // $dts = $query->result_array();
        // for ($i=0; $i < count($dts); $i++) { 
        //     $jsnDt = json_decode($dts[$i]["dt"]);
        //     echo(json_encode($jsnDt->abc));
        //     print_r(",");
        // }
        // die;
        
        $serviceBusRestProxy = ServicesBuilder::getInstance()->createServiceBusService($this->connectionString);

        try{
        //$queueInfo = new QueueInfo("grocer-epos");
        //>>>>>>>>>>>> Receive Message To A Queue Start <<<<<<<<<<<<<<<<<<

            $options = new ReceiveMessageOptions();
            $options->setPeekLock();
            for ($i=0; $i < 5000; $i++) {
                $message = $serviceBusRestProxy->receiveQueueMessage("epostooms", $options);

                // $message ="{\"table\":\"tblTax\",\"data\":[{\"Id\":1,\"TaxName\":\"Default Tax\",\"TaxPercentage\":20,\"IsActive\":true},{\"Id\":2,\"TaxName\":\"Bright ProductsTax\",\"TaxPercentage\":20},{\"Id\":3,\"TaxName\":\"\",\"TaxPercentage\":1,\"IsActive\":false},{\"Id\":4,\"TaxName\":\"\",\"TaxPercentage\":5,\"IsActive\":true},{\"Id\":5,\"TaxName\":\"\",\"TaxPercentage\":21,\"IsActive\":true}],\"mode\":\"setup\"}";
                echo '<pre>';
                if(!empty($message)){
                    $incomingMessage = json_decode($message->getBody());
                    //$incomingMessage = json_decode($message);
                    echo '<br>';print_r($incomingMessage);
                    $tblName = $incomingMessage->table;
                    $value = $incomingMessage->data;
                    $mode = $incomingMessage->mode;
                    if($mode == 'update'){
                        if($tblName == 'tblStock'){
                            $result = $this->UpdateTblStock($value);
                        }
                        else if($tblName == 'tblCompany'){
                            $result = $this->UpdateTblCompany($value);
                        }
                        else if($tblName == 'tblUnitOfSale'){
                            $result = $this->UpdateTblUnitOfSale($value);
                        }
                        else if($tblName == 'tblItemCategory'){
                            $result = $this->UpdateTblItemCategory($value);
                        }
                        else if($tblName == 'tblItem'){
                            $result = $this->UpdateTblItem($value);
                        }
                        else if($tblName == 'tblTax'){
                            $result = $this->UpdateTblTax($value);
                        }
                        else{
                            $this->AddDefaultLog($value, $tblName, $mode);
                        }
                    }
                    else if($mode == 'setup'){
                        if($tblName == 'tblStock'){
                            $result = $this->InsertTblStock($value);
                        }
                        else if($tblName == 'tblCompany'){
                            $result = $this->InsertTblCompany($value);
                        }
                        else if($tblName == 'tblUnitOfSale'){
                            $result = $this->InsertTblUnitOfSale($value);
                        }
                        else if($tblName == 'tblItemCategory'){
                            $result = $this->InsertTblItemCategory($value);
                        }
                        else if($tblName == 'tblItem'){
                            $result = $this->InsertTblItem($value);
                        }else if($tblName == 'tblTax'){
                            $result = $this->InsertTblTax($value);
                        }
                        else{
                            $this->AddDefaultLog($value, $tblName, $mode);
                        }
                    }
                    else{
                        $this->AddDefaultLog($value, $tblName, $mode);
                    }
                }
                else{
                    break;
                }
            }
            //>>>>>>>>>>>> End Receive Message From Queue epostooms <<<<<<<<<<<<<<<<<<

            //>>>>>>>>>>>> Send Message To omstoepos Queue Start <<<<<<<<<<<<<<<<<<

            // $message = new BrokeredMessage();
            // $message->setBody("{\"Id\":3,\"Name\":\"Ginger\",\"Qty\":5,\"Price\":20.5,\"Discount\":5,\"DiscountType\":\"Percentage\"}");
            // $message->setContentType("application/json; charset=utf-8");
            // $serviceBusRestProxy->sendQueueMessage("producta", $message);

            //>>>>>>>>>>>> End Send Message To omstoepos Queue <<<<<<<<<<<<<<<<<<
        }
        catch(ServiceException $e){
            $code = $e->getCode();
            $error_message = $e->getMessage();
            echo $code.": ".$error_message."<br />";
            die;
        }

        $CI = & get_instance();
        $data = array(
            'title' => '9o\'Clock | Buy all your grocery here'
        );
        $content = $CI->parser->parse('test', $data, true);
        $this->template->full_html_view($content);        
    }
    //>>>>>>>>>>>>>>>>>>>>   Insert Queue Data   <<<<<<<<<<<<<<<<<<
    private function InsertTblStock($tblData){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        for ($i=0; $i < count($tblData); $i++) {
            $currentExceptionMessage = "";
            try{
                $data = array(
                    'Id'                    =>  $tblData[$i]->Id,
                    'ItemCategoryId'        =>  $tblData[$i]->ItemCategoryId,
                    'ItemId'                =>  $tblData[$i]->ItemId,
                    'QuantityAvailable'     =>  $tblData[$i]->QuantityAvailable,
                    'CompanyId'             =>  $tblData[$i]->CompanyId,
                    'OutletId'              =>  $tblData[$i]->OutletId,
                    'IsActive'              =>  $tblData[$i]->IsActive
                );
                //$this->db->insert('tblstock',$data);
                $sql = $this->db->insert_string('tblstock',$data). " ON DUPLICATE KEY UPDATE ItemCategoryId = '".$tblData[$i]->ItemCategoryId."', ItemId = ".$tblData[$i]->ItemId.", QuantityAvailable = ".$tblData[$i]->QuantityAvailable.", CompanyId = ".$tblData[$i]->CompanyId.", OutletId = ".$tblData[$i]->OutletId.", IsActive = ".$tblData[$i]->OutletId;
                $this->db->query($sql);
            }
            catch(Exception $ex){
                $currentExceptionMessage = $ex->getMessage();
            }
            finally{
                // tblName, exception, dataReceived, dataSend, type
                $this->LogServiceBusConsumption("tblstock", $currentExceptionMessage, json_encode($tblData[$i]), '', 'rs');
            }
        }
    }
    private function InsertTblCompany($tblData){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        for ($i=0; $i < count($tblData); $i++) {
            $currentExceptionMessage = "";
            try{
                $data = array(
                    'Id'                =>  $tblData[$i]->Id,
                    'Name'              =>  $tblData[$i]->Name,
                    'IsActive'          =>  $tblData[$i]->IsActive,
                    'IsTaxInclusive'    =>  $tblData[$i]->IsTaxInclusive
                );
                //$this->db->insert('tblCompany',$data);
                $sql = $this->db->insert_string('tblCompany',$data). " ON DUPLICATE KEY UPDATE Name = '".$tblData[$i]->Name."', IsActive = ".$tblData[$i]->IsActive.", IsTaxInclusive = ".$tblData[$i]->IsTaxInclusive;
                $this->db->query($sql);
            }
            catch(Exception $ex){
                $currentExceptionMessage = $ex->getMessage();
            }
            finally{
                // tblName, exception, dataReceived, dataSend, type
                $this->LogServiceBusConsumption("tblCompany", $currentExceptionMessage, json_encode($tblData[$i]), '', 'rs');
            }
        }
    }
    private function InsertTblUnitOfSale($tblData){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        for ($i=0; $i < count($tblData); $i++) {
            $currentExceptionMessage = "";
            try{
                $data = array(
                    'UnitId'            =>  $tblData[$i]->Id,
                    'UnitName'          =>  $tblData[$i]->Symbol,
                    'Status'            =>  $tblData[$i]->IsActive
                );
                $sql = $this->db->insert_string('grocery_unit',$data). " ON DUPLICATE KEY UPDATE UnitName = '".$tblData[$i]->Symbol."', Status = ".$tblData[$i]->IsActive;
                $this->db->query($sql);
            }
            catch(Exception $ex){
                $currentExceptionMessage = $ex->getMessage();
            }
            finally{
                // tblName, exception, dataReceived, dataSend, type
                $this->LogServiceBusConsumption("tblUnitOfSale", $currentExceptionMessage, json_encode($tblData[$i]), '', 'rs');
            }
        }
    }
    private function InsertTblItemCategory($tblData){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        for ($i=0; $i < count($tblData); $i++) {
            $currentExceptionMessage = "";
            try{
                $data = array(
                    'CategoryId'    =>  $tblData[$i]->Id,
                    'CatName'       =>  $tblData[$i]->CategoryName,
                    'ParentId'      =>  $tblData[$i]->ParentId,
                    'Alias'         =>  $tblData[$i]->Slug,
                    'Status'        =>  $tblData[$i]->IsActive
                );
                //$this->db->insert('tblstock',$data);
                $sql = $this->db->insert_string('grocery_category',$data). " ON DUPLICATE KEY UPDATE CatName = '".$tblData[$i]->CategoryName."', ParentId = ".$tblData[$i]->ParentId.", Alias = '".$tblData[$i]->Slug."', Status = ".$tblData[$i]->IsActive;
                $this->db->query($sql);
            }
            catch(Exception $ex){
                $currentExceptionMessage = $ex->getMessage();
            }
            finally{
                // tblName, exception, dataReceived, dataSend, type
                $this->LogServiceBusConsumption("tblItemCategory", $currentExceptionMessage, json_encode($tblData[$i]), '', 'rs');
            }
        }
    }
    private function InsertTblItem($tblData){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        for ($i=0; $i < count($tblData); $i++) {
            $currentExceptionMessage = "";
            try{
                $data = array(
                    'ProductId'     =>  $tblData[$i]->Id,
                    'ProductName'   =>  $tblData[$i]->ItemName,
                    'Category'      =>  $tblData[$i]->ItemCategoryId,
                    'Unit'          =>  $tblData[$i]->UnitOfSaleId,
                    'SaleUnit'      =>  $tblData[$i]->UnitOfSaleId,
                    'UnitId'        =>  $tblData[$i]->UnitOfSaleId,
                    'OriginalPrice' =>  $tblData[$i]->ItemPurchasePrice,
                    'Price'         =>  $tblData[$i]->ItemSalesPrice,
                    'SalePrice'     =>  $tblData[$i]->ItemSalesPrice,
                    'Status'        =>  $tblData[$i]->IsActive,
                    'CompanyId'     =>  $tblData[$i]->CompanyId,
                    'OutletId'      =>  $tblData[$i]->OutletId,
                    'Tax'           =>  $tblData[$i]->Tax,
                    'ItemBarCode'   =>  $tblData[$i]->ItemBarCode
                );
                //$this->db->insert('tblstock',$data);
                $sql = $this->db->insert_string('grocery_products',$data). " ON DUPLICATE KEY UPDATE ProductName = '".$tblData[$i]->ItemName."', Category = ".$tblData[$i]->ItemCategoryId.", Unit = ".$tblData[$i]->UnitOfSaleId.", SaleUnit = ".$tblData[$i]->UnitOfSaleId.", UnitId = ".$tblData[$i]->UnitOfSaleId.", OriginalPrice = ".$tblData[$i]->ItemPurchasePrice.", Price = ".$tblData[$i]->ItemSalesPrice.", SalePrice = ".$tblData[$i]->ItemSalesPrice.", Status = ".$tblData[$i]->IsActive.", CompanyId = ".$tblData[$i]->CompanyId.", OutletId = ".$tblData[$i]->OutletId.", ItemBarCode = '".$tblData[$i]->ItemBarCode."', Tax = ".$tblData[$i]->Tax;
                $this->db->query($sql);
            }
            catch(Exception $ex){
                $currentExceptionMessage = $ex->getMessage();
            }
            finally{
                // tblName, exception, dataReceived, dataSend, type
                $this->LogServiceBusConsumption("tblItem", $currentExceptionMessage, json_encode($tblData[$i]), '', 'rs');
            }
        }
    }
    private function InsertTblTax($tblData){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        for ($i=0; $i < count($tblData); $i++) {
            $currentExceptionMessage = "";
            try{
                $data = array(
                    'Id'            =>  $tblData[$i]->Id,
                    'TaxName'       =>  $tblData[$i]->TaxName,
                    'TaxPercentage' =>  $tblData[$i]->TaxPercentage,
                    'IsActive'      =>  $tblData[$i]->IsActive
                );
                $sql = $this->db->insert_string('tbltax',$data). " ON DUPLICATE KEY UPDATE TaxName = '".$tblData[$i]->TaxName."', TaxPercentage = ".$tblData[$i]->TaxPercentage.", IsActive = ".$tblData[$i]->IsActive;
                $this->db->query($sql);
            }
            catch(Exception $ex){
                $currentExceptionMessage = $ex->getMessage();
            }
            finally{
                // tblName, exception, dataReceived, dataSend, type
                $this->LogServiceBusConsumption("tblTax", $currentExceptionMessage, json_encode($tblData[$i]), '', 'rs');
            }
        }
    }
    //>>>>>>>>>>>>>>>>>>>>   END Insert Queue Data <<<<<<<<<<<<<<<<<<

    //>>>>>>>>>>>>>>>>>>>>   Update Queue Data   <<<<<<<<<<<<<<<<<<

    private function UpdateTblStock($tblData){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        for ($i=0; $i < count($tblData); $i++) {
            $currentExceptionMessage = "";
            try{
                $data = array(
                    'ItemCategoryId'        =>  $tblData[$i]->ItemCategoryId,
                    'ItemId'                =>  $tblData[$i]->ItemId,
                    'QuantityAvailable'     =>  $tblData[$i]->QuantityAvailable,
                    'CompanyId'             =>  $tblData[$i]->CompanyId,
                    'OutletId'              =>  $tblData[$i]->OutletId,
                    'IsActive'              =>  $tblData[$i]->IsActive
                );

                $this->db->where('Id', $tblData[$i]["Id"]);
                $this->db->update('tblstock',$data);
            }
            catch(Exception $ex){
                $currentExceptionMessage = $ex->getMessage();
            }
            finally{
                // tblName, exception, dataReceived, dataSend, type
                $this->LogServiceBusConsumption("tblstock", $currentExceptionMessage, json_encode($tblData[$i]), '', 'ru');
            }
        }
    }
    private function UpdateTblCompany($tblData){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        for ($i=0; $i < count($tblData); $i++) {
            $currentExceptionMessage = "";
            try{
                $data = array(
                    'Name'              =>  $tblData[$i]->Name,
                    'IsActive'          =>  $tblData[$i]->IsActive,
                    'IsTaxInclusive'    =>  $tblData[$i]->IsTaxInclusive
                );

                $this->db->where('Id', $tblData[$i]["Id"]);
                $this->db->update('tblCompany',$data);
            }
            catch(Exception $ex){
                $currentExceptionMessage = $ex->getMessage();
            }
            finally{
                // tblName, exception, dataReceived, dataSend, type
                $this->LogServiceBusConsumption("tblCompany", $currentExceptionMessage, json_encode($tblData[$i]), '', 'ru');
            }
        }
    }
    private function UpdateTblUnitOfSale($tblData){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        for ($i=0; $i < count($tblData); $i++) {
            $currentExceptionMessage = "";
            try{
                $data = array(
                    'UnitName'          =>  $tblData[$i]->Symbol,
                    'Status'            =>  $tblData[$i]->IsActive
                );

                $this->db->where('UnitId', $tblData[$i]["Id"]);
                $this->db->update('grocery_unit',$data);
            }
            catch(Exception $ex){
                $currentExceptionMessage = $ex->getMessage();
            }
            finally{
                // tblName, exception, dataReceived, dataSend, type
                $this->LogServiceBusConsumption("tblUnitOfSale", $currentExceptionMessage, json_encode($tblData[$i]), '', 'ru');
            }
        }
    }
    private function UpdateTblItemCategory($tblData){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        for ($i=0; $i < count($tblData); $i++) {
            $currentExceptionMessage = "";
            try{
                $data = array(
                    'CatName'       =>  $tblData[$i]->CategoryName,
                    'ParentId'      =>  $tblData[$i]->ParentId,
                    'Alias'         =>  $tblData[$i]->Slug,
                    'Status'        =>  $tblData[$i]->IsActive
                );

                $this->db->where('CategoryId', $tblData[$i]["Id"]);
                $this->db->update('grocery_category',$data);
            }
            catch(Exception $ex){
                $currentExceptionMessage = $ex->getMessage();
            }
            finally{
                // tblName, exception, dataReceived, dataSend, type
                $this->LogServiceBusConsumption("tblItemCategory", $currentExceptionMessage, json_encode($tblData[$i]), '', 'ru');
            }
        }
    }
    private function UpdateTblItem($tblData){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        for ($i=0; $i < count($tblData); $i++) {
            $currentExceptionMessage = "";
            try{
                $data = array(
                    'ProductName'   =>  $tblData[$i]->ItemName,
                    'Category'      =>  $tblData[$i]->ItemCategoryId,
                    'Unit'          =>  $tblData[$i]->UnitOfSaleId,
                    'SaleUnit'      =>  $tblData[$i]->UnitOfSaleId,
                    'UnitId'        =>  $tblData[$i]->UnitOfSaleId,
                    'OriginalPrice' =>  $tblData[$i]->ItemPurchasePrice,
                    'Price'         =>  $tblData[$i]->ItemSalesPrice,
                    'SalePrice'     =>  $tblData[$i]->ItemSalesPrice,
                    'Status'        =>  $tblData[$i]->IsActive,
                    'CompanyId'     =>  $tblData[$i]->CompanyId,
                    'OutletId'      =>  $tblData[$i]->OutletId,
                    'Tax'           =>  $tblData[$i]->Tax,
                    'ItemBarCode'   =>  $tblData[$i]->ItemBarCode
                );

                $this->db->where('ProductId', $tblData[$i]["Id"]);
                $this->db->update('grocery_products',$data);
            }
            catch(Exception $ex){
                $currentExceptionMessage = $ex->getMessage();
            }
            finally{
                // tblName, exception, dataReceived, dataSend, type
                $this->LogServiceBusConsumption("tblItem", $currentExceptionMessage, json_encode($tblData[$i]), '', 'ru');
            }
        }
    }
    private function UpdateTblTax($tblData){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        for ($i=0; $i < count($tblData); $i++) {
            $currentExceptionMessage = "";
            try{
                $data = array(
                    'TaxName'       =>  $tblData[$i]->TaxName,
                    'TaxPercentage' =>  $tblData[$i]->TaxPercentage,
                    'IsActive'      =>  $tblData[$i]->IsActive
                );

                $this->db->where('Id', $tblData[$i]["Id"]);
                $this->db->update('tbltax',$data);
            }
            catch(Exception $ex){
                $currentExceptionMessage = $ex->getMessage();
            }
            finally{
                // tblName, exception, dataReceived, dataSend, type
                $this->LogServiceBusConsumption("tblTax", $currentExceptionMessage, json_encode($tblData[$i]), '', 'ru');
            }
        }
    }

    //>>>>>>>>>>>>>>>>>>>>  END Update Queue Data   <<<<<<<<<<<<<<<<<<

    //>>>>>>>>>>>>>>>>>>>>   Update Queue Data   <<<<<<<<<<<<<<<<<<

    private function AddDefaultLog($tblData, $tblName, $type){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        if(is_array($tblData)){
            for ($i=0; $i < count($tblData); $i++) {
                $this->LogServiceBusConsumption($tblName, "", json_encode($tblData[$i]), '', 'r'.$type);
            }
        }else{
            $this->LogServiceBusConsumption($tblName, "", json_encode($tblData), '', 'r'.$type);
        }
    }
    
    //>>>>>>>>>>>>>>>>>>>>  END Update Queue Data   <<<<<<<<<<<<<<<<<<

    private function LogServiceBusConsumption($tbl, $exMessage, $dataReceived, $dataSend, $type){
        $data = array(
            'TblName'         =>  $tbl,
            'Exception'       =>  $exMessage,
            'DataReceived'    =>  $dataReceived,
            'DataSend'        =>  $dataSend,
            'Type'            =>  $type
        );
        $this->db->insert('service_bus_consumption_log',$data);
    }
}
