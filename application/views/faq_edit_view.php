<?php
$id;
$title;
$question;
$answer;



if(isset($record)){
    foreach($record as $row){
        $id         = $row->id;
        $title      = $row->title;
        $question   = $row->question;
        $answer     = $row->answer;
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
                            <h3><i class="icon-th-list"></i> Edit <?php echo $title ?> FAQ</h3>
                        </div>
                        <div class="box-content nopadding">
                            <form action="<?php echo base_url()?>index.php/<?php echo $this->uri->segment(1)?>/update" method="POST" class='form-horizontal form-striped'>
                                <div class="control-group">
                                    <label for="textfield" class="control-label">Title</label>
                                    <div class="controls">
                                        <input required type="text" name="title" value="<?php echo $title ?>" id="textfield" placeholder="Text input" class="input-xlarge"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                        <label class="control-label">Question</label>
                                        <div class="controls">
                                            <textarea required  rows="5" class="span4" name="question"><?php echo $question ?></textarea>

                                        </div>
                                </div>
                                <div class="control-group">
                                        <label class="control-label">Answer</label>
                                        <div class="controls">
                                           <textarea required  rows="5" class="span4" name="answer"><?php echo $answer ?></textarea>

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