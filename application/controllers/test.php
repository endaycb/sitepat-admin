<?php
class Test extends CI_Controller{
   
    
    public function __construct() {
        parent::__construct();
       
        
        $this->load->model("system_queries_model");
        $this->load->model("additional_info_model");
    }
    
    //---INTERFACE---
    public function index(){
        
        $data = array(
                    "a"     =>  "12345678910",
                    "b"      => "12345678910",
                    "c"      => "12345678910", 
                    "d"      => "12345678910",
                 );
        for($a=0;$a<1000000;$a++){
        $this->system_queries_model->create("test", $data);
        
        }
    }
    
    public function add(){
      $data	= $this->additional_info_model->additional_data();
        $data["section_image_path"] = $this->section_image_path;
        
        $this->load->view("element/head",$data);
        $this->load->view($this->section."_add_view",$data);
        $this->load->view("element/foot");
    }
    
    public function edit($id){
        $data	= $this->additional_info_model->additional_data();
        if($query = $this->system_queries_model->read_by_id($this->main_table, $id)){
            $data["record"]             = $query->result();
        }
      
        $data["section_image_path"] = $this->section_image_path;
        
        $this->load->view("element/head",$data);
        $this->load->view($this->section."_edit_view",$data);
        $this->load->view("element/foot");
    }
    
    
    //---CREATE UPDAET DELETE---
    public function create(){
        
    } 
    
    
    public function update(){
       $data = array(
                    "title"     => $this->input->post("title"),
                    "desc"      => $this->input->post("desc"),
                    "date"      => $this->input->post("date"),
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
