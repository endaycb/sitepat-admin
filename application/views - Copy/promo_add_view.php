<div class="container-fluid" id="content">
    <div id="main">
        <div class="container-fluid">
            <div class="row-fluid">
		<div class="span12">
                    <div class="box box-bordered">
                        <div class="box-title">
                            <h3><i class="icon-th-list"></i> Add Promo</h3>
                        </div>
                        <div class="box-content nopadding">
                            <form action="<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1)?>/create" method="POST" class='form-horizontal form-striped' enctype="multipart/form-data">
                            <div class="control-group">
                                        <label for="image_" class="control-label">Promo Image</label>
                                        <div class="controls">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" /></div>
                                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                        <div>
                                                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input required type="file" name='image' id="image_"/></span>
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
                                                        <input type="checkbox" name="region_active" id="region" class="sign_form" value="1">
                                                        <div id="region_form"  style="display:none">
                                                            <select name="region_id[]" id="a" multiple="multiple" class="chosen-select input-xxlarge">
                                                                <?php
                                                                    if(isset($region)){
                                                                        foreach($region as $row){
                                                                ?>
                                                                    <option value="<?php echo $row->id?>"><?php echo $row->name?></option>
                                                                <?php }} ?>
                                                            </select>
                                                           
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                </div>
                                        </div>
                                </div>
                                <div class="control-group">
                                        <label for="store" class="control-label">Store</label>
                                        <div class="controls">
                                                <div class="input-xlarge">
                                                    <div class='checkbox'>
                                                        <input type="checkbox" name="store_active" id="store" class="sign_form" value="1">
                                                        <div id="store_form"  style="display:none">
                                                            <select name="store_id[]"  multiple="multiple" class="chosen-select input-xxlarge">
                                                                <?php
                                                                    if(isset($store)){
                                                                        foreach($store as $row){
                                                                ?>
                                                                    <option value="<?php echo $row->id?>"><?php echo $row->name?></option>
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
                                        <input required type="text" name="title" id="textfield" placeholder="Name" class="input-xlarge"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                        <label for="textarea" class="control-label">Description</label>
                                        <div class="controls">
                                            <textarea name="desc" id="textarea" rows="5" class="span4" maxlength="160"></textarea>
                                        </div>
                                </div>
                                <div class="control-group">
                                        <label for="" class="control-label">Promo</label>
                                        <div class=" nopadding controls">
                                            <textarea name="ck" id="promo_editor" class='ckeditor span12' rows="5"></textarea>
                                        </div>		
                                </div>
                                 
								<script> 
								/*var roxyFileman = '<?php echo base_url()?>dist/fileman/index.html'; 
								$(function(){
								   CKEDITOR.replace( 'promo_editor',{filebrowserBrowseUrl:roxyFileman, 
																filebrowserUploadUrl:roxyFileman,
																filebrowserImageBrowseUrl:roxyFileman+'?type=image',
																filebrowserImageUploadUrl:roxyFileman+'?type=image'}); 
								});*/
								 </script>
                                <div class="control-group">
                                        <label for="date_start" class="control-label">Start Publish</label>
                                        <div class="controls">
                                                <input required type="text" name="date_time_publish" id="date_start" class="input-medium datepick">
                                        </div>
                                </div>
                                <div class="control-group">
                                        <label for="date_end" class="control-label">End Publish</label>
                                        <div class="controls">
                                                <input required type="text" name="date_time_end" id="date_end" class="input-medium datepick">
                                        </div>
                                </div>
                                <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Save</button>
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