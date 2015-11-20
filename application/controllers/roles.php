<?php
class Roles extends CI_Controller{
    var $main_table;
    var $sub_table;
    var $section;
    var $image_path;
    var $section_image_path;
    var $date_time;
    var $date;
    var $menus;
    public function __construct() {
        parent::__construct();
        $this->main_table           = "roles";
        $this->sub_table            = "roles_detail";
        $this->section              = "roles";
        $this->date_time            = date("Y-m-d H:i:s");
        $this->date                 = date("Y-m-d");
        $this->image_path           = "dist/img/";
        $this->section_image_path   = base_url().$this->image_path.$this->section."_image/";
        $this->menus                = Array("back","front");
        
        
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
	   
        if($query = $this->system_queries_model->read($this->main_table)){
            $data["fields"]             = $query->list_fields();
            $data["records"]            = $query->result();
            $data["section_image_path"] = $this->section_image_path;
        }
       
        $this->load->view("element/head",$data);
        $this->load->view($this->section."_view",$data);
        $this->load->view("element/foot",$data);
    }
    
    public function add(){
    	$data	= $this->additional_info_model->additional_data();
	    
        for($i = 1; $i <= count($this->menus); $i++){
            $menus_     = $this->menus[($i-1)];
            $q_menus    = "SELECT * FROM menus "
                        . "WHERE back_front =".$i." "
                        . "ORDER BY position ASC"; 
            
            if($query   = $this->system_queries_model->custom_query($q_menus)){
                $data["menus_".$menus_]             = $query->result();
                $data["menus_".$menus_."_count"]    = $query->num_rows();
                
                $a  = 1;

                foreach($data["menus_".$menus_] as $row){
                    if($row->url == "#" || $row->url == ""){
                        $q_menus_sub    = "SELECT * FROM menus_sub "
                                        . "WHERE menus_id =".$row->id." "
                                        . "ORDER BY position ASC";

                        if($query2   = $this->system_queries_model->custom_query($q_menus_sub)){
                             $data["menus_sub_".$menus_."_".$a] = $query2->result();
                        }

                        $a++;
                    }
                    
                }
            }
        }
        
        $this->load->view("element/head",$data);
        $this->load->view($this->section."_add_view",$data);
        $this->load->view("element/foot",$data);
    }
    
    public function edit($id){
		$data	= $this->additional_info_model->additional_data();
	
        if($query = $this->system_queries_model->read_by_id($this->main_table, $id)){
            $data["record"] = $query->result();
        }
        
        for($i = 1; $i <= count($this->menus); $i++){
            $menus_     = $this->menus[($i-1)];
            $q_menus    = "SELECT * FROM menus "
                        . "WHERE back_front =".$i." "
                        . "ORDER BY position ASC"; 
            
            if($query   = $this->system_queries_model->custom_query($q_menus)){
                $data["menus_".$menus_]             = $query->result();
                $data["menus_".$menus_."_count"]    = $query->num_rows();
                
                $a  = 1;

                foreach($data["menus_".$menus_] as $row){
                    if($row->url == "#" || $row->url == ""){
                        $q_menus_sub    = "SELECT * FROM menus_sub "
                                        . "WHERE menus_id =".$row->id." "
                                        . "ORDER BY position ASC";

                        if($query2   = $this->system_queries_model->custom_query($q_menus_sub)){
                             $data["menus_sub_".$menus_."_".$a] = $query2->result();
                        }

                        $a++;
                    }
                    
                }
            }
        }
        
        $this->load->view("element/head",$data);
        $this->load->view($this->section."_edit_view", $data);
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
        $back_end       = null;
        $front_end      = null;
        
        //INPUT ROLES
        $data = array(
                    "name"      => $this->input->post("name"),
                    "desc"      => $this->input->post("desc"),
                );
        
        $this->system_queries_model->create($this->main_table, $data);
            //INPUT ROLES DETAIL
            $q_last_roles   = "SELECT id "
                            . "FROM roles "
                            . "ORDER BY id DESC "
                            . "LIMIT 0,1";
            
            if($query   = $this->system_queries_model->custom_query($q_last_roles)){
                foreach($query->result() as $row){
                    
                    for($i = 1; $i <= count($this->menus); $i++){
                        $menus_             = $this->menus[($i-1)];
                        $end_form           = $this->input->post($menus_."_end");
                        $main_end_form      = $this->input->post("main_".$menus_."_end");
                        
                        
                        for($x = 0; $x < count($main_end_form); $x++){
                            $main_end_active    = $this->input->post("main_".$menus_."_end_active_".$x);
                        
                            if($main_end_active!=false){
                                $data_main = array(
                                            "roles_id"      => $row->id,
                                            "permission"    => $main_end_form[$x],
                                            "main_or_sub"   => 1,
                                            "menus_id"      => $main_end_active,
                                            "menus_sub_id"  => 0
                                        );
                                $this->system_queries_model->create($this->sub_table, $data_main);
                                
                            }
                        }
                        
                        for($a = 0; $a < count($end_form); $a++){
                            $end_active = $this->input->post($menus_."_end_active_".$a);
                            
                            if($end_active!=false){
                                $data_sub = array(
                                            "roles_id"      => $row->id,
                                            "permission"    => $end_form[$a],
                                            "main_or_sub"   => 2,
                                            "menus_id"      => 0,
                                            "menus_sub_id"  => $end_active
                                        );
                                $this->system_queries_model->create($this->sub_table, $data_sub);
                               
                            }
                        }
                    }
                }
            }
        //$this->system_queries_model->create($this->main_table, $data);
        redirect(base_url()."index.php/".$this->section);
    } 
    
    
    public function update(){
        $back_end       = null;
        $front_end      = null;
        $back_end_form  = $this->input->post("back_end");
        $front_end_form = $this->input->post("front_end");
        
        for($a = 0; $a < count($back_end_form); $a++){
            $back_end_active = $this->input->post("back_end_active_".$a);
            if($back_end_active!=false){
                $back_end .= $back_end_form[$a];
            }else{
                $back_end .= "0";
            }
        }
        
        for($a = 0; $a < count($front_end_form); $a++){
            $front_end_active = $this->input->post("front_end_active_".$a);
            if($front_end_active!=false){
                $front_end .= $front_end_form[$a]; 
            }else{
                $front_end .= "0";
            }
        }
        
         
        $data = array(
                    "name"      => $this->input->post("name"),
                    "desc"      => $this->input->post("desc"),
                    "back_end"  => $back_end,
                    "front_end" => $front_end
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
