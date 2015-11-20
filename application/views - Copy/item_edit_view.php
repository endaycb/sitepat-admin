<?php

$id;
$brand_id;
$type;
$name;
$price;
$size;
$image;


if(isset($item)){
    foreach($item as $row){
        $id         		= $row->id;
        $brand_id   		= $row->brand_id;
        $type       		= $row->type;
        $name       		= $row->name;
        $price      		= $row->price;
        $image      		= $row->image;
		$recomended_item	= $row->recomended_item;
        
        if($recomended_item != NULL){
            $recomended_item  = explode(",", $recomended_item);
        }
		
        if($type == "ban"){
            $size_type  = $row->size_type;
            $tube_type  = $row->tube_type;
            
            $info_item_value     = explode("/", $row->size);
            $info_item_value2    = explode("-", $info_item_value[1]);

            $width          = $info_item_value[0];
            $width_compare  = $info_item_value2[0];
            $diameter       = $info_item_value2[1];

            $info_item = "Size";
        }
            
            
            
        
         
    }
}else{
  //  redirect(base_url()."index.php/item_".$this->section);
}

?>   
<div class="container-fluid" id="content">
    <div id="main">
        <div class="container-fluid">
            <div class="row-fluid">
		<div class="span12">
                    <div class="box box-bordered">
                        <div class="box-title">
                            <h3><i class="icon-th-list"></i> Edit <?php echo $type." ".$name?></h3>
                        </div>
                        <div class="box-content nopadding">
                            <form action="<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1)?>/update" method="POST" class='form-horizontal form-striped' enctype="multipart/form-data">
							
								<?php if($form_brand == true){?>
                                <div class="control-group">
                                        <label  class="control-label">Brand</label>
                                        <div class="controls">
                                                <div class="input-xlarge">
                                                    <select name="brand_id" id="brand" class='chosen-select'>
                                                        <?php
                                                            if(isset($brand)){
                                                                foreach($brand as $row){
                                                        ?>
                                                            <option value="<?php echo $row->id?>" <?php if($row->id == $brand_id) echo "selected"?>><?php echo $row->name?></option>
                                                        <?php }} ?>
                                                    </select>
                                                </div>
                                        </div>
                                </div>
								<?php } ?>
								
								<?php if($form_name == true){?>
                                <div class="control-group">
                                    <label class="control-label">Name</label>
                                    <div class="controls">
                                        <input required type="text" name="name" value="<?php echo $name?>" id="textfield" placeholder="Name" class="input-xlarge"/>
                                    </div>
                                </div>
								<?php } ?>
								
								<?php if($form_price == true){?>
                                <div class="control-group">
                                    <label class="control-label">Price</label>
                                    <div class="controls">
                                        <div class="input-append">
                                            <span class="add-on">Rp. </span>
                                            <input type="text" placeholder="0" name="price" value="<?php echo $price?>" class='input-small' required >
                                            <span class="add-on">.00</span>
                                        </div>
                                    </div>
                                </div>
								<?php } ?>
								
                                 <?php if($form_tube_type == true){?>
                                 <div class="control-group">
                                        <label  class="control-label">Tube Type</label>
                                        <div class="controls">
                                                <div class="input-xlarge">
                                                    <select name="tube_type" id="tube_type" class='chosen-select'>
                                                        
                                                            <option value="1" <?php if($tube_type == 1) echo "selected"?>>Tube</option>
                                                            <option value="2" <?php if($tube_type == 2) echo "selected"?>>Tube Less</option>
                                                        
                                                    </select>
                                                </div>
                                        </div>
                                </div>
								<?php } ?>
								
								<?php if($form_size_type == true){?>
                                <div class="control-group">
                                        <label  class="control-label">Size Type</label>
                                        <div class="controls">
                                                <div class="input-xlarge">
                                                    <select name="size_type" id="size_type" class='chosen-select'>
                                                        
                                                            <option value="1" <?php if($size_type == 1) echo "selected"?>>STANDART</option>
                                                            <option value="2" <?php if($size_type == 2) echo "selected"?>>Besar</option>
                                                            <option value="3" <?php if($size_type == 3) echo "selected"?>>Kecil</option>
                                                        <
                                                    </select>
                                                </div>
                                        </div>
                                </div>
								<?php } ?>
								
								<?php if($form_size == true){?>
                                <div class="control-group" id="size">
                                        <label class="control-label">Size</label>
                                        <div class="controls">
                                            <input required name="width" id="size1" class='input-small' placeholder="00" value="<?php echo $width ?>"> 
                                            /
                                            <input required name="width_compare" id="size2" class='input-small' placeholder="00" value="<?php echo $width_compare ?>">
                                            -
                                            <input required name="diameter" id="size2" class='input-small' placeholder="00" value="<?php echo $diameter ?>">
                                              
                                            <input type="hidden" name="type" value="ban">
                                        </div>
                                </div>
                                <?php } ?>
                                
								 <?php if($form_image == true){?>
                                <div class="control-group">
                                        <label for="textfield" class="control-label">Image</label>
                                        <div class="controls">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<?php if($image!=""){ echo $section_image_path.$image;}else {?>http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image<?php } ?>" /></div>
                                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                        <div>
                                                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input  type="file" name='image' /></span>
                                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
								<?php } ?>
								
								 <?php if($form_recomended_vehicle == true){?>
								  <div class="control-group">
                                    <label for="recomended_item" class="control-label">Recomended Vehicle</label>
                                    <div class="controls">
                                        <div class="input-xlarge">
                                            <div id="region_form" >
                                                <select name="recomended_item[]" id="recomended_item" multiple="multiple" class="chosen-select input-xxlarge" >
													<?php
													if(isset($vehicle)){
														foreach($vehicle as $row){
													?>
														<option value="<?php echo $row->id?>" <?php for($a=0; $a<count($recomended_item); $a++){ if($row->id == $recomended_item[$a])echo "selected" ; }?>><?php echo $row->name?></option>
													<?php }} ?>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
								<?php } ?>
                                <div class="form-actions">
                                        <input type="hidden" name="id" value="<?php echo $id?>" >
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        <a href="<?php echo base_url()."index.php/".$this->uri->segment(1)?>" class="btn">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>