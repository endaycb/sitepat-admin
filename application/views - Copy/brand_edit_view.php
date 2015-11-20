<?php
$id;
$name;
$desc;
$image;


if(isset($record)){
    foreach($record as $row){
        $id         = $row->id;
        $name       = $row->name;
        $desc       = $row->desc;
        $image      = $row->image;
        $brand_for  = $row->brand_for;
        
        if($brand_for != ""){
            $brand_for  = explode(",", $brand_for);
        }
        
        $brand_for_ = Array("BAN","OLI","AKI");
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
                            <h3><i class="icon-th-list"></i> Edit <?php echo $name?> Brand</h3>
                        </div>
                        <div class="box-content nopadding">
                            <form action="<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1)?>/update" method="POST" class='form-horizontal form-striped' enctype="multipart/form-data">
                            <div class="control-group">
                                        <label for="textfield" class="control-label">Brand Image</label>
                                        <div class="controls">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo $section_image_path.$image;?>" /></div>
                                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                        <div>
                                                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input  type="file" name='image' /></span>
                                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="control-group">
                                    <label for="brand_for" class="control-label">Brand For</label>
                                    <div class="controls">
                                        <div class="input-xlarge">
                                            <div id="region_form"  >
                                                <select name="brand_for[]" id="brand_for" multiple="multiple" class="chosen-select input-xxlarge" required>
                                                    <?php for($a=0; $a<count($brand_for_); $a++){?>
                                                    <option value="<?php echo ($a+1);?>" <?php for($i = 0; $i < count($brand_for)-1; $i++){ if($brand_for[$i] == ($a+1) ) echo "selected ";} ?>><?php echo $brand_for_[$a]?></option>
                                                    <?php } ?>
                                                    
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="textfield" class="control-label">Name</label>
                                    <div class="controls">
                                        <input required type="text" name="name" value="<?php echo $name?>" id="textfield" placeholder="Name" class="input-xlarge"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                        <label for="textarea" class="control-label">Description</label>
                                        <div class="controls">
                                                <textarea name="desc" id="textarea" rows="5" class="span4   "><?php echo $desc?></textarea>
                                        </div>
                                </div>
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