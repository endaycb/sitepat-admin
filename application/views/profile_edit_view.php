<?php
$id;
$name;
$desc;
$history;
$vision;
$mision;
$concept;
$image;


if(isset($record)){
    foreach($record as $row){
        $id             = $row->id;
        $name           = $row->name;
        $office_name    = $row->office_name;
        $desc           = $row->desc;
        $history        = $row->history;
        $image          = $row->image;
        $vision         = $row->vision;
        $mision         = $row->mision;
        $concept        = $row->concept;
        $address        = $row->address;
        $postalcode     = $row->postalcode;
        $phone          = $row->phone;
        $fax            = $row->fax;
        $email          = $row->email;
        $lat            = $row->lat;
        $lng            = $row->lng;
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
                            <h3><i class="icon-th-list"></i> Edit <?php echo $name?> Profile</h3>
                        </div>
                        <div class="box-content nopadding">
                            <form action="<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1)?>/update" method="POST" class='form-horizontal form-striped' enctype="multipart/form-data">
                            <div class="control-group">
                                        <label for="textfield" class="control-label">Profile Image</label>
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
                                    <label for="textfield" class="control-label">Name</label>
                                    <div class="controls">
                                        <input required type="text" name="name" value="<?php echo $name?>" id="textfield" placeholder="Name" class="input-xlarge"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="textfield" class="control-label">Office Name</label>
                                    <div class="controls">
                                        <input required type="text" name="office_name" value="<?php echo $office_name?>" id="textfield" placeholder="Name" class="input-xlarge"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                        <label for="address" class="control-label">Address</label>
                                        <div class="controls">
                                                <textarea name="address" id="address" rows="5" class="span4   "><?php echo $address?></textarea>
                                        </div>
                                </div>
                                <div class="control-group">
                                    <label for="postalcode" class="control-label">Postal Code</label>
                                    <div class="controls">
                                        <input required type="text" name="postalcode" value="<?php echo $postalcode?>" id="postalcode" placeholder="Ex: 13910" class="input-xlarge" maxlength="10"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="phone" class="control-label">Phone</label>
                                    <div class="controls">
                                        <input required type="text" name="phone" value="<?php echo $phone?>" id="phone" placeholder="Ex: 021-99988877" class="input-xlarge" maxlength="20"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="Fax" class="control-label">Fax</label>
                                    <div class="controls">
                                        <input required type="text" name="fax" value="<?php echo $fax?>" id="Fax" placeholder="Ex: 021-99988877" class="input-xlarge" maxlength="20"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="Email" class="control-label">Email</label>
                                    <div class="controls">
                                        <input required type="text" name="email" value="<?php echo $email?>" id="Email" placeholder="" class="input-xlarge" maxlength="150"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                        <label for="textadescrea" class="control-label">Description</label>
                                        <div class="controls">
                                                <textarea name="desc" id="desc" rows="5" class="span4   "><?php echo $desc?></textarea>
                                        </div>
                                </div>
                                <div class="control-group">
                                        <label for="history" class="control-label">History</label>
                                        <div class="controls">
                                                <textarea name="history" id="history" rows="5" class="span6   "><?php echo $history?></textarea>
                                        </div>
                                </div>
                                 <div class="control-group">
                                        <label for="Vision" class="control-label">Vision</label>
                                        <div class="controls">
                                                <textarea name="vision" id="Vision" rows="5" class="span6"><?php echo $vision?></textarea>
                                        </div>
                                </div>
                                <div class="control-group">
                                        <label for="mision" class="control-label">Mision</label>
                                        <div class="controls">
                                                <textarea name="mision" id="mision" rows="5" class="span6"><?php echo $mision?></textarea>
                                        </div>
                                </div>
                                <div class="control-group">
                                        <label for="concept" class="control-label">Concept</label>
                                        <div class="controls">
                                                <textarea name="concept" id="concept" rows="5" class="span6"><?php echo $concept?></textarea>
                                        </div>
                                </div>
                                <div class="control-group">
                                        <label class="control-label">Position<small>More information here</small></label>
                                        <div class="controls">

                                                        <input required type="text" name="lat" value="<?php echo $lat?>" placeholder="Latitude"> 


                                                        <input required type="text" name="lng" value="<?php echo $lng?>" placeholder="Longitude">

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