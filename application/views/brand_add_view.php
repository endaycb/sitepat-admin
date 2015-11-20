<div class="container-fluid" id="content">
    <div id="main">
        <div class="container-fluid">
            <div class="row-fluid">
		<div class="span12">
                    <div class="box box-bordered">
                        <div class="box-title">
                            <h3><i class="icon-th-list"></i> Add Brand</h3>
                        </div>
                        <div class="box-content nopadding">
                            <form action="<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1)?>/create" method="POST" class='form-horizontal form-striped' enctype="multipart/form-data">
                            <div class="control-group">
                                        <label for="textfield" class="control-label">Brand Image</label>
                                        <div class="controls">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" /></div>
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
                                            <div id="region_form" >
                                                <select name="brand_for[]" id="brand_for" multiple="multiple" class="chosen-select input-xxlarge" required>
                                                    
                                                    <option value="1">BAN</option>
                                                    <option value="2">OLI</option>
                                                    <option value="3">AKI</option>
                                                    <option value="4">Vehicle</option>
                                                    
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="textfield" class="control-label">Name</label>
                                    <div class="controls">
                                        <input required type="text" name="name" id="textfield" placeholder="Name" class="input-xlarge"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                        <label for="textarea" class="control-label">Description</label>
                                        <div class="controls">
                                                <textarea name="desc" id="textarea" rows="5" class="span4   "></textarea>
                                        </div>
                                </div>
                                <div class="control-group">
                                        <label for="image_" class="control-label">Show Position<small>Show position for Support Brand</small></label>
                                        <div class="controls">
                                                <input required type="text" name="show_position" id="show_position" placeholder="0" class="input-mini"/>
                                        </div>
                                </div>
                                <div class="form-actions">
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
