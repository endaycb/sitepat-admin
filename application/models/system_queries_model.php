<?php

class System_queries_model extends CI_Model{
    
    function read($table){
        $query = $this->db->query("SELECT *
                                   FROM ".$table);
        
        return $query;
    }
    
    function read_all($table){
        $query = $this->db->query("SELECT *
                                   FROM ".$table."
                                   ORDER BY id");
        return $query->result();
    }
    
    function read_by_id($table, $id){
        $query = $this->db->query("SELECT *
                                   FROM ".$table."
                                   WHERE id=".$id);
        
        return $query;
    }
    
    
    function custom_query($q){
        $query = $this->db->query($q);
        
        return $query;
    }
    
    function get_list_fields($table){
        $query = $this->db->query("SELECT *
                                   FROM ".$table."
                                   Limit 0,1");
        
        return $query->list_fields();
    }
    
    function create($table, $data){
        $this->db->insert($table,$data);
    }
    
    function update_row($table, $id, $data){
        $this->db->where("id",$id);
        $this->db->update($table, $data);
    }
    
    function delete_row($table, $id_row){
        $this->db->query("DELETE 
                          FROM ".$table." 
                          WHERE id=".$id_row);
    }
    
   
}

?>