<?php
class Store extends CI_Controller{
    var $main_table;
    var $section;
    var $image_path;
    var $section_image_path;
    
    public function __construct() {
        parent::__construct();
        $this->main_table           = "store";
        $this->section              = "store";
        $this->image_path           = "dist/img/";
        $this->section_image_path   = base_url().$this->image_path.$this->section."_image/";
        
        $config['upload_path']      = "./".$this->image_path.$this->section."_image/";
        $config['allowed_types']    = 'gif|jpg|png';
        $config['encrypt_name']     = TRUE;
        $this->load->library('upload', $config);
		
        $this->load->model("system_queries_model");
		$this->load->model("additional_info_model");
        
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
        $this->load->view("store_view",$data);
        $this->load->view("element/foot",$data);
    }
    
    public function add(){
		$data	= $this->additional_info_model->additional_data();
	
        if($query = $this->system_queries_model->read("region")){
            $data["records"]            = $query->result();
            $data["section_image_path"]   = $this->section_image_path;
        
        }
        
        $this->load->view("element/head",$data);
        $this->load->view("store_add_view",$data);
        $this->load->view("element/foot",$data);
    }
    
    public function edit($id){
		$data	= $this->additional_info_model->additional_data();
	
        if($query = $this->system_queries_model->read_by_id($this->main_table, $id)){
            $data["record"]             = $query->result();
            $data["section_image_path"]   = $this->section_image_path;
        }
        if($query = $this->system_queries_model->read("region")){
            $data["records"]            = $query->result();
        }
        
        $this->load->view("element/head",$data);
        $this->load->view("store_edit_view",$data);
        $this->load->view("element/foot",$data);
    }
    
    //---CREATE UPDAET DELETE---
    public function create(){
         $data = array(
                    "region_id"     => $this->input->post("region_id"),
                    "name"          => $this->input->post("name"),
                    "address"       => $this->input->post("address"),
                    "postalcode"    => $this->input->post("postalcode"),
                    "phone"         => $this->input->post("phone"),
                    "email"         => $this->input->post("email"),
                    "desc"          => $this->input->post("desc"),
                    "lat"           => $this->input->post("lat"),
                    "lng"           => $this->input->post("lng"),
                );
         
         if(!$this->upload->do_upload('image')) {
            $data['error'] = $this->upload->display_errors();
            print $data['error'];
         }else {
            $image_data = $this->upload->data();
            $image_name =  $image_data['file_name'];
            
            $data["image"] = $image_name;
        }
        
        $this->system_queries_model->create($this->main_table, $data);
        redirect(base_url()."index.php/".$this->section);
        
    } 
    
    public function update(){
        $data = array(
                    "region_id"     => $this->input->post("region_id"),
                    "name"          => $this->input->post("name"),
                    "address"       => $this->input->post("address"),
                    "postalcode"    => $this->input->post("postalcode"),
                    "phone"         => $this->input->post("phone"),
                    "email"         => $this->input->post("email"),
                    "desc"          => $this->input->post("desc"),
                    "lat"           => $this->input->post("lat"),
                    "lng"           => $this->input->post("lng"),
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
}
?>
