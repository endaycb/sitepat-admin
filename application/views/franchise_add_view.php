<div class="container-fluid" id="content">
    <div id="main">
        <div class="container-fluid">
            <div class="row-fluid">
		<div class="span12">
                    <div class="box box-bordered">
                        <div class="box-title">
                            <h3><i class="icon-th-list"></i> Add Franchise</h3>
                        </div>
                        <div class="box-content nopadding">
                            <form action="<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1)?>/create" method="POST" class='form-horizontal form-striped' enctype="multipart/form-data">
                            
                                <div class="control-group">
                                    <label for="textfield" class="control-label">Title</label>
                                    <div class="controls">
                                        <input required type="text" name="title" id="textfield" placeholder="Title" class="input-xlarge"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                        <label for="" class="control-label">Franchise Article</label>
                                        <div class=" nopadding controls">
                                            <textarea name="article" class=' span12'  id="editor1" rows="5"></textarea>
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
