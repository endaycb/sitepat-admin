<?php
$id;
$menus_id;
$name;
$url;
$auth;


if(isset($record)){
    foreach($record as $row){
        $id             = $row->id;
        $menus_id       = $row->menus_id;
        $name           = $row->name;
        $url            = $row->url;
        $position       = $row->position;
        $auth           = $row->auth;
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
                            <h3><i class="icon-th-list"></i> Edit <?php echo $name ?> Sub Menus</h3>
                        </div>
                        <div class="box-content nopadding">
                            <form action="<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1)?>/update" method="POST" class='form-horizontal form-striped'>
                                <div class="control-group">
                                        <label for="select" class="control-label">Admin Or Portal?</label>
                                        <div class="controls">
                                                <div class="input-xlarge">
                                                    <select name="menus_id" id="select" class='chosen-select'>
                                                        
                                                        <?php foreach($menus as $row){?>
                                                        <option value="<?php echo $row->id?>" <?php if($menus_id == $row->id) echo "selected"?>><?php echo $row->name?></option>
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
                                                        <option value="1" <?php if($auth == 1) echo "selected"?>>YES</option>
                                                        
                                                        <option value="0" <?php if($auth == 0) echo "selected"?>>NO</option>
                                                        
                                                    </select>
                                                </div>
                                        </div>
                                </div>
                                <div class="control-group">
                                        <label for="position" class="control-label">Position Number</label>
                                        <div class="controls">
                                                <input required type="text" name="position" id="position" placeholder="Position" class="input-mini" value="<?php echo $position?>"/>
                                        </div>
                                </div>
                                
                                <div class="control-group">
                                    <label for="name" class="control-label">Name</label>
                                    <div class="controls">
                                        <input required type="text" name="name" id="name" placeholder="Name" class="input-xlarge" value="<?php echo $name?>"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="URL" class="control-label">URL</label>
                                    <div class="controls">
                                        <input required type="text" name="url" id="URL" placeholder="URL" class="input-xlarge" value="<?php echo $url?>"/>
                                    </div>
                                </div>
                                <div class="form-actions">
                                        <input type="hidden" name="id" value="<?php echo $id ?>"/>
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