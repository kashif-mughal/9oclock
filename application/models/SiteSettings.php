<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SiteSettings extends CI_Model {

    public function __construct() {
        parent::__construct('web_setting');
    }
    private $tableName = 'web_setting';
    
}
