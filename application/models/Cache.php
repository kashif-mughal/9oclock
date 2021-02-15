<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cache extends CI_Model {

	public function update_cache_file($fileName, $data){
        $cache_file = "./assets/cache/$fileName";
        $jsonContent = json_encode($data);
        file_put_contents($cache_file, $jsonContent);
    }
}