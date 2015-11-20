<?php
$message_password = $this->session->userdata("message_password");

if($message_password){
?>

<script>
alert("<?php echo $message_password?>");
</script>

<?php $this->session->unset_userdata("message_password"); } ?>
<div class="container-fluid" id="content">
    <div id="main">
        <div class="container-fluid">
            <div class="row-fluid">
		<div class="span12">
                    <div class="box box-bordered">
                        <div class="box-title">
                            <h3><i class="icon-th-list"></i> Add User</h3>
                        </div>
                        <div class="box-content nopadding">
                            <form action="<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1)?>/create" method="POST" class='form-horizontal form-striped' enctype="multipart/form-data">
                            <div class="control-group">
                                        <label for="textfield" class="control-label">Profile Image</label>
                                        <div class="controls">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" /></div>
                                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                        <div>
                                                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input required type="file" name='image' /></span>
                                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="control-group">
                                        <label for="textfield" class="control-label">Roles</label>
                                        <div class="controls">
                                                <div class="input-xlarge">
                                                    <select name="roles_id" id="select" class='chosen-select'>
                                                        <?php
                                                            if(isset($roles)){
                                                                foreach($roles as $row){
                                                        ?>
                                                            <option value="<?php echo $row->id?>"><?php echo $row->name?></option>
                                                        <?php }} ?>
                                                    </select>
                                                </div>
                                        </div>
                                </div>
                                <div class="control-group">
                                    <label for="textfield" class="control-label">Username</label>
                                    <div class="controls">
                                        <input required type="text" name="username" id="textfield" placeholder="Username" class="input-xlarge"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="textfield" class="control-label">Password</label>
                                    <div class="controls">
                                        <input required type="password" name="password" id="textfield" placeholder="Password" class="input-xlarge"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="textfield" class="control-label">Password Confirm</label>
                                    <div class="controls">
                                        <input required type="password" name="password_confirm" id="textfield" placeholder="Retype Password" class="input-xlarge"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="textfield" class="control-label">Name</label>
                                    <div class="controls">
                                        <input required type="text" name="name" id="textfield" placeholder="Name" class="input-xlarge"/>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label for="Email" class="control-label">Email</label>
                                    <div class="controls">
                                        <input required type="text" name="email" id="Email" placeholder="" class="input-xlarge" maxlength="150"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="phone" class="control-label">Phone</label>
                                    <div class="controls">
                                        <input required type="text" name="phone" id="phone" placeholder="Ex: 021-99988877" class="input-xlarge" maxlength="20"/>
                                    </div>
                                </div>
                               <div class="control-group">
                                        <label for="address" class="control-label">Address</label>
                                        <div class="controls">
                                                <textarea name="address" id="address" rows="5" class="span4   "></textarea>
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