<div class="container-fluid" id="content">
    <div id="main">
        <div class="container-fluid">
            <div class="row-fluid">
		<div class="span12">
                    <div class="box box-bordered">
                        <div class="box-title">
                            <h3><i class="icon-th-list"></i> Add Regional</h3>
                        </div>
                        <div class="box-content nopadding">
                            <form action="<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1)?>/create" method="POST" class='form-horizontal form-striped'>
                                <div class="control-group">
                                    <label for="textfield" class="control-label">Name</label>
                                    <div class="controls">
                                        <input required type="text" name="name" id="textfield" placeholder="Name" class="input-xlarge"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                        <label class="control-label">Position<small>More information here</small></label>
                                        <div class="controls">

                                                        <input required type="text" name="lat" placeholder="Latitude"> 


                                                        <input required type="text" name="lng" placeholder="Longitude">

                                        </div>
                                </div>
                                <div class="control-group">
                                    <label for="textfield" class="control-label">Map Zoom</label>
                                    <div class="controls">
                                        <input required type="text" name="zoom" id="textfield" placeholder="1-20" class="input-xlarge"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                        <label for="textarea" class="control-label">Description</label>
                                        <div class="controls">
                                                <textarea name="desc" id="textarea" rows="5" class="span4   "></textarea>
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