<?php
class Additional_info_model extends CI_Model{
    var $db_menu        = "back_menu";
    var $db_sub_menu    = "back_sub_menu";
    
    public function __construct(){
        parent::__construct();
		
		$this->menu_groups          = Array("back","front");
		$this->load->library("session");
        $this->load->model("system_queries_model");
    }
    
	
	function additional_data(){
		for($i = 0; $i < count($this->menu_groups); $i++){
            $menu_groups    = $this->menu_groups;
            
        //    if($this->session->userdata("loged_in")!=TRUE){
                $q_menus    = "SELECT * "
                            . "FROM menus "
                            . "WHERE back_front = ".($i+1)." /* and auth = 0 */ "
                            . "ORDER BY position ASC ";
                
           /* }else{
                $q_menus    = "SELECT roles_detail.*, menus.* "
                            . "FROM roles_detail, menus "
                            . "WHERE menus.id=roles_detail.menus_id AND roles_detail.roles_id = ".$this->session->userdata("user_role")." AND menus.back_front = ".($i+1)." "
                            . "ORDER BY menus.position ASC ";
            }*/
            
            $retrieve_menus   = $this->system_queries_model->custom_query($q_menus);
            
            $data["menus_".$menu_groups[$i]]  =  $retrieve_menus->result();
            
        }
        
        return $data;
	}
	
	function page_auth($page, $main_sub, $back_front){
        $page_auth  = FALSE;
        
        $q  = "SELECT auth FROM ".$main_sub." WHERE url = '".$page."' and back_front= ".$back_front." ";
        
        $query  = $this->system_queries_model->custom_query($q);
       
        foreach($query->result() as $row){
            if($row->auth == 1 && $this->session->userdata("user_role") == TRUE){
                
                $q_ =   "SELECT ".$main_sub.".auth, roles_detail.* "
                        . "FROM roles_detail, ".$main_sub." "
                        . "WHERE ".$main_sub.".id=roles_detail.".$main_sub."_id AND ".$main_sub.".url = '".$page."' and roles_detail.roles_id = ".$this->session->userdata("user_role")." ";
                
                $query_ = $this->system_queries_model->custom_query($q_);
                $qq     = $query_->result();
             
                if(isset($qq)){
                    foreach($query_->result() as $row_){
                    if($row_->auth == 1){
                        $page_auth = TRUE;
                        $data["permission"] = $row_->permission;
                        
                    }else{
                        $page_auth  = FALSE;
                        
                    }
                }
                }else{
                    $page_auth  = FALSE;
                }
                
                
            }else if($row->auth == 1 && $this->session->userdata("user_role") == FALSE){
                 $page_auth  = FALSE;
                 
            }else{
                 $page_auth  = TRUE;
                 $data["permission"] = 1;
                 
            }
        }
        
        if($page_auth == FALSE){
            redirect("http://localhost/index.php/home");
        }else{
            return $data["permission"];
        }
       
    }
	
    function select_dynamic($for=1,$tables=null,$fields=null,$where=null,$order=null,$limit_start="0",$limit_end=null){
        if(!empty($fields)) $a = "SELECT ".$fields." "; else $a = "";
        if(!empty($tables)) $b = "FROM ".$tables." "; else $b = "";
        if(!empty($where)) $c = "WHERE ".$where." "; else $c = "";
        if(!empty($order)) $d = "ORDER BY ".$order." "; else $d = "";
        if(!empty($limit_end)) $e = "LIMIT ".$limit_start." , ".$limit_end." "; else $e = "";
        
        $query = $this->db->query($a.$b.$c.$d.$e);
       
        if($for == 1) return $query->result();
        else return $query->list_fields();
        
    }
    
    function select_menu(){
        $query = $this->db->query("SELECT * FROM ".$this->db_menu."
                                   WHERE active=1
                                   ORDER BY position ASC");
        return $query->result();
    }
    
    function select_sub_menu($menu_id){
        $query = $this->db->query("SELECT * FROM ".$this->db_sub_menu."
                                   WHERE back_menu_id=".$menu_id." and active=1
                                   ORDER BY position ASC");
        return $query->result();
    }
    
    function arrange_array_field($field_value=null){
        $i      	= 0;
	$delimiter 	= ",";
        $value  	= $delimiter;
        
        if($field_value != null){
            foreach($field_value as $row){
                $value   .= $row.$delimiter;
                $i++;
            }
        }
                
        return $value;
    }
    
    function replace_duplicate_array($array,$q){
        
        $string   = ",";
        for($a = 0; $a < count($recomended_item); $a++){
            $q_recomended_brand     = $q.$array[$a]; 
            
            $string_       = $this->system_queries_model->custom_query($q_recomended_brand);
            $string_       = $string_->result();
            
            foreach($string_ as $row){
                $string       .= $row->brand_id.",";
            }
            
        }
        $string = implode(',',array_unique(explode(',', $string))).",";
    }
}
?>