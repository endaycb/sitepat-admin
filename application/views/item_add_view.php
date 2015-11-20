
<div class="container-fluid" id="content">
    <div id="main">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="box box-bordered">
                        <div class="box-title">
                            <h3><i class="icon-th-list"></i> Add <?php echo strtoupper($item_type) ?></h3>
                        </div>
                        <div class="box-content nopadding">

                            <form action="<?php echo base_url() ?>index.php/<?php echo $this->uri->segment(1) ?>/create" method="POST" class='form-horizontal form-striped' enctype="multipart/form-data">
                                			
                                 <div class="control-group">
                                        <label class="">BASIC INFO ITEM</label>
                                    </div>
                                <?php if ($form_brand == true) { ?>
                                    <div class="control-group">
                                        <label  class="control-label">Brand</label>
                                        <div class="controls">
                                            <div class="input-xlarge">
                                                <select name="brand_id" id="brand" class='chosen-select'>
                                                    <?php
                                                    if (isset($brand)) {
                                                        foreach ($brand as $row) {
                                                            ?>
                                                            <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
                                                        <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if ($form_name == true) { ?>
                                    <div class="control-group">
                                        <label class="control-label">Name</label>
                                        <div class="controls">
                                            <input required type="text" name="name" id="textfield" placeholder="Name" class="input-xlarge"/>
                                        </div>
                                    </div>
                                <?php } ?>
                                
                                <?php if ($form_detail_info == true) { ?> 
                                 <div class="control-group">
                                    <label class="control-label">DETAIL INFO ITEM</label>
                                    <div class="controls">
                                        <div class="form_copy_from btn btn-primary"  link="form_detail"><i class="icon-plus-sign"></i></div>
                                        <div class="form_remove_from btn btn-danger" link="form_detail"><i class="icon-trash"></i></div>
                                        <input type="hidden" value="1" name="detail_count" id="form_detail_count"/>
                                    </div>
                                </div>
                                <?php } ?>
                                
                                <?php //FORM BAN  ?>
                                <?php if ($form_ban == true) { ?>
                                	
                                
                                <div id="form_detail">
                                    <div id="form_detail_1">
                                        <div class="control-group">
                                            <label class="">DETAIL INFO</label>
                                            
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label">Simple Description</label>
                                            <div class="controls">
                                                <input  type="text" name="simple_desc[]" id="textfield" placeholder="" class="input-xlarge" maxlength="255"/>
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label  class="control-label">Tube Type</label>
                                            <div class="controls">
                                                <div class="input-xlarge">
                                                    <select name="tube_type[]" id="tube_type">

                                                        <option value="1">Tube</option>
                                                        <option value="2">Tube Less</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="control-group" id="size">
                                            <label class="control-label">Size</label>
                                            <div class="controls">

                                                <input required name="width[]" id="size1" class='input-small' placeholder="00"> 
                                                /
                                                <input required name="ratio[]" id="size2" class='input-small' placeholder="00">
                                                -
                                                <input required name="diameter[]" id="size2" class='input-small' placeholder="00">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php } ?>

                                <?php //FORM OLI  ?>

                                <?php if ($form_oli == true) { ?>
                                 <div id="form_detail">
                                    <div id="form_detail">
                                        <div id="form_detail_1">
                                            <div class="control-group">
                                                <label class="">DETAIL INFO</label>
                                            
                                            </div>
                                             <div class="control-group">
                                                <label class="control-label">Simple Description</label>
                                                <div class="controls">
                                                    <input  type="text" name="simple_desc[]" id="textfield" placeholder="" class="input-xlarge" maxlength="255"/>
                                                </div>
                                            </div>
                                            
                                            <div class="control-group">
                                                <label class="control-label">SAE</label>
                                                <div class="controls">
                                                    <input required type="text" name="sae1[]" id="textfield" placeholder="" class="input-small"/> W - 
                                                    <input required type="text" name="sae2[]" id="textfield" placeholder="" class="input-small"/>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label">Liter</label>
                                                <div class="controls">
                                                    <input required type="text" name="liter[]" id="textfield" placeholder="" class="input-small"/>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label  class="control-label">API Service</label>
                                                <div class="controls">
                                                    <div class="input-xlarge">
                                                        <select name="service[]" id="service">

                                                            <option value="1">JASO MA</option>
                                                            <option value="2">JASO MB</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                 </div>
                                <?php } ?>

                                <?php //FORM AKI  ?>

                                <?php if ($form_aki == true) { ?>
                                 <div id="form_detail">
                                    <div id="form_detail">
                                        <div id="form_detail_1">
                                            <div class="control-group">
                                                <label class="">DETAIL INFO</label>

                                            </div>
                                            
                                             <div class="control-group">
                                                <label class="control-label">Simple Description</label>
                                                <div class="controls">
                                                    <input  type="text" name="simple_desc[]" id="textfield" placeholder="" class="input-xlarge" maxlength="255"/>
                                                </div>
                                            </div>
                                            
                                            <div class="control-group">
                                                <label  class="control-label">AKI Type</label>
                                                <div class="controls">
                                                    <div class="input-xlarge">
                                                        <select name="aki_type[]" id="aki_type">

                                                            <option value="1">Basah</option>
                                                            <option value="2">Kering</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label">Ampere</label>
                                                <div class="controls">
                                                    <input required type="text" name="ampere[]" id="textfield" placeholder="" class="input-small"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                 </div>
                                <?php } ?>
                                  <?php if ($form_vehicle == true) { ?>
                                 <div id="form_detail">
                                    <div id="form_detail">
                                        <div id="form_detail_1">
                                            
                                            <div class="control-group">
                                                <label  class="control-label">Vehicle Type</label>
                                                <div class="controls">
                                                    <div class="input-xlarge">
                                                        <select name="vehicle_type" id="aki_type">

                                                            <option value="1">Bebek</option>
                                                            <option value="2">Matic</option>
                                                            <option value="3">Sport</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Rim Size</label>
                                                <div class="controls">
                                                    <input required type="text" name="rim" id="textfield" placeholder="Rim Diameter" class="input-small"/>
                                                </div>
                                            </div>
                                            <div class="control-group" id="size">
                                                <label class="control-label">Front Size</label>
                                                <div class="controls">

                                                    <input required name="front_width" id="" class='input-small' placeholder="00"> 
                                                    /
                                                    <input required name="front_ratio" id="" class='input-small' placeholder="00">
                                                </div>
                                            </div>
                                            
                                            <div class="control-group" id="size">
                                                <label class="control-label">Back Size</label>
                                                <div class="controls">

                                                    <input required name="back_width" id="" class='input-small' placeholder="00"> 
                                                    /
                                                    <input required name="back_ratio" id="" class='input-small' placeholder="00">
                                                </div>
                                            </div>
                                            
                                             <div class="control-group">
                                                <label class="control-label">Oil Capacity</label>
                                                <div class="controls">
                                                    <input required type="text" name="liter" id="textfield" placeholder="Liter" class='input-small'/>
                                                </div>
                                            </div>
                                            
                                             <div class="control-group">
                                                <label class="control-label">Ampere</label>
                                                <div class="controls">
                                                    <input required type="text" name="ampere" id="textfield" placeholder="Ampere" class='input-small'/>
                                                </div>
                                            </div>
                                            
                                              <div class="control-group">
                                                <label for="recomended_item" class="control-label">Recomended OLI</label>
                                                <div class="controls">
                                                    <div class="input-xlarge">
                                                        <div id="region_form" >
                                                            <select name="recomended_oli" id="recomended_oli" class="chosen-select" >
                                                                <option value="0"></option>
                                                                <?php
                                                                if (isset($oli)) {
                                                                    foreach ($oli as $row) {
                                                                        ?>
                                                                        <option value="<?php echo $row->oli_id ?>"><?php echo $row->brand_name . " - " . $row->name ." ". $row->oli_liter?> Liter</option>
                                                                <?php } } ?>
                                                                        
                                                            </select>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="control-group">
                                                <label for="recomended_item" class="control-label">Recomended AKI</label>
                                                <div class="controls">
                                                    <div class="input-xlarge">
                                                        <div id="region_form" >
                                                            <select name="recomended_aki" id="recomended_aki" class="chosen-select" >
                                                                <option value="0"></option>
                                                                <?php
                                                                if (isset($aki)) {
                                                                    foreach ($aki as $row) {
                                                                        ?>
                                                                        <option value="<?php echo $row->aki_id ?>"><?php echo $row->brand_name . " - " . $row->name ." ". $row->aki_ampere?> Ampere</option>
                                                                <?php } } ?>
                                                            </select>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                 </div>
                                <?php } ?>       
                                <?php //END FORM  ?>
                                
                                  <?php if ($form_additional_info == true) { ?> 
                                
                                 <div class="control-group">
                                        <label class="">ADDITIONAL INFO ITEM</label>
                                    </div>
                                <?php } ?>
                                <?php if ($form_image == true) { ?>
                                    <div class="control-group">
                                        <label for="textfield" class="control-label">Image</label>
                                        <div class="controls">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" /></div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                <div>
                                                    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input  type="file" name='image' /></span>
                                                    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if ($form_desc == true) { ?>
                                    <div class="control-group">
                                        <label for="desc" class="control-label">Description <small>You may add an article for this Item</small></label>
                                        <div class="box-content nopadding controls">
                                            <textarea name="ck" id="editor1" class=' span12' rows="5"></textarea>
                                        </div>		
                                    </div>
                                <?php } ?>

                                <?php if ($form_recomended_vehicle == true) { ?>
                                    <div class="control-group">
                                        <label for="recomended_item" class="control-label">Recomended Vehicle</label>
                                        <div class="controls">
                                            <div class="input-xlarge">
                                                <div id="region_form" >
                                                    <select name="recomended_item[]" id="recomended_item" multiple="multiple" class="chosen-select input-xxlarge" >
                                                        <?php
                                                        if (isset($vehicle)) {
                                                            foreach ($vehicle as $row) {
                                                                ?>
                                                                <option value="<?php echo $row->id ?>"><?php echo $row->brand_name . " - " . $row->name ?></option>
                                                        <?php } } ?>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                
                                  <?php } ?>
                                <div class="form-actions">
                                    <input type="hidden" name="type" value="<?php echo $item_type;?>"></input>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                    <a href="<?php echo base_url() . "index.php/" . $this->uri->segment(1) ?>" class="btn">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>