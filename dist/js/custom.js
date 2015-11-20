//var base_url  = "http://192.168.10.41/sitepat_admin/";
//var image_url = "http://192.168.10.41/sitepat_admin/";
//var base_url  = "http://192.168.10.41/sitepat_admin/";
//var image_url = "http://192.168.10.41/sitepat_admin/";
var base_url  = "http://localhost/sitepat_admin/";
var image_url = "http://localhost/sitepat_admin/";

$(document).ready(function(){
								
   var roxyFileman = base_url+'dist/fileman/index.html';
   //for(var x = 1; x <= 2; x++){
       CKEDITOR.replace( 'editor1',{filebrowserBrowseUrl:roxyFileman, 
                                filebrowserUploadUrl:roxyFileman,
                                filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                                filebrowserImageUploadUrl:roxyFileman+'?type=image'}); 

  // }
   
  

    $(".sign_form").click(function(){
        var id = $(this).attr("id");
        
        if($(this).is(":checked")){
            $("#"+id+"_form").attr("style","display:block");
           
        }else{
            $("#"+id+"_form").attr("style","display:none");
        }
    });
    
    $("#type").change(function(){
        if($(this).val() != "ban"){
            $("#size1").removeAttr("required");
            $("#size2").removeAttr("required");
            $("#size1").val("");
            $("#size2").val("");
            $("#size").hide();
        }else{
            $("#size1").attr("required","true");
            $("#size2").attr("required","true");
            $("#size").show();
        }
    });
    
    //DUPLICATE FORM
    
    $(".form_copy_from").click(function(){
        var link        = $(this).attr("link");
        var count       = $("#"+link+"_count").attr("value");
        var count_next  = parseInt(count)+1;
        
        var div_open    = "<div id='"+link+"_"+count_next+"'>";
        var div_close   = "</div>";
        var content     = $("#"+link+"_"+count).html();
        
        
        $("#"+link+"_"+count).after(div_open+content+div_close);
        
        $("#"+link+"_count").attr("value",count_next);
    });
    // END DUPLICATE FORM
    
    //REMOVE FORM
    $(".form_remove_from").click(function(){
        var link        = $(this).attr("link");
        var count       = $("#"+link+"_count").attr("value");
        var count_next  = parseInt(count)-1;
        
        if(count == 1){
            alert("Cannot Delete Anymore");
        }else{
            
            $("#"+link+"_"+count).remove();

            $("#"+link+"_count").attr("value",count_next);
        }
    });
    // END REMOVE FORM
});



function hide_field(field_id){
    $("#"+field_id).hide();
}

function attr_tag(field_id,attribute,attribute_value){
    $("#"+field_id).attr(attribute,attribute_value);
}

function removeAttr_tag(field_id,attribute){
    $("#"+field_id).removeAttr(attribute);
}

function clear_value(field_id){
    $("#"+field_id).val("");
}

