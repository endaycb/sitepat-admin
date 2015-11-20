<?php
class Item extends CI_Controller{
    var $main_table;
    var $section;
    
    public function __construct() {
        parent::__construct();
        $this->main_table           = "item";
        $this->section              = "item";
        
        $this->load->model("system_queries_model");
		$this->load->model("additional_info_model");
    }
    
    //---INTERFACE---
    public function index(){
        $custom_query = "SELECT ".$this->main_table.".id, ".$this->main_table.".type, brand.name as brand, ".$this->main_table.".name, ".$this->main_table.".size, ".$this->main_table.".price
                         FROM ".$this->main_table.",brand 
                         WHERE brand.id=".$this->main_table.".brand_id
                         ORDER BY id ASC";
        
        if($query = $this->system_queries_model->custom_query($custom_query)){
            $data["fields"]             = $query->list_fields();
            $data["records"]            = $query->result();
            //$data["section_image_path"]   = $this->section_image_path;
        }
       
        $this->load->view("element/head");
        $this->load->view("item_view",$data);
        $this->load->view("element/foot");
    }
    
    public function add(){
        if($query = $this->system_queries_model->read("brand")){
            $data["records"]            = $query->result();
        }
        
        $this->load->view("element/head");
        $this->load->view("item_add_view",$data);
        $this->load->view("element/foot");
    }
    
    public function edit($id){
        if($query = $this->system_queries_model->read_by_id($this->main_table, $id)){
            $data["record"]             = $query->result();
        }
        if($query = $this->system_queries_model->read("brand")){
            $data["records"]            = $query->result();
        }
        
        $this->load->view("element/head");
        $this->load->view("item_edit_view",$data);
        $this->load->view("element/foot");
    }
    
    function reArange_size($size1,$size2){
        if($size1 == ""){
            $size1 = "0";
        }
        if($size2 == ""){
            $size2 = "0";
        }
        $size = $size1.".".$size2;
        
        return $size;
    }
    //---CREATE UPDAET DELETE---
    public function create(){
        $a = new Item;
         
        $data = array(
                    "brand_id"  => $this->input->post("brand_id"),
                    "type"      => $this->input->post("type"),
                    "name"      => $this->input->post("name"),
                    "price"     => $this->input->post("price"),
                );
         
        if($this->input->post("type") == "ban"){
           //$data["size"] = $a->reArange_size($this->input->post("size1"),$this->input->post("size2"));
            $data["size"]   = $this->input->post("width")."/".$this->input->post("width_compare")."-".$this->input->post("diameter");
            echo "fak";
        }
         
        //$this->system_queries_model->create($this->main_table, $data);
        //redirect(base_url()."index.php/".$this->section);
        
    } 
    
    public function update(){
        $a = new Item;
        
        $data = array(
                    "brand_id"  => $this->input->post("brand_id"),
                    "type"      => $this->input->post("type"),
                    "name"      => $this->input->post("name"),
                    "price"     => $this->input->post("price"),
                );
        
        if($this->input->post("type") == "ban"){
            $data["size"] = $a->reArange_size($this->input->post("size1"),$this->input->post("size2"));
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
