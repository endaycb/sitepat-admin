<?php
$id;
$name;
$lat;
$lng;
$zoom;
$desc;


if(isset($record)){
    foreach($record as $row){
        $id     = $row->id;
        $name   = $row->name;
        $lat    = $row->lat;
        $lng    = $row->lng;
        $zoom   = $row->zoom;
        $desc   = $row->desc;
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
                            <h3><i class="icon-th-list"></i> Edit <?php echo $name ?> Regional</h3>
                        </div>
                        <div class="box-content nopadding">
                            <form action="<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1)?>/update" method="POST" class='form-horizontal form-striped'>
                                <div class="control-group">
                                    <label for="textfield" class="control-label">Name</label>
                                    <div class="controls">
                                        <input required type="text" name="name" value="<?php echo $name ?>" id="textfield" placeholder="Text input" class="input-xlarge"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                        <label class="control-label">Position<small>More information here</small></label>
                                        <div class="controls">

                                                        <input required type="text" name="lat" value="<?php echo $lat ?>" placeholder="Latitude"> 


                                                        <input required type="text" name="lng" value="<?php echo $lng ?>" placeholder="Longitude">

                                        </div>
                                </div>
                                <div class="control-group">
                                    <label for="textfield" class="control-label">Map Zoom</label>
                                    <div class="controls">
                                        <input required type="text" name="zoom" value="<?php echo $zoom ?>" id="textfield" placeholder="1-20" class="input-xlarge"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                        <label for="textarea" class="control-label">Description</label>
                                        <div class="controls">
                                                <textarea name="desc" id="textarea" rows="5" class="span4   "><?php echo $desc ?></textarea>
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