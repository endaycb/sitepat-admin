<?php
class Menus_sub extends CI_Controller{
    var $main_table;
    var $sub_table;
    var $section;
    var $query_menus;
    public function __construct() {
        parent::__construct();
        $this->main_table   = "menus_sub";
        $this->sub_table    = "menus";
        $this->section      = "menus_sub";
        
        $this->query_menus  = "SELECT * FROM ".$this->sub_table." "
                            . "WHERE url = '' or url = '#'";
        
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
		
        if($query = $this->system_queries_model->custom_query($this->query_menus)){
            $data["menus"] = $query->result();
        }
        //echo $this->db->last_query();
        $this->load->view("element/head",$data);
        $this->load->view($this->section."_add_view",$data);
        $this->load->view("element/foot",$data);
    }
    
    public function edit($id){
		$data	= $this->additional_info_model->additional_data();
		
        if($query = $this->system_queries_model->custom_query($this->query_menus)){
            $data["menus"] = $query->result();
        }
        
        if($query = $this->system_queries_model->read_by_id($this->main_table, $id)){
            $data["record"] = $query->result();
        }
        $this->load->view("element/head",$data);
        $this->load->view($this->section."_edit_view",$data);
        $this->load->view("element/foot",$data);
    }
    
    //---CREATE UPDAET DELETE---
    public function create(){
        $menu   = $this->system_queries_model->read_by_id("menus",$this->input->post("menus_id"));
        
        $data = array(
                    "menus_id"      => $this->input->post("menus_id"),
                    "name"          => $this->input->post("name"),
                    "url"           => $this->input->post("url"),
                    "position"      => $this->input->post("position"),
                    "auth"          => $this->input->post("auth"),
                );
        
        
        foreach($menu->result() as $row){
            $data["back_front"] = $row->back_front;
        }
        
        $this->system_queries_model->create($this->main_table, $data);
        redirect(base_url()."index.php/".$this->section);
        
    } 
    
    public function update(){
        $menu   = $this->system_queries_model->read_by_id("menus",$this->input->post("menus_id"));
        
        $data = array(
                    "menus_id"      => $this->input->post("menus_id"),
                    "name"          => $this->input->post("name"),
                    "url"           => $this->input->post("url"),
                    "position"      => $this->input->post("position"),
                    "auth"          => $this->input->post("auth"),
                );
        
        
        foreach($menu->result() as $row){
            $data["back_front"] = $row->back_front;
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
