<?php
class Profile extends CI_Controller{
    var $main_table;
    var $section;
    var $image_path;
    var $section_image_path;
    
    public function __construct() {
        parent::__construct();
        $this->main_table           = "profile";
        $this->section              = "profile";
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
		
        $q   = "SELECT id, name, office_name, phone, fax, email, status FROM profile";
        
        if($query = $this->system_queries_model->custom_query($q)){
            $data["fields"]             = $query->list_fields();
            $data["records"]            = $query->result();
            $data["section_image_path"] = $this->section_image_path;
        }
        
        $this->load->view("element/head",$data);
        $this->load->view("profile_view",$data);
        $this->load->view("element/foot",$data);
    }
    
    public function add(){
		$data	= $this->additional_info_model->additional_data();
		
        $this->load->view("element/head",$data);
        $this->load->view("profile_add_view",$data);
        $this->load->view("element/foot",$data);
    }
    
    public function edit($id){
		$data	= $this->additional_info_model->additional_data();
		
        if($query = $this->system_queries_model->read_by_id($this->main_table, $id)){
            $data["record"]             = $query->result();
            $data["section_image_path"] = $this->section_image_path;
        }
        $this->load->view("element/head",$data);
        $this->load->view("profile_edit_view",$data);
        $this->load->view("element/foot",$data);
    }
    
    public function change_status($id){
        $q_search_active    = "SELECT id 
                               FROM ".$this->main_table." 
                               WHERE status=1";
        
        $q_active           = "UPDATE profile
                               SET status = 1
                               WHERE id=".$id;
        
        $query  = $this->system_queries_model->custom_query($q_search_active);
        if($query->num_rows() > 0){
            foreach($query->result() as $row){
                $q_deactive      = "UPDATE profile
                                    SET status = 0
                                    WHERE id=".$row->id;

                if($this->system_queries_model->custom_query($q_active)){
                    $this->system_queries_model->custom_query($q_deactive);
                }
            }
        }else{
            $this->system_queries_model->custom_query($q_active);
        }
        
        
        
        redirect(base_url()."index.php/".$this->section);
    }
    //---CREATE UPDAET DELETE---
    public function create(){
        $data = array(
                    "name"          => $this->input->post("name"),
                    "office_name"   => $this->input->post("office_name"),
                    "address"       => $this->input->post("address"),
                    "postalcode"    => $this->input->post("postalcode"),
                    "phone"         => $this->input->post("phone"),
                    "fax"           => $this->input->post("fax"),
                    "email"         => $this->input->post("email"),
                    "desc"          => $this->input->post("desc"),
                    "lat"           => $this->input->post("lat"),
                    "lng"           => $this->input->post("lng"),
                    "history"       => $this->input->post("history"),
                    "vision"        => $this->input->post("vision"),
                    "mision"        => $this->input->post("mision"),
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
                    "name"          => $this->input->post("name"),
                    "office_name"   => $this->input->post("office_name"),
                    "address"       => $this->input->post("address"),
                    "postalcode"    => $this->input->post("postalcode"),
                    "phone"         => $this->input->post("phone"),
                    "fax"           => $this->input->post("fax"),
                    "email"         => $this->input->post("email"),
                    "desc"          => $this->input->post("desc"),
                    "lat"           => $this->input->post("lat"),
                    "lng"           => $this->input->post("lng"),
                    "history"       => $this->input->post("history"),
                    "vision"        => $this->input->post("vision"),
                    "mision"        => $this->input->post("mision"),
                    "concept"       => $this->input->post("concept"),
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
