<?php

if(isset($item)){
    foreach($item as $row){
        $id         		= $row->id;
        $brand_id   		= $row->brand_id;
        $name       		= $row->name;
        $image      		= $row->image;
        $recomended_item	= $row->recomended_item;
        $desc                   = $row->desc;
        
        if($recomended_item != NULL){
            $recomended_item  = explode(",", $recomended_item);
        }
    }
}else if(isset($item_vehicle)){
    foreach($item_vehicle as $row){
        $id         		= $row->id;
        $brand_id   		= $row->brand_id;
        $name       		= $row->name;
        $type                   = $row->type;
        $rim                    = $row->rim;
        $front                   = explode("/", $row->front);
        $back                    =  explode("/", $row->back);
        $liter                 = $row->liter;
        $ampere                  = $row->ampere;
        $recomended_oli                  = $row->recomended_oli;
        $recomended_aki                  = $row->recomended_aki;
        
        
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
                            <h3><i class="icon-th-list"></i> Edit <?php echo strtoupper($item_type)." ".$name ?> </h3>
                        </div>
                        <div class="box-content nopadding">

                            <form action="<?php echo base_url() ?>index.php/<?php echo $this->uri->segment(1) ?>/update" method="POST" class='form-horizontal form-striped' enctype="multipart/form-data">
                                			
                                 <div class="control-group">
                                        <label class="">BASIC INFO ITEM</label>
                                    </div>
                                <?php if ($form_brand == true) { ?>
                                    <div class="control-group">
                                        <label  class="control-label">Brand</label>
                                        <div class="controls">
                                            <div class="input-xlarge">
                                                <select name="brand_id" id="brand" class='chosen-select'>
                                                    <?php
                                                    if (isset($brand)) {
                                                        foreach ($brand as $row) {
                                                            ?>
                                                            <option value="<?php echo $row->id ?>" <?php if($brand_id == $row->id) echo "selected"; ?>><?php echo $row->name ?></option>
                                                        <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if ($form_name == true) { ?>
                                    <div class="control-group">
                                        <label class="control-label">Name</label>
                                        <div class="controls">
                                            <input required type="text" name="name" value="<?php echo $name;?>" id="textfield" placeholder="Name" class="input-xlarge"/>
                                        </div>
                                    </div>
                                <?php } ?>
                                
                                <?php if ($form_detail_info == true) { ?> 
                                 <div class="control-group">
                                    <label class="control-label">DETAIL INFO ITEM</label>
                                    <div class="controls">
                                        <div class="form_copy_from btn btn-primary"  link="form_detail"><i class="icon-plus-sign"></i></div>
                                        <div class="form_remove_from btn btn-danger" link="form_detail"><i class="icon-trash"></i></div>
                                        <input type="hidden" value="<?php  echo $row_item_detail;?>" name="detail_count" id="form_detail_count"/>
                                    </div>
                                </div>
                                <?php } ?>
                                
                                <?php //FORM BAN  ?>
                                <?php if ($form_ban == true) { ?>
                                	
                                
                                <div id="form_detail">
                                    <?php 
                                        $a = 1;
                                        foreach($item_detail as $row){
                                            $size   = explode("/", $row->size);
                                    ?>
                                        <div id="form_detail_<?php echo $a;?>">
                                            <div class="control-group">
                                                <label class="">DETAIL INFO</label>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label">Simple Description</label>
                                                <div class="controls">
                                                    <input  type="text"  name="simple_desc[]" value="<?php echo $row->desc?>" id="textfield" placeholder="" class="input-xlarge" maxlength="255"/>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label  class="control-label">Tube Type</label>
                                                <div class="controls">
                                                    <div class="input-xlarge">
                                                        <select name="tube_type[]" id="tube_type">

                                                            <option value="1" <?php if($row->tube_type == 1) echo "selected"; ?>>Tube</option>
                                                            <option value="2" <?php if($row->tube_type == 2) echo "selected"; ?>>Tube Less</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="control-group" id="size">
                                                <label class="control-label">Size</label>
                                                <div class="controls">

                                                    <input required name="width[]" id="size1" class='input-small' placeholder="00" value="<?php echo $size[0]?>" required> 
                                                    /
                                                    <input required name="ratio[]" id="size2" class='input-small' placeholder="00" value="<?php echo $size[1]?>" required>
                                                    -
                                                    <input required name="diameter[]" id="size2" class='input-small' placeholder="00" value="<?php echo $row->diameter?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    <?php $a++; } ?>
                                    
                                </div>
                                
                                <?php } ?>

                                <?php //FORM OLI  ?>

                                <?php if ($form_oli == true) { ?>
                                 <div id="form_detail">
                                    <div id="form_detail">
                                        <?php 
                                            $a = 1;
                                            foreach($item_detail as $row){
                                            
                                                $info_item_value     = explode("-", $row->sae);

                                                $sae1   = (int)$info_item_value[0];
                                                $sae2   = $info_item_value[1];
                                        ?>
                                        
                                        <div id="form_detail_<?php echo $a?>">
                                            <div class="control-group">
                                                <label class="">DETAIL INFO</label>
                                            
                                            </div>
                                             <div class="control-group">
                                                <label class="control-label">Simple Description</label>
                                                <div class="controls">
                                                    <input  type="text"  name="simple_desc[]" value="<?php  echo $row->desc; ?>" id="textfield" placeholder="" class="input-xlarge" maxlength="255"/>
                                                </div>
                                            </div>
                                            
                                            <div class="control-group">
                                                <label class="control-label">SAE</label>
                                                <div class="controls">
                                                    <input required type="text" required name="sae1[]" value="<?php echo $sae1?>" id="textfield" placeholder="" class="input-small"/> W - 
                                                    <input required type="text" required name="sae2[]" value="<?php echo $sae2?>" id="textfield" placeholder="" class="input-small"/>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label">Liter</label>
                                                <div class="controls">
                                                    <input required type="text" required name="liter[]" value="<?php echo $row->liter?>" id="textfield" placeholder="" class="input-small"/>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label  class="control-label">API Service</label>
                                                <div class="controls">
                                                    <div class="input-xlarge">
                                                        <select name="service[]" id="service">

                                                            <option value="1" <?php if($row->service == 1) echo "selected"; ?>>JASO MA</option>
                                                            <option value="2" <?php if($row->service == 2) echo "selected"; ?> >JASO MB</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $a++; }?>
                                    </div>
                                 </div>
                                <?php } ?>

                                <?php //FORM AKI  ?>

                                <?php if ($form_aki == true) { ?>
                                    <div  id="form_detail">
                                    <?php 
                                        $a = 1;
                                        foreach($item_detail as $row){
                                    ?>
                                        <div id="form_detail_<?php echo $a;?>">
                                            <div class="control-group">
                                                <label class="">DETAIL INFO</label>
                                            </div>
                                            
                                             <div class="control-group">
                                                <label class="control-label">Simple Description</label>
                                                <div class="controls">
                                                    <input  type="text" name="simple_desc[]" value="<?php echo $row->desc?>" id="textfield" placeholder="" class="input-xlarge" maxlength="255"/>
                                                </div>
                                            </div>
                                            
                                            <div class="control-group">
                                                <label  class="control-label">AKI Type</label>
                                                <div class="controls">
                                                    <div class="input-xlarge">
                                                        <select name="aki_type[]" id="aki_type">

                                                            <option value="1" <?php if($row->aki_type == 1) echo "selected";?>>Basah</option>
                                                            <option value="2" <?php if($row->aki_type == 2) echo "selected";?>>Kering</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label">Ampere</label>
                                                <div class="controls">
                                                    <input required type="text" required name="ampere[]" value="<?php echo $row->ampere?>" id="textfield" placeholder="" class="input-small"/>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $a++; }?>
                                    </div>
                                <?php } ?>
                                
                                <?php if ($form_vehicle == true) {
                                    ?>
                                 <div id="form_detail">
                                    <div id="form_detail">
                                        <div id="form_detail_1">
                                            
                                            <div class="control-group">
                                                <label  class="control-label">Vehicle Type</label>
                                                <div class="controls">
                                                    <div class="input-xlarge">
                                                        <select name="vehicle_type" id="aki_type">

                                                            <option value="1" <?php if($type == 1) echo "selected";?>>Bebek</option>
                                                            <option value="2" <?php if($type == 2) echo "selected";?>>Matic</option>
                                                            <option value="3" <?php if($type == 3) echo "selected";?>>Sport</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Rim Size</label>
                                                <div class="controls">
                                                    <input required type="text" value="<?php echo $rim?>" name="rim" id="textfield" placeholder="Rim Diameter" class="input-small"/>
                                                </div>
                                            </div>
                                            <div class="control-group" id="size">
                                                <label class="control-label">Front Size</label>
                                                <div class="controls">

                                                    <input required name="front_width" value="<?php echo $front[0]?>"  id="" class='input-small' placeholder="00"> 
                                                    /
                                                    <input required name="front_ratio" value="<?php echo $front[1]?>" id="" class='input-small' placeholder="00">
                                                </div>
                                            </div>
                                            
                                            <div class="control-group" id="size">
                                                <label class="control-label">Back Size</label>
                                                <div class="controls">

                                                    <input required name="back_width" value="<?php echo $back[0]?>" id="" class='input-small' placeholder="00"> 
                                                    /
                                                    <input required name="back_ratio" value="<?php echo $back[1]?>" id="" class='input-small' placeholder="00">
                                                </div>
                                            </div>
                                            
                                             <div class="control-group">
                                                <label class="control-label">Oil Capacity</label>
                                                <div class="controls">
                                                    <input required type="text" value="<?php echo $liter?>"  name="liter" id="textfield" placeholder="Liter" class='input-small'/>
                                                </div>
                                            </div>
                                            
                                             <div class="control-group">
                                                <label class="control-label">Ampere</label>
                                                <div class="controls">
                                                    <input required type="text" name="ampere" value="<?php echo $ampere?>" id="textfield" placeholder="Ampere" class='input-small'/>
                                                </div>
                                            </div>
                                            
                                              <div class="control-group">
                                                <label for="recomended_oli" class="control-label">Recomended OLI</label>
                                                <div class="controls">
                                                    <div class="input-xlarge">
                                                        <div id="region_form" >
                                                            <select name="recomended_oli" id="recomended_oli" class="chosen-select" >
                                                                
                                                                <option value="0"></option>
                                                                <?php
                                                                if (isset($oli)) {
                                                                    foreach ($oli as $row) {
                                                                        ?>
                                                                        <option value="<?php echo $row->oli_id ?>" <?php if($recomended_oli == $row->oli_id) echo "selected";?>><?php echo $row->brand_name . " - " . $row->name ." ". $row->oli_liter?> Liter</option>
                                                                <?php } } ?>
                                                                        
                                                            </select>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="control-group">
                                                <label for="recomended_aki" class="control-label">Recomended AKI</label>
                                                <div class="controls">
                                                    <div class="input-xlarge">
                                                        <div id="region_form" >
                                                            <select name="recomended_aki" id="recomended_aki" class="chosen-select" >
                                                                <option value="0"></option>
                                                                <?php
                                                                if (isset($aki)) {
                                                                    foreach ($aki as $row) {
                                                                        ?>
                                                                        <option value="<?php echo $row->aki_id ?>" <?php if($recomended_aki == $row->aki_id) echo "selected"; ?>><?php echo $row->brand_name . " - " . $row->name  ." ". $row->aki_ampere?> Ampere</option>
                                                                        
                                                                <?php } } ?>
                                                            </select>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                 </div>
                                <?php } ?>       
                                <?php //END FORM  ?>
                                
                                  <?php if ($form_additional_info == true) { ?> 
                                
                                 <div class="control-group">
                                        <label class="">ADDITIONAL INFO ITEM</label>
                                    </div>
                                <?php } ?>
                                <?php if ($form_image == true) { ?>
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

                                <?php if ($form_desc == true) { ?>
                                    <div class="control-group">
                                        <label for="desc" class="control-label">Description <small>You may add an article for this Item</small></label>
                                        <div class="box-content nopadding controls">
                                            <textarea name="ck" id="editor1" class=' span12' rows="5"><?php echo $desc?></textarea>
                                        </div>		
                                    </div>
                                <?php } ?>

                                <?php if ($form_recomended_vehicle == true) { ?>
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
                                                                <option value="<?php echo $row->id?>" <?php for($a=0; $a<count($recomended_item); $a++){ if($row->id == $recomended_item[$a])echo "selected" ; }?>><?php echo $row->brand_name." - ".$row->name?></option>
                                                        <?php }} ?>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                
                                  <?php } ?>
                                 <div class="form-actions">
                                        <input type="hidden" name="id" value="<?php echo $id?>" >
                                        <input type="hidden" name="type" value="<?php echo $item_type?>" >
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

