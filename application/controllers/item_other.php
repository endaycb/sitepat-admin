<?php
class Item_other extends CI_Controller{
    var $main_table;
    var $section;
    
    public function __construct() {
        parent::__construct();
        $this->main_table           = "item";
        $this->section              = "other";
        $this->item_type            = "other";
        $this->image_path           = "dist/img/";
        $this->section_image_path   = base_url().$this->image_path.$this->main_table."_image/";
        $this->form_enable			= Array(
										"form_brand"					=> false,
										"form_name"						=> false,
										"form_price"					=> false,
										"form_tube_type"				=> false,
										"form_size_type"				=> false,
										"form_size"						=> false,
										"form_image"					=> false,
										"form_recomended_vehicle"		=> false,
									  );
		$this->view_enable			= Array(
										"view_recomended"	=> true,
								      );
									  
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
		$data  += $this->view_enable;
		
        $custom_query = "SELECT ".$this->main_table.".id, ".$this->main_table.".type, ".$this->main_table.".name,  ".$this->main_table.".price, ".$this->main_table.".recomended
                         FROM ".$this->main_table.",brand 
                         WHERE type <> 'ban' AND type <> 'oli' AND type <> 'aki'
                         ORDER BY id ASC";
        
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
		$data      		   += $this->form_enable;
		
		$q_brand			= "SELECT id,name FROM brand WHERE brand_for LIKE '%,".$this->brand_index.",%'";
		$q_vehicle			= "SELECT id,name FROM item WHERE type = 'vehicle' ORDER BY name";
		
        $query_brand 		= $this->system_queries_model->custom_query($q_brand);
        $data["brand"]  	= $query_brand->result();
		
        $query_vehicle 		= $this->system_queries_model->custom_query($q_vehicle);
        $data["vehicle"]  	= $query_vehicle->result();
		
        $data["item_type"] = $this->item_type;
        
        $this->load->view("element/head",$data);
        $this->load->view("item_add_view",$data);
        $this->load->view("element/foot",$data);
    }
    
     public function edit($id){
		$data				= $this->additional_info_model->additional_data();
		$data      		   += $this->form_enable;
		
		$q_item				= "SELECT * FROM item WHERE id = ".$id;
		$q_brand			= "SELECT id,name FROM brand WHERE brand_for LIKE '%,".$this->brand_index.",%'";
		$q_vehicle			= "SELECT id,name FROM item WHERE type = 'vehicle' ORDER BY name";
		
		$query_item			= $this->system_queries_model->custom_query($q_item);
		$data["item"]  		= $query_item->result();
		
        $query_brand 		= $this->system_queries_model->custom_query($q_brand);
        $data["brand"]  	= $query_brand->result();
		
        $query_vehicle 		= $this->system_queries_model->custom_query($q_vehicle);
        $data["vehicle"]  	= $query_vehicle->result();
		
        $data["section_image_path"]   = $this->section_image_path;
        $data["item_type"] = $this->item_type;
        
        $this->load->view("element/head",$data);
        $this->load->view("item_edit_view",$data);
        $this->load->view("element/foot",$data);
    }
    //---CREATE UPDAET DELETE---
    public function create(){
         
        $data = array(
                    "brand_id"  		=> $this->input->post("brand_id"),
                    "type"      		=> $this->item_type,
                    "name"      		=> $this->input->post("name"),
                    "price"     		=> $this->input->post("price"),
					"recomended_item"	=> $this->additional_info_model->arrange_array_field($this->input->post("recomended_item")),
                );
        
        if($this->upload->do_upload('image')) {
            $image_data = $this->upload->data();
            $image_name =  $image_data['file_name'];
            
            $data["image"] = $image_name;
         }
        
        $this->system_queries_model->create($this->main_table, $data);
        redirect(base_url()."index.php/".$this->section);
        
    } 
    
    public function update(){
        
        $data = array(
                    "brand_id"  		=> $this->input->post("brand_id"),
                    "type"      		=> $this->item_type,
                    "name"     		    => $this->input->post("name"),
					"recomended_item"	=> $this->additional_info_model->arrange_array_field($this->input->post("recomended_item")),
                );
        
       if($this->upload->do_upload('image')) {
            $image_data = $this->upload->data();
            $image_name =  $image_data['file_name'];
            
            $data["image"] = $image_name;
         }
        $this->system_queries_model->update_row($this->main_table, $this->input->post("id"), $data);
        redirect(base_url()."index.php/".$this->section);
    }
    
    public function delete($id){
        $this->system_queries_model->delete_row($this->main_table,$id);
        redirect(base_url()."index.php/".$this->section);
    }
    
    public function change_recomended($id){
        $q_search_active    = "SELECT id,recomended 
                               FROM ".$this->main_table." 
                               WHERE id = ".$id." AND recomended = 1";
        
        $query  = $this->system_queries_model->custom_query($q_search_active);
        if($query->num_rows() < 1) $recomended = 1;
        else $recomended = 0;
        
        $q_change      = "UPDATE ".$this->main_table." 
                          SET recomended = ".$recomended."
                          WHERE id=".$id;
        
        $this->system_queries_model->custom_query($q_change);
        redirect(base_url()."index.php/item_".$this->section);
    }
}
?>
