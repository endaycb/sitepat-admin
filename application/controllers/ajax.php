<?php

class Ajax extends CI_Controller{
    public function __construct() {
        parent::__construct();
        
        $this->load->model("additional_info");
    }
    
    public function selec_limit($controller_name){
        $data       = null;
        $rows       = null;
        $per_page   = $this->additional_info->get_per_page();
        
        if($query = $this->additional_info->select_limit(0,$per_page)){
           $data["records"] = $query; 
        }
       
        if($query = $this->additional_info->get_count_rows("categories")){
            $data["count"]  = $query;
        }
        
        foreach($data["count"] as $row){
            $rows = $row->count;
        }
        
        $this->load->library("pagination");
        
        $config["base_url"]     = base_url()."/index.php/".$this->uri->segment(1)."/page";
        $config['total_rows']   = $rows;
        $config['per_page']     = $per_page;
        $config['uri_segment']  = 2;
        $config['num_links']    = 2;
        
        $this->pagination->initialize($config);
        
        $this->load->view("elements_admin/head.php");
        $this->load->view($controller_name."_view.php",$data);
        $this->load->view("elements_admin/foot.php");
    }
}
?>
