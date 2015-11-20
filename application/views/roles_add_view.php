<?php
    $this->load->model("system_queries_model");
    
  
    $role_permission_text   = Array("Read","Read - Add","Read - Add - Edit","Read - Add - Edit - Delete");
    $role_permission_val    = Array(1,2,3,4);
    
    $y = 0;
    $z = 0;
    $i = 0; 
    $o = 0;
?>
<div class="container-fluid" id="content">
    <div id="main">
        <div class="container-fluid">
            <div class="row-fluid">
		<div class="span12">
                    <div class="box box-bordered">
                        <div class="box-title">
                            <h3><i class="icon-th-list"></i> Add Roles</h3>
                        </div>
                        <div class="box-content nopadding">
                            <form action="<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1)?>/create" method="POST" class='form-horizontal form-striped' enctype="multipart/form-data">
                               <div class="control-group">
                                    <label for="textfield" class="control-label">Role Name</label>
                                    <div class="controls">
                                        <input required type="text" name="name" id="textfield" placeholder="Name" class="input-xlarge"/>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                        <label for="" class="control-label">Admin Roles</label>
                                        <?php 
                                            $x = 0;
                                            foreach($menus_back as $row){
                                            
                                        ?>
                                            <div class="controls">
                                                
                                                <div class="input-xlarge">
                                                   <div class='checkbox'>
                                                        <?php echo $row->name; ?>
                                                        <input type="checkbox" name="main_back_end_active_<?php echo $x?>" id="_<?php echo $row->id;?>" class="" value="<?php echo $row->id?>">
                                                        <div id="_<?php echo $row->id;?>_form"  style="display:none">
                                                            <select name="main_back_end[]" id="_<?php echo $row->id;?>_select" class="chosen-select">
                                                                <?php
                                                                    for($b = 0; $b < count($role_permission_text); $b++){
                                                                ?>
                                                                    <option value="<?php echo $role_permission_val[$b]?>"><?php echo $role_permission_text[$b]?></option>
                                                                <?php } ?>
                                                            </select>

                                                        </div>
                                                    </div>
                                                </div>
                                            <?php $x++; ?>
                                                <?php
                                                    $q_menus_sub    = "SELECT * FROM menus_sub "
                                                                    . "WHERE menus_id =".$row->id." "
                                                                    . "ORDER BY position ASC";
                                                    
                                                    
                                                    
                                                    if($query2   = $this->system_queries_model->custom_query($q_menus_sub)){
                                                         foreach($query2->result() as $row){
                                                   
                                                    
                                                ?>
                                                <div class="controls_">
                                                        <div class="input-xlarge">
                                                            <div class='checkbox'>
                                                                <?php echo $row->name;?>
                                                                <input type="checkbox" name="back_end_active_<?php echo $i?>" id="<?php echo $row->id;?>" class="sign_form" value="<?php echo $row->id?>">
                                                                <div id="<?php echo $row->id;?>_form"  style="display:none">
                                                                    <select name="back_end[]" id="<?php echo $row->id;?>_select" class="chosen-select">
                                                                        <?php
                                                                            for($b = 0; $b < count($role_permission_text); $b++){
                                                                        ?>
                                                                            <option value="<?php echo $role_permission_val[$b]?>"><?php echo $role_permission_text[$b]?></option>
                                                                        <?php } ?>
                                                                    </select>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php $i++; }  } ?>
                                            </div>
                                        <?php } ?>
                                </div>
                                <div class="control-group">
                                        <label for="" class="control-label">Portal Roles</label>
                                        <?php 
                                            $x = 0;
                                            foreach($menus_front as $row){
                                             
                                        ?>
                                            <div class="controls">
                                                <div class="input-xlarge">
                                                   <div class='checkbox'>
                                                        <?php echo $row->name; ?>
                                                        <input type="checkbox" name="main_front_end_active_<?php echo $x?>" id="_<?php echo $row->id;?>" class="" value="<?php echo $row->id?>">
                                                        <div id="_<?php echo $row->id;?>_form"  style="display:none">
                                                            <select name="main_front_end[]" id="_<?php echo $row->id;?>_select" class="chosen-select">
                                                                <?php
                                                                    for($b = 0; $b < count($role_permission_text); $b++){
                                                                ?>
                                                                    <option value="<?php echo $role_permission_val[$b]?>"><?php echo $role_permission_text[$b]?></option>
                                                                <?php } ?>
                                                            </select>

                                                        </div>
                                                    </div>
                                                </div>
                                                <?php $x++; ?>
                                                
                                                <?php
                                                    $q_menus_sub    = "SELECT * FROM menus_sub "
                                                                    . "WHERE menus_id =".$row->id." "
                                                                    . "ORDER BY position ASC";
                                                    
                                                    
                                                    
                                                    if($query2   = $this->system_queries_model->custom_query($q_menus_sub)){
                                                         foreach($query2->result() as $row){
                                                   
                                                    
                                                ?>
                                                <div class="controls_">
                                                        <div class="input-xlarge">
                                                            <div class='checkbox'>
                                                                <?php echo $row->name;?>
                                                                <input type="checkbox" name="front_end_active_<?php echo $o?>" id="<?php echo $row->id;?>" class="sign_form" value="<?php echo $row->id?>">
                                                                <div id="<?php echo $row->id;?>_form"  style="display:none">
                                                                    <select name="front_end[]" id="<?php echo $row->id;?>_select" class="chosen-select">
                                                                        <?php
                                                                            for($b = 0; $b < count($role_permission_text); $b++){
                                                                        ?>
                                                                            <option value="<?php echo $role_permission_val[$b]?>"><?php echo $role_permission_text[$b]?></option>
                                                                        <?php } ?>
                                                                    </select>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php $o++; }  } ?>
                                            </div>
                                        <?php } ?>
                                </div>
                                <div class="control-group">
                                        <label for="textarea" class="control-label">Description</label>
                                        <div class="controls">
                                            <textarea name="desc" id="textarea" rows="5" class="span4" maxlength="160"></textarea>
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