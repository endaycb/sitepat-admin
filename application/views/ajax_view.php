<?php

$segment1 = $this->uri->segment(1);
$segment2 = $this->uri->segment(2);

if($segment2=="page"){
    $col_name   = array();
    $col_count  = 0;
    $a          = 0;
    $b          = 0;
    
    
    $i  = 1;
    foreach($column_names as $row){
        $i++;
    }
    
    $col_count = $i-1;
    echo $col_count."||";
    
    foreach($count as $row){
        echo $row->count."||";
    }
    echo "--||";
    
    foreach($column_names as $row){
        $col_name[$a] = $row;
        echo $row."||";
        $a++;
    }
    echo "--||";
    
    foreach ($records as $row) {
        for($c = 0; $c < $col_count; $c++){
            echo $row->{$col_name[$c]}."||";
        }
        echo "-||";
        if($c == $col_count){
            $c=0;
        }
        
    }
    echo "||--||";
    echo $this->pagination->create_links();

}else if($segment2=="search_filter"){
    $col_name   = array();
    $col_count  = 0;
    $a          = 0;
    $b          = 0;
    
    $i  = 1;
    foreach($column_names as $row){
        $i++;
    }
    
    $col_count = $i-1;
    echo $col_count."||";
    
    
    foreach($count as $row){
        echo $row->count."||";
    }
    echo "--||";
    
    foreach($column_names as $row){
        $col_name[$a] = $row;
        echo $col_name[$a]."||";
        $a++;
    }
    echo "--||";
    
    foreach ($records as $row) {
        for($c = 0; $c < $col_count; $c++){
            echo $row->{$col_name[$c]}."||";
        }
        echo "-||";
        if($c == $col_count){
            $c=0;
        }
        
    }
}else if($segment2=="pages" && $segment1=="newest" || $segment2=="pages" && $segment1=="recomended" || $segment2=="pages" && $segment1=="event_promo"){
    echo count($records);
    echo "|||";
    
    if($segment1=="newest" || $segment1=="recomended"){
        $custable = array("image","title","id","price","id","author","synopsis");
        
    }else if($segment1 == "event_promo"){
        $custable = array("id","image","title","type","description","date_time");
    }    
    
    foreach($records as $row){
        
        for($a=0;$a<count($custable);$a++){
            
            if($custable[$a]=="price") echo number_format($row->{$custable[$a]},2);
            else if($custable[$a]=="description" || $custable[$a]=="synopsis") echo substr($row->{$custable[$a]},0,100);
            else echo $row->{$custable[$a]};
            
            if($a<count($custable)-1){
                echo "||";
            }
            else{
                echo "|-|";
            }
        }
    }
    echo "-|||";
    echo $this->pagination2->create_links();
    
}else if($segment2=="search_id"){
    foreach($record as $row){
        echo $row->image."||";
        echo $row->title."||";
        echo $row->author."||";
        echo $row->release_year."||";
        echo $row->publisher."||";
        echo $row->pages."||";
        echo $row->edition."||";
        echo number_format($row->price,2)."||";
        echo $row->synopsis."||";
        
    }
   
}
?>

