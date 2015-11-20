<?php
class Faq extends CI_Controller{
    var $main_table;
    var $section;
    public function __construct() {
        parent::__construct();
        $this->main_table = "faq";
        $this->section   = "faq";
        
        $this->load->model("system_queries_model");
		$this->load->model("additional_info_model");
    }
    
    //---INTERFACE---
    public function index(){
		$data	= $this->additional_info_model->additional_data();
		
        if($query = $this->system_queries_model->read($this->main_table)){
            $data["fields"]  = $query->list_fields();
            $data["records"] = $query->result();
        }
        
        $this->load->view("element/head",$data);
        $this->load->view($this->section."_view",$data);
        $this->load->view("element/foot",$data);
    }
    
    public function add(){
		$data	= $this->additional_info_model->additional_data();
		
        $this->load->view("element/head",$data);
        $this->load->view($this->section."_add_view",$data);
        $this->load->view("element/foot",$data);
    }
    
    public function edit($id){
		$data	= $this->additional_info_model->additional_data();
		
        if($query = $this->system_queries_model->read_by_id($this->main_table, $id)){
            $data["record"] = $query->result();
        }
        $this->load->view("element/head",$data);
        $this->load->view($this->section."_edit_view",$data);
        $this->load->view("element/foot",$data);
    }
    
    //---CREATE UPDAET DELETE---
    public function create(){
        $data = array(
                    "title"     => $this->input->post("title"),
                    "question"  => $this->input->post("question"),
                    "answer"    => $this->input->post("answer"),
                );
        
        
            
        $this->system_queries_model->create($this->main_table, $data);
        redirect(base_url()."index.php/".$this->section);
        
    } 
    
    public function update(){
        $data = array(
                    "title"     => $this->input->post("title"),
                    "question"  => $this->input->post("question"),
                    "answer"    => $this->input->post("answer"),
                );
        
        $this->system_queries_model->update_row($this->main_table, $this->input->post("id"), $data);
        redirect(base_url()."index.php/".$this->section);
    }
    
    public function delete($id){
        $this->system_queries_model->delete_row($this->main_table,$id);
        redirect(base_url()."index.php/".$this->section);
    }
}
?>
