<?php
    
$id;
$title;
$article;
$desc;
$image;
$image_thumb;

if(isset($record)){
    foreach($record as $row){
        $id                 = $row->id;
        $title              = $row->title;
        $article            = $row->article;
        $desc               = $row->desc;
        $image              = $row->image;
        $image_thumb        = $row->image_thumb;
        $label              = $row->label;
        
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
                            <h3><i class="icon-th-list"></i> Edit <?php echo $title?> Activity</h3>
                        </div>
                        <div class="box-content nopadding">
                            <form action="<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1)?>/update" method="POST" class='form-horizontal form-striped' enctype="multipart/form-data">
                            <div class="control-group">
                                        <label for="image_" class="control-label">Activity Image <small>1350px * 311px</small></label>
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
                                    <label for="textfield" class="control-label">Title</label>
                                    <div class="controls">
                                        <input required type="text" name="title" value="<?php echo $title?>" id="textfield" placeholder="Name" class="input-xlarge"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                        <label for="desc" class="control-label">Description</label>
                                        <div class="controls">
                                                <textarea name="desc" id="textarea" rows="5" class="span4" maxlength="160"><?php echo $desc?></textarea>
                                        </div>	
                                </div>
                                <div class="control-group">
                                        <label for="desc" class="control-label">Activity</label>
                                        <div class="box-content nopadding controls">
                                            <textarea name="ck" class=' span12'  id="editor1" rows="5"><?php echo $article?></textarea>
                                        </div>		
                                </div>
                                <div class="control-group">
                                        <label for="label" class="control-label">Activity Tags</label>
                                        <div class="controls">
                                                <div class="span12">
                                                    <input type="text" name="label" id="label" class="tagsinput" value="<?php echo $label?>">
                                                </div>
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