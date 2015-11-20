<?php
$id;
$back_front;
$name;
$url;
$position;
$color;
$icon;

if(isset($record)){
    foreach($record as $row){
        $id             = $row->id;
        $back_front     = $row->back_front;
        $name           = $row->name;
        $url            = $row->url;
        $position       = $row->position;
        $auth           = $row->auth;
        $color          = $row->color;
        $icon           = $row->icon;
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
                            <h3><i class="icon-th-list"></i> Edit <?php echo $name ?> Menus</h3>
                        </div>
                        <div class="box-content nopadding">
                            <form action="<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1)?>/update" method="POST" class='form-horizontal form-striped'>
                                <div class="control-group">
                                        <label for="select" class="control-label">Admin Or Portal?</label>
                                        <div class="controls">
                                                <div class="input-xlarge">
                                                    <select name="back_front" id="select" class='chosen-select'>
                                                        <option value="1" <?php if($back_front == 1) echo "selected"?>>Admin</option>
                                                        
                                                        <option value="2" <?php if($back_front == 2) echo "selected"?>>Portal</option>
                                                        
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
                                        <label for="color" class="control-label">Menu Icon</label>
                                        <div class="controls">
                                                <select name="icon" id="sico" class='select2-me input-xlarge'>
                                                 <?php foreach($icons as $row){ ?>
                                                     <option value="<?php echo $row->name?>" <?php if($icon == $row->name) echo "selected"?>><?php echo $row->name?></option>
                                                 <?php } ?>
                                                </select>
                                        </div>
                                </div>
				<div class="control-group">
                                        <label for="select_color" class="control-label">Bottom Color</label>
                                        <div class="controls">
                                                <div class="input-xlarge">
                                                    <select name="color" id="select_color" class='chosen-select'>
                                                       
                                                        <option value="blue" <?php if($color == "blue") echo "selected"?>>Blue</option>
                                                        <option value="choco" <?php if($color == "choco") echo "selected"?>>Choco</option>
                                                        <option value="green" <?php if($color == "green") echo "selected"?>>Green</option>
                                                        <option value="orange" <?php if($color == "orange") echo "selected"?>>Orange</option>
                                                        <option value="pink" <?php if($color == "pink") echo "selected"?>>Pink</option>
														<option value="purple" <?php if($color == "purple") echo "selected"?>>Purple</option>
                                                        <option value="red" <?php if($color == "red") echo "selected"?>>Red</option>
                                                        
                                                    </select>
                                                </div>
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