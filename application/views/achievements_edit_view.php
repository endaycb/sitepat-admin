<?php
    
$id;
$title;
$desc;
$date;

if(isset($record)){
    foreach($record as $row){
        $id     = $row->id;
        $title  = $row->title;
        $desc   = $row->desc;
        $date   = $row->date;
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
                            <h3><i class="icon-th-list"></i> Edit <?php echo $title?> Achievements</h3>
                        </div>
                        <div class="box-content nopadding">
                            <form action="<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1)?>/update" method="POST" class='form-horizontal form-striped' enctype="multipart/form-data">
                            
                                <div class="control-group">
                                    <label for="textfield" class="control-label">Title</label>
                                    <div class="controls">
                                        <input required type="text" name="title" value="<?php echo $title?>" id="textfield" placeholder="Name" class="input-xlarge"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                        <label for="textarea" class="control-label">Description</label>
                                        <div class="controls">
                                            <textarea name="desc" id="textarea" rows="5" class="span4" maxlength="160"><?php echo $desc?></textarea>
                                        </div>
                                </div>
                                
                                <div class="control-group">
                                        <label for="date_end" class="control-label">Date</label>
                                        <div class="controls">
                                                <input required type="text" name="date" id="date_end" value="<?php echo $date?>" class="input-medium datepick">
                                        </div>
                                </div>
                                <div class="form-actions">
                                        <input type="hidden" name="id" value="<?php echo $id?>"></input>
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