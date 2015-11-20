<?php
class Item_vehicle extends CI_Controller{
    var $main_table;
    var $section;
    
    public function __construct() {
        parent::__construct();
        $this->main_table           = "item";
        $this->section              = "vehicle";
        $this->item_type            = "vehicle";
		$this->brand_index			= "4";
        $this->image_path           = "dist/img/";
        $this->section_image_path   = base_url().$this->image_path.$this->main_table."_image/";
        $this->form_enable = Array(
            "form_brand" => true,
            "form_name" => true,
            "form_image" => false,
            "form_recomended_vehicle" => false,
            "form_desc" => false,
            
            "form_detail_info" => false,
            "form_additional_info" => false,
            
            "form_ban" => false,
            "form_oli" => false,
            "form_aki" => false,
            "form_vehicle" => true,
            
            
        );
		$this->view_enable			= Array(
										"view_recomended"	=> false,
								      );
									  
        $config['upload_path']      = "./".$this->image_path.$this->main_table."_image/";
        $config['allowed_types']    = 'gif|jpg|png';
        $config['encrypt_name']     = TRUE;
        $this->load->library('upload', $config);
        
        $this->load->model("system_queries_model");
		$this->load->model("additional_info_model");
    }
    
    //---INTERFACE---
    public function index(){
		$data	= $this->additional_info_model->additional_data();
		$data  += $this->view_enable;
		
        $custom_query = "SELECT ".$this->main_table."_".$this->section.".id,  brand.name as brand, ".$this->main_table."_".$this->section.".name , ".$this->main_table."_".$this->section.".type
                         FROM ".$this->main_table."_".$this->section.",brand 
                         WHERE brand.id=".$this->main_table."_".$this->section."    .brand_id 
                         ORDER BY brand.id,".$this->main_table."_".$this->section.".name  ASC";
        
        if($query = $this->system_queries_model->custom_query($custom_query)){
            $data["fields"]             = $query->list_fields();
            $data["records"]            = $query->result();
            //$data["section_image_path"]   = $this->section_image_path;
        }
        $data["item_type"] = $this->item_type;
        
        $this->load->view("element/head",$data);
        $this->load->view("item_view",$data);
        $this->load->view("element/foot",$data);
    }
    
    public function add(){
        $data				= $this->additional_info_model->additional_data();
        $data      		       += $this->form_enable;

        $q_brand			= "SELECT id,name FROM brand WHERE brand_for LIKE '%,".$this->brand_index.",%' ORDER BY name ASC";
        $q_oli                          = "SELECT brand.name as brand_name, item.id,item.name, item_oli.id as oli_id, item_oli.liter as oli_liter FROM brand,item,item_oli WHERE brand.id=item.brand_id AND item_oli.item_id=item.id AND type = 'oli' ORDER BY brand.name,item.name ASC";
        $q_aki                          = "SELECT brand.name as brand_name, item.id,item.name, item_aki.id as aki_id, item_aki.ampere as aki_ampere FROM brand,item,item_aki WHERE brand.id=item.brand_id AND item_aki.item_id=item.id AND type = 'aki' ORDER BY brand.name,item.name ASC";
		
        $query_brand 		= $this->system_queries_model->custom_query($q_brand);
        $data["brand"]  	= $query_brand->result();
		
        
        $query_oli 		= $this->system_queries_model->custom_query($q_oli);
        $data["oli"]            = $query_oli->result();
        
        $query_aki 		= $this->system_queries_model->custom_query($q_aki);
        $data["aki"]            = $query_aki->result();
        
        $data["item_type"] = $this->item_type;
        
        $this->load->view("element/head",$data);
        $this->load->view("item_add_view",$data);
        $this->load->view("element/foot",$data);
    }
    
     public function edit($id){
        $data			= $this->additional_info_model->additional_data();
        $data                  += $this->form_enable;

        $q_item			= "SELECT * FROM ".$this->main_table."_".$this->section." WHERE id = ".$id;
        $q_brand		= "SELECT id,name FROM brand WHERE brand_for LIKE '%,".$this->brand_index.",%' ORDER BY name ASC";
        $q_oli                          = "SELECT brand.name as brand_name, item.id,item.name, item_oli.id as oli_id, item_oli.liter as oli_liter FROM brand,item,item_oli WHERE brand.id=item.brand_id AND item_oli.item_id=item.id AND type = 'oli' ORDER BY brand.name,item.name ASC";
        $q_aki                          = "SELECT brand.name as brand_name, item.id,item.name, item_aki.id as aki_id, item_aki.ampere as aki_ampere FROM brand,item,item_aki WHERE brand.id=item.brand_id AND item_aki.item_id=item.id AND type = 'aki' ORDER BY brand.name,item.name ASC";
	
        $query_item		= $this->system_queries_model->custom_query($q_item);
        $data["item_vehicle"]   = $query_item->result();
	
        $query_brand 		= $this->system_queries_model->custom_query($q_brand);
        $data["brand"]  	= $query_brand->result();
        
        $query_oli 		= $this->system_queries_model->custom_query($q_oli);
        $data["oli"]            = $query_oli->result();
        
        $query_aki 		= $this->system_queries_model->custom_query($q_aki);
        $data["aki"]            = $query_aki->result();	
        $data["section_image_path"]   = $this->section_image_path;
        $data["item_type"] = $this->item_type;
        
        $this->load->view("element/head",$data);
        $this->load->view("item_edit_view",$data);
        $this->load->view("element/foot",$data);
    }
    
    
    //---CREATE UPDAET DELETE---
    public function create(){
        //bebek = 1, matic = 2, sport = 3 
        $data = array(
                    "brand_id"          => $this->input->post("brand_id"),
                    "type"              => $this->input->post("vehicle_type"),
                    "name"              => $this->input->post("name"),
                    "front"             => $this->input->post("front_width")."/".$this->input->post("front_ratio"),
                    "back"              => $this->input->post("back_width")."/".$this->input->post("back_ratio"),
                    "rim"               => $this->input->post("rim"),
                    "liter"             => $this->input->post("liter"),
                    "ampere"            => $this->input->post("ampere"),
                    "recomended_oli"    => $this->input->post("recomended_oli"),
                    "recomended_aki"    => $this->input->post("recomended_aki"),
                    
                    
                );
        
        $this->system_queries_model->create($this->main_table."_".$this->section, $data);
        redirect(base_url()."index.php/item_".$this->section);
        
    } 
    
    public function update(){
        
        $data = array(
                    "brand_id"  => $this->input->post("brand_id"),
                    "name"              => $this->input->post("name"),
                    "front"             => $this->input->post("front_width")."/".$this->input->post("front_ratio"),
                    "back"              => $this->input->post("back_width")."/".$this->input->post("back_ratio"),
                    "rim"               => $this->input->post("rim"),
                    "liter"             => $this->input->post("liter"),
                    "ampere"            => $this->input->post("ampere"),
                    "recomended_oli"    => $this->input->post("recomended_oli"),
                    "recomended_aki"    => $this->input->post("recomended_aki"),
                );
        
        $this->system_queries_model->update_row($this->main_table."_".$this->section, $this->input->post("id"), $data);
        redirect(base_url()."index.php/item_".$this->section);
    }
    
    public function delete($id){
        $this->system_queries_model->delete_row($this->main_table."_".$this->section,$id);
        redirect(base_url()."index.php/item_".$this->section);
    }
}
?>
