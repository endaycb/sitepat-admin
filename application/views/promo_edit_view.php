<?php
    
$id;
$region_id;
$title;
$desc;
$date_time_publish;
$image;
$image_thumb;

if(isset($record)){
    foreach($record as $row){
        $id                 = $row->id;
        $region_id          = $row->region_id;
        $store_id           = $row->store_id;
        $title              = $row->title;
        $desc               = $row->desc;
        $promo              = $row->promo;
        $date_time_publish  = $row->date_time_publish;
        $date_time_end      = $row->date_time_end;
        $image              = $row->image;
        $image_thumb        = $row->image_thumb;
        
        if($region_id != null){
            $region_id  = explode(",", $region_id);
        }
        
        if($store_id != null){
            $store_id   = explode(",", $store_id);
        }
        
        
        
        
    }
}else{
    redirect(base_url()."index.php/".$this->section);
}

?> 
<div class="container-fluid" id="content">
    <div id="main">
        <div class="container-fluid">
            <div class="row-fluid">
		<div class="span12">
                    <div class="box box-bordered">
                        <div class="box-title">
                            <h3><i class="icon-th-list"></i> Edit <?php echo $title?> Promo</h3>
                        </div>
                        <div class="box-content nopadding">
                            <form action="<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1)?>/update" method="POST" class='form-horizontal form-striped' enctype="multipart/form-data">
                            <div class="control-group">
                                        <label for="image_" class="control-label">Promo Image <small>1350px * 120px</small></label>
                                        <div class="controls">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo $section_image_path.$image;?>" /></div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                <div>
                                                    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input  type="file" name='image' id="image_"/></span>
                                                    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                
                                <div class="control-group">
                                        <label for="image_thumb" class="control-label">Thumb Image <small>200px * 150px</small></label>
                                        <div class="controls">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo $section_image_path.$image_thumb;?>" /></div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                <div>
                                                    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input  type="file" name='image_thumb' id="image_thumb"/></span>
                                                    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                
                                <div class="control-group">
                                    <label for="region" class="control-label">Region</label>
                                    <div class="controls">
                                        <div class="input-xlarge">
                                            <div class='checkbox'>
                                                <input type="checkbox" name="region_active" id="region" class="sign_form" value="1"  <?php if(isset($region_id)) echo "checked"?> >
                                                <div id="region_form"  style="display:<?php if($region_id == null) echo "none"; else echo "block";?>">
                                                    <select  name="region_id[]" id="a" multiple="multiple" class="chosen-select input-xlarge">
                                                        <?php
                                                            if(isset($region)){
                                                                foreach($region as $row){
                                                        ?>
                                                            <option value="<?php echo $row->id?>"  <?php for($a = 0; $a < count($region_id)-1; $a++){ if($row->id == $region_id[$a]) echo "selected ";} ?>><?php echo $row->name?></option>
                                                        <?php }} ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="check_region" class="control-label">Store</label>
                                    <div class="controls">
                                        <div class="input-xlarge">
                                            <div class='checkbox'>
                                                <input type="checkbox" name="store_active"  id="store" class="sign_form"  value="1" <?php if(count($store_id)>0) echo "checked" ?> >
                                                <div id="store_form" style="display:<?php if($store_id == null) echo "none"; else echo "block";?>">
                                                    <select name="store_id[]"  multiple="multiple" class="chosen-select input-xlarge">
                                                        <?php
                                                            if(isset($store)){
                                                                foreach($store as $row){
                                                        ?>
                                                            <option value="<?php echo $row->id?>" <?php for($a = 0; $a < count($store_id)-1; $a++){ if($row->id == $store_id[$a]) echo "selected ";} ?>><?php echo $row->name?></option>
                                                        <?php }} ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="textfield" class="control-label">Title</label>
                                    <div class="controls">
                                        <input required type="text" name="title" value="<?php echo $title?>" id="textfield" placeholder="Name" class="input-xlarge"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                        <label for="textarea" class="control-label">Description</label>
                                        <div class="controls">
                                            <textarea name="desc" id="textarea" rows="5" class="span4" maxlength="160"><?php echo $desc?></textarea>
                                        </div>
                                </div>
                                <div class="control-group">
                                        <label for="desc" class="control-label">Promo</label>
                                        <div class="box-content nopadding controls">
                                            <textarea name="ck" class=' span12'  id="editor1" rows="5"><?php echo $promo?></textarea>
                                        </div>		
                                </div>
                                <div class="control-group">
                                        <label for="date_start" class="control-label">Start Publish</label>
                                        <div class="controls">
                                                <input required type="text" name="date_time_publish" id="date_start" value="<?php echo $date_time_publish?>" class="input-medium datepick">
                                        </div>
                                </div>
                                <div class="control-group">
                                        <label for="date_end" class="control-label">End Publish</label>
                                        <div class="controls">
                                                <input required type="text" name="date_time_end" id="date_end" value="<?php echo $date_time_end?>" class="input-medium datepick">
                                        </div>
                                </div>
                                <div class="form-actions">
                                        <input type="hidden" name="id" value="<?php echo $id?>"></input>
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