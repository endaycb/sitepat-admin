<?php
class Achievements extends CI_Controller{
    var $main_table;
    var $section;
    var $image_path;
    var $section_image_path;
    var $date_time;
    var $date;
    
    public function __construct() {
        parent::__construct();
        $this->main_table           = "achievements";
        $this->section              = "achievements";
        $this->date_time            = date("Y-m-d H:i:s");
        $this->date                 = date("Y-m-d");
        $this->image_path           = "dist/img/";
        $this->section_image_path   = base_url().$this->image_path.$this->section."_image/";
        
        $config['upload_path']      = "./".$this->image_path.$this->section."_image/";
        $config['allowed_types']    = 'gif|jpg|png';
        $config['encrypt_name'] = TRUE;
        
        $this->load->model("additional_info_model");
        $this->load->model("system_queries_model");
        
       
        $this->load->library('upload', $config);
    }
    
    //---INTERFACE---
    public function index(){
        $data	= $this->additional_info_model->additional_data();
        if($query = $this->system_queries_model->read($this->main_table)){
            $data["fields"]             = $query->list_fields();
            $data["records"]            = $query->result();
            $data["section_image_path"]   = $this->section_image_path;
        }
       
        $this->load->view("element/head",$data);
        $this->load->view($this->section."_view",$data);
        $this->load->view("element/foot");
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
        
        $data = array(
                    "title"     => $this->input->post("title"),
                    "desc"      => $this->input->post("desc"),
                    "date"      => $this->input->post("date"),
                 );
       
        $this->system_queries_model->create($this->main_table, $data);
        redirect(base_url()."index.php/".$this->section);
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
