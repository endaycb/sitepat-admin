<?php
class Promo extends CI_Controller{
    var $main_table;
    var $section;
    var $image_path;
    var $section_image_path;
    var $date_time;
    var $date;
    
    public function __construct() {
        parent::__construct();
        $this->main_table           = "promo";
        $this->section              = "promo";
        $this->date_time            = date("Y-m-d H:i:s");
        $this->date                 = date("Y-m-d");
        $this->image_path           = "dist/img/";
        $this->section_image_path   = base_url().$this->image_path.$this->section."_image/";
        
        $config['upload_path']      = "./".$this->image_path.$this->section."_image/";
        $config['allowed_types']    = 'gif|jpg|png';
        $config['encrypt_name'] = TRUE;
        
        $this->load->model("system_queries_model");
        $this->load->model("additional_info_model");
       
        $this->load->library('upload', $config);
    }
    
    //---INTERFACE---
    public function index(){
		$data	= $this->additional_info_model->additional_data();
		
        $custom_query = "SELECT ".$this->main_table.".id,  ".$this->main_table.".title,  ".$this->main_table.".desc, ".$this->main_table.".date_time_publish, ".$this->main_table.".date_time_end, ".$this->main_table.".special
                         FROM ".$this->main_table." 
                         ORDER BY id ASC";
        
        if($query = $this->system_queries_model->custom_query($custom_query)){
            $data["fields"]             = $query->list_fields();
            $data["records"]            = $query->result();
            $data["section_image_path"]   = $this->section_image_path;
        }
       
        $this->load->view("element/head",$data);
        $this->load->view("promo_view",$data);
        $this->load->view("element/foot",$data);
    }
    
    public function add(){
		$data	= $this->additional_info_model->additional_data();
		
        $q_store = "SELECT store.id, store.name 
                    FROM store 
                    ORDER BY region_id DESC";
        
        if($query = $this->system_queries_model->read("region")){
            $data["region"]            = $query->result();
        }
        
        if($query = $this->system_queries_model->custom_query($q_store)){
            $data["store"]            = $query->result();
        }
        
        $data["section_image_path"] = $this->section_image_path;
        
        $this->load->view("element/head",$data);
        $this->load->view("promo_add_view",$data);
        $this->load->view("element/foot",$data);
    }
    
    public function edit($id){
		$data	= $this->additional_info_model->additional_data();
	
        $q_store = "SELECT store.id, store.name 
                    FROM store 
                    ORDER BY region_id DESC";
        
        if($query = $this->system_queries_model->read_by_id($this->main_table, $id)){
            $data["record"]             = $query->result();
        }
        
        if($query = $this->system_queries_model->read("region")){
            $data["region"]            = $query->result();
        }
        
        if($query = $this->system_queries_model->custom_query($q_store)){
            $data["store"]            = $query->result();
        }
        
        $data["section_image_path"] = $this->section_image_path;
        
        $this->load->view("element/head",$data);
        $this->load->view("promo_edit_view",$data);
        $this->load->view("element/foot",$data);
    }
    //---ADDITIONAL---
    public function change_status($id){
        $status = 0;
        
        $data["record"] = $this->system_queries_model->read_by_id($this->main_table,$id);
        $data["record"] = $data["record"]->result();
        
        foreach($data["record"] as $row){
            if($row->status == 0) $status = 1;
        }
        
        $q_active           = "UPDATE ".$this->main_table."
                               SET status = ".$status."
                               WHERE id=".$id;
        
        $this->system_queries_model->custom_query($q_active);
        redirect(base_url()."index.php/".$this->section);
    }
    
    //---CREATE UPDAET DELETE---
    public function create(){
        $store_id           = null;
        $region_id          = null;
        $status             = 0;
        
        
        
        $data = array(
                    "region_id"         => null,
                    "store_id"          => null,
                    "title"             => $this->input->post("title"),
                    "desc"              => $this->input->post("desc"),
                    "promo"             => $this->input->post("ck"),
                    "date_time"         => $this->date_time,
                    "date_time_publish" => $this->input->post("date_time_publish"),
                    "date_time_end"     => $this->input->post("date_time_end"),
                 );
         
        if($this->input->post('region_active') == 1 && $this->input->post("region_id") != null){
            $data["region_id"]  = $this->additional_info_model->arrange_array_field($this->input->post("region_id"));
        }
        
        if($this->input->post('store_active') == 1 && $this->input->post("store_id") != null){
            $data["store_id"]   = $this->additional_info_model->arrange_array_field($this->input->post("store_id"));
        }
         
        if(!$this->upload->do_upload('image')) {
            $data['error'] = $this->upload->display_errors();
            print $data['error'];
        }else {
            $image_data     = $this->upload->data();
            $image_name     = $image_data['file_name'];
            $data["image"]  = $image_name;
        }
        
        if(!$this->upload->do_upload('image_thumb')) {
            $data['error'] = $this->upload->display_errors();
            print $data['error'];
        }else {
            $image_data             = $this->upload->data();
            $image_name             = $image_data['file_name'];
            $data["image_thumb"]    = $image_name;
        }
        
        $this->system_queries_model->create($this->main_table, $data);
        redirect(base_url()."index.php/".$this->section);
    } 
    
    
    public function update(){
        $store_id           = null;
        $region_id          = null;
        $status             = 0;
        
        
        $data = array(
                    "region_id"         => null,
                    "store_id"          => null,
                    "title"             => $this->input->post("title"),
                    "desc"              => $this->input->post("desc"),
                    "promo"             => $this->input->post("ck"),
                    "date_time_publish" => $this->input->post("date_time_publish"),
                    "date_time_end"     => $this->input->post("date_time_end"),
                );
        
        if($this->input->post('region_active') == 1 && $this->input->post("region_id") != null){
            $data["region_id"]  = $this->additional_info_model->arrange_array_field($this->input->post("region_id"));
        }
        
        if($this->input->post('store_active') == 1 && $this->input->post("store_id") != null){
            $data["store_id"]   = $this->additional_info_model->arrange_array_field($this->input->post("store_id"));
        }
         
        if($this->upload->do_upload('image')) {
            $image_data = $this->upload->data();
            $image_name = $image_data['file_name'];
            
            $data["image"] = $image_name;
        }
        if($this->upload->do_upload('image_thumb')) {
            $image_data             = $this->upload->data();
            $image_name             = $image_data['file_name'];
            
            $data["image_thumb"]    = $image_name;
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
