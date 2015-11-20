<div class="container-fluid" id="content">
    <div id="main">
        <div class="container-fluid">
            <div class="row-fluid">
		<div class="span12">
                    <div class="box box-bordered">
                        <div class="box-title">
                            <h3><i class="icon-th-list"></i> Add Sub Menus</h3>
                        </div>
                        <div class="box-content nopadding">
                            <form action="<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1)?>/create" method="POST" class='form-horizontal form-striped'>
                                <div class="control-group">
                                        <label for="select" class="control-label">Admin Or Portal?</label>
                                        <div class="controls">
                                                <div class="input-xlarge">
                                                    <select name="menus_id" id="select" class='chosen-select'>
                                                        
                                                        <?php foreach($menus as $row){?>
                                                        <option value="<?php echo $row->id?>"><?php echo $row->name?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                        </div>
                                </div>
                                 <div class="control-group">
                                        <label for="select2" class="control-label">Authentication Required?</label>
                                        <div class="controls">
                                                <div class="input-xlarge">
                                                    <select name="auth" id="select2" class='chosen-select'>
                                                        <option value="1" >YES</option>
                                                        
                                                        <option value="0" >NO</option>
                                                        
                                                    </select>
                                                </div>
                                        </div>
                                </div>
                                <div class="control-group">
                                        <label for="position" class="control-label">Position Number</label>
                                        <div class="controls">
                                                <input required type="text" name="position" id="position" placeholder="Position" class="input-mini"/>
                                        </div>
                                </div>
                                
                                <div class="control-group">
                                    <label for="name" class="control-label">Name</label>
                                    <div class="controls">
                                        <input required type="text" name="name" id="name" placeholder="Name" class="input-xlarge"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="URL" class="control-label">URL</label>
                                    <div class="controls">
                                        <input required type="text" name="url" id="URL" placeholder="URL" class="input-xlarge"/>
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