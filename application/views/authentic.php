<?php
class Authentic extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library("session");
        $this->load->model("system_queries_model");
        
        
    }
    public function index(){
        
    }
    public function auth(){
        $username   =  preg_replace("/[^a-z0-9]/i", "all", $this->input->post("username"));
        $password   = md5($this->input->post("password"));
        
        $q_auth = "SELECT * "
                . "FROM users "
                . "WHERE username = '".$username."' and password = '".$password."'";
        
        $q  = $this->system_queries_model->custom_query($q_auth);
        $q  = $q->result();       
        
        if(isset($q)){
            foreach($q as $row){
                $userdata   = Array(
                                "loged_in"  => TRUE,
                                "user_id"   => $row->id,
                                "user_role" => $row->roles_id,
                                "user_name" => $row->name,
                                "user_image"=> $row->image
                              );
                 $this->session->set_userdata($userdata);
                 $this->additional_info_model->back_request();
            } 
        }else{
            $userdata   = Array(
                            "error_message" => "USERNAME atau PASSWORD tidak Valid!"
                          );
        }
        
        
        redirect(base_url()."index.php/".$this->input->post("uri"));
    }
    
    public function logout(){
        $this->session->unset_userdata("loged_in");
        $this->session->unset_userdata("user_id");
        $this->session->unset_userdata("user_role");
        $this->session->unset_userdata("user_name");
        $this->session->unset_userdata("user_image");
        
        redirect(base_url()."index.php/home");
    }
}

?>
