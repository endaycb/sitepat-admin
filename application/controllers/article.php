<?php
class Article extends CI_Controller{
    var $main_table;
    var $section;
    var $image_path;
    var $section_image_path;
    var $date_time;
    
    public function __construct() {
        parent::__construct();
        $this->main_table           = "article";
        $this->section              = "article";
        $this->date_time            = date("Y-m-d H:i:s");
        $this->image_path           = "dist/img/";
        $this->section_image_path   = base_url().$this->image_path.$this->section."_image/";
        
        $config['upload_path']      = "./".$this->image_path.$this->section."_image/";
        $config['allowed_types']    = 'gif|jpg|png';
        $config['encrypt_name']     = TRUE;
        
        $this->load->model("system_queries_model");
        $this->load->model("additional_info_model");
        $this->load->library('upload', $config);
    }
    
    //---INTERFACE---
    public function index(){
        $data	= $this->additional_info_model->additional_data();
        $custom_query = "SELECT ".$this->main_table.".id,  ".$this->main_table.".title,  ".$this->main_table.".desc, ".$this->main_table.".special
                         FROM ".$this->main_table." 
                         ORDER BY id ASC";
        
        if($query = $this->system_queries_model->custom_query($custom_query)){
            $data["fields"]             = $query->list_fields();
            $data["records"]            = $query->result();
            $data["section_image_path"] = $this->section_image_path;
        }
        
        $this->load->view("element/head",$data);
        $this->load->view("article_view",$data);
        $this->load->view("element/foot",$data);
    }
    
    public function add(){
		$data	= $this->additional_info_model->additional_data();
        if($query = $this->system_queries_model->read("region")){
            $data["records"]            = $query->result();
            $data["section_image_path"] = $this->section_image_path;
        }
        
        $this->load->view("element/head",$data);
        $this->load->view("article_add_view",$data);
        $this->load->view("element/foot",$data);
    }
    
    public function edit($id){
		$data	= $this->additional_info_model->additional_data();
		
        if($query = $this->system_queries_model->read_by_id($this->main_table, $id)){
            $data["record"]             = $query->result();
            $data["section_image_path"] = $this->section_image_path;
        }
        if($query = $this->system_queries_model->read("region")){
            $data["records"]            = $query->result();
        }
        
        $this->load->view("element/head",$data);
        $this->load->view("article_edit_view",$data);
        $this->load->view("element/foot",$data);
    }
    
    //---CREATE UPDAET DELETE---
    public function create(){
        
        $this->load->model("system_queries_model");
        
         $data = array(
                    "label"             => $this->input->post("label"),
                    "title"             => $this->input->post("title"),
                    "article"           => $this->input->post("ck"),
                    "desc"              => $this->input->post("desc"),
                    "date_time"         => $this->date_time,
                 );
         
         if(!$this->upload->do_upload('image')) {
            $data['error'] = $this->upload->display_errors();
            print $data['error'];
         }else {
            $image_data     = $this->upload->data();
            $image_name     = $image_data['file_name'];
            $data["image"]  = $image_name;
         }
        
        $this->system_queries_model->create($this->main_table, $data);
        redirect(base_url()."index.php/".$this->section);
    } 
    
    public function update(){
        $data = array(
                    "label"             => $this->input->post("label"),
                    "title"             => $this->input->post("title"),
                    "article"           => $this->input->post("ck"),
                    "desc"              => $this->input->post("desc"),
                );
         
        if($this->upload->do_upload('image')) {
            $image_data = $this->upload->data();
            $image_name = $image_data['file_name'];
            
            $data["image"] = $image_name;
         }
         
        $this->system_queries_model->update_row($this->main_table, $this->input->post("id"), $data);
        redirect(base_url()."index.php/".$this->section);
    }
    
    public function delete($id){
        $this->system_queries_model->delete_row($this->main_table,$id);
        redirect(base_url()."index.php/".$this->section);
    }
    
    public function change_special($id){
        $q_search_active    = "SELECT id,special 
                               FROM ".$this->main_table." 
                               WHERE id = ".$id." AND special = 1";
        
        $query  = $this->system_queries_model->custom_query($q_search_active);
        if($query->num_rows() < 1) $special = 1;
        else $special = 0;
        
        $q_change      = "UPDATE ".$this->main_table." 
                          SET special = ".$special."
                          WHERE id=".$id;
        
        $this->system_queries_model->custom_query($q_change);
        redirect(base_url()."index.php/".$this->section);
    }
}
?>
