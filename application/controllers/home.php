<?php
class Home extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model("additional_info_model");
        $this->load->model("system_queries_model");
    }
    
    public function index(){
        $data	= $this->additional_info_model->additional_data();
        
        $this->load->view("element/head",$data);
        $this->load->view("home_view",$data);
        $this->load->view("element/foot",$data);
    }
}
?>
