<?php

class Item_ban extends CI_Controller {

    var $main_table;
    var $section;
    var $form_enable;

    public function __construct() {
        parent::__construct();
        $this->main_table = "item";
        $this->section = "ban";
        $this->item_type = "ban";
        $this->brand_index = "1";
        $this->image_path = "dist/img/";
        $this->section_image_path = base_url() . $this->image_path . $this->main_table . "_image/";
        $this->form_enable = Array(
            "form_brand" => true,
            "form_name" => true,
            "form_image" => true,
            "form_recomended_vehicle" => true,
            "form_desc" => true,
            
            "form_detail_info" => true,
            "form_additional_info" => true,
            
            "form_ban" => true,
            "form_oli" => false,
            "form_aki" => false,
            "form_vehicle" => false,
        );
        $this->view_enable = Array(
            "view_recomended" => true,
        );

        $config['upload_path'] = "./" . $this->image_path . $this->main_table . "_image/";
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);


        $this->load->model("system_queries_model");
        $this->load->model("additional_info_model");
    }

    //---INTERFACE---
    public function index() {
        $data = $this->additional_info_model->additional_data();
        $data += $this->view_enable;

        $custom_query = "SELECT " . $this->main_table . ".id,  brand.name as brand, " . $this->main_table . ".name,  " . $this->main_table . ".recomended 
                         FROM " . $this->main_table . ",brand 
                         WHERE brand.id=" . $this->main_table . ".brand_id and type='" . $this->item_type . "'
                         ORDER BY brand.name, " . $this->main_table . ".name  ASC";
        
        if ($query = $this->system_queries_model->custom_query($custom_query)) {
            $data["fields"] = $query->list_fields();
            $data["records"] = $query->result();
            //$data["section_image_path"]   = $this->section_image_path;
        }
        $data["item_type"] = $this->item_type;

        $this->load->view("element/head", $data);
        $this->load->view("item_view", $data);
        $this->load->view("element/foot", $data);
    }

    public function add() {
        $data = $this->additional_info_model->additional_data();
        $data += $this->form_enable;

        $q_brand = "SELECT id,name FROM brand WHERE brand_for LIKE '%," . $this->brand_index . ",%' ORDER BY name ASC";
        $q_vehicle = "SELECT brand.name as brand_name, item.id,item.name FROM brand,item WHERE brand.id=item.brand_id AND type = 'vehicle' ORDER BY brand.name,item.name ASC";

        $query_brand = $this->system_queries_model->custom_query($q_brand);
        $data["brand"] = $query_brand->result();

        $query_vehicle = $this->system_queries_model->custom_query($q_vehicle);
        $data["vehicle"] = $query_vehicle->result();

        $data["item_type"] = $this->item_type;

        $this->load->view("element/head", $data);
        $this->load->view("item_add_view", $data);
        $this->load->view("element/foot", $data);
    }

    public function edit($id) {
        $data = $this->additional_info_model->additional_data();
        $data += $this->form_enable;

        $q_item = "SELECT * FROM item WHERE id = " . $id;
        $q_brand = "SELECT id,name FROM brand WHERE brand_for LIKE '%," . $this->brand_index . ",%' ORDER BY name ASC";
        $q_vehicle = "SELECT brand.name as brand_name, item.id,item.name FROM brand,item WHERE brand.id=item.brand_id AND type = 'vehicle' ORDER BY brand.name,item.name ASC";
        $q_detail_item  = "SELECT * FROM ".$this->main_table."_".$this->section." WHERE item_id = '".$id."' ORDER BY id ASC";
        
        $query_item = $this->system_queries_model->custom_query($q_item);
        $data["item"] = $query_item->result();

        $query_brand = $this->system_queries_model->custom_query($q_brand);
        $data["brand"] = $query_brand->result();

        $query_vehicle = $this->system_queries_model->custom_query($q_vehicle);
        $data["vehicle"] = $query_vehicle->result();

        $query_detail_item = $this->system_queries_model->custom_query($q_detail_item);
        $data["item_detail"] = $query_detail_item->result();
        $data["row_item_detail"] = $query_detail_item->num_rows();
        
        
        $data["section_image_path"] = $this->section_image_path;
        $data["item_type"] = $this->item_type;

        $this->load->view("element/head", $data);
        $this->load->view("item_edit_view", $data);
        $this->load->view("element/foot", $data);
    }
    
    //---CREATE UPDAET DELETE---
    public function create() {
        $simple_desc        = $this->input->post("simple_desc");
        $tube_type          = $this->input->post("tube_type");
//        $size_type          = $this->input->post("size_type");
        $width              = $this->input->post("width");
        $ratio              = $this->input->post("ratio");
        $diameter           = $this->input->post("diameter");
        $recomended_item    = $this->input->post("recomended_item");
        
        // INSERT ITEM
        $data = array(
            "brand_id" => $this->input->post("brand_id"),
            "type" => $this->input->post("type"),
            "name" => $this->input->post("name"),
            "recomended_item" => $this->additional_info_model->arrange_array_field($recomended_item),
            "desc" => $this->input->post("ck"),
        );
        
        if ($this->upload->do_upload('image')) {
            $image_data = $this->upload->data();
            $image_name = $image_data['file_name'];

            $data["image"] = $image_name;
        }
        $this->system_queries_model->create($this->main_table, $data);
        
        // GET LAST ID ITEM
        $q_item     =   "SELECT id FROM ".$this->main_table." WHERE type = '".$this->section."' ORDER BY id DESC LIMIT 0,1";
        $item       =   $this->system_queries_model->custom_query($q_item);
        foreach($item->result() as $row){
            $last_id    =   $row->id;
            
             // INSERT DETAIL ITEM
            for($a = 0; $a < count($tube_type)  ; $a++){

                $data_detail    =   Array(
                                        "item_id"   => $last_id,
                                        "tube_type" => $tube_type[$a],
                                        "size"      => $width[$a]."/".$ratio[$a],
                                        "diameter"  => $diameter[$a],
                                        "desc"      => $simple_desc[$a],
                                    );
                $this->system_queries_model->create($this->main_table."_".$this->section, $data_detail);
                
            }
        }
       
        
        redirect(base_url() . "index.php/item_" . $this->section);
    }

    public function update() {
       /* $simple_desc        = $this->input->post("simple_desc");
        $tube_type          = $this->input->post("tube_type");
        $size_type          = $this->input->post("size_type");
        $width              = $this->input->post("width");
        $ratio              = $this->input->post("ratio");
        $diameter           = $this->input->post("diameter");
        $recomended_item    = $this->input->post("recomended_item");
        
        // INSERT ITEM
        $data = array(
            "brand_id" => $this->input->post("brand_id"),
            "type" => $this->input->post("type"),
            "name" => $this->input->post("name"),
            "recomended_item" => $this->additional_info_model->arrange_array_field($recomended_item),
            "desc" => $this->input->post("ck"),
        );
       
        if ($this->upload->do_upload('image')) {
            $image_data = $this->upload->data();
            $image_name = $image_data['file_name'];

            $data["image"] = $image_name;
        }
        
        for($a = 0; $a < count($tube_type)  ; $a++){

            $data_detail    =   Array(
                                    "item_id"   => $last_id,
                                    "tube_type" => $tube_type[$a],
                                    "size_type" => $size_type[$a],
                                    "width"     => $width[$a],
                                    "ratio"     => $ratio[$a],
                                    "diameter"  => $diameter[$a],
                                    "desc"      => $simple_desc[$a],
                                );
            $this->system_queries_model->create($this->main_table."_".$this->section, $data_detail);

        }
        
        $this->system_queries_model->update_row($this->main_table, $this->input->post("id"), $data);
        redirect(base_url() . "index.php/item_" . $this->section);*/
        
         $id = $this->input->post("id");
         $item  = new Item_ban;
         
         $delete_item       = $this->system_queries_model->delete_row($this->main_table, $id);
         $delete_detail     = $this->system_queries_model->custom_query("DELETE FROM ".$this->main_table."_".$this->section." WHERE item_id = '".$id."'");
         
         $item->create();
    }

    public function delete($id) {
        $this->system_queries_model->delete_row($this->main_table, $id);
        //echo $this->db->last_query();
        $this->system_queries_model->custom_query("DELETE FROM ".$this->main_table."_".$this->section." WHERE item_id = '".$id."'");
        //echo $this->db->last_query();
        redirect(base_url() . "index.php/item_" . $this->section);
    }

    public function change_recomended($id) {
        $q_search_active = "SELECT id,recomended 
                               FROM " . $this->main_table . " 
                               WHERE id = " . $id . " AND recomended = 1";

        $query = $this->system_queries_model->custom_query($q_search_active);
        if ($query->num_rows() < 1)
            $recomended = 1;
        else
            $recomended = 0;

        $q_change = "UPDATE " . $this->main_table . " 
                          SET recomended = " . $recomended . "
                          WHERE id=" . $id;

        $this->system_queries_model->custom_query($q_change);
        redirect(base_url() . "index.php/item_" . $this->section);
    }

}

?>
