<div class="container-fluid" id="content">
    <div id="main">
        <div class="container-fluid">
            <div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered red">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									STORE
								</h3>
                                                            <a href="<?php echo base_url()."index.php/".$this->uri->segment(1)."/add";?>" class="btn btn-inverse pull-right margin3"><i class="icon-plus-sign"></i> Add Entry</a>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-striped dataTable dataTable-colvis">
									<thead>
										<tr>
                                                                            <?php
                                                                                
                                                                                if(isset($fields))
                                                                                    foreach($fields as $row){
                                                                                      
                                                                            ?>
                                                                                <th><?php echo str_replace("_", " ", $row);?></th>
                                                                            <?php  } ?>
                                                                                <th width="5%">Option</th>
                                                                            </tr>
											
										</tr>
									</thead>
									<tbody>
                                                                          
                                                                              <?php
                                                                                if(isset($records))
                                                                                    foreach($records as $row){
                                                                              ?>
                                                                                <tr>
                                                                                  <?php
                                                                                    if(isset($fields))
                                                                                        foreach($fields as $row_fields){
                                                                                            
                                                                                  ?>
                                                                                    <td><?php 
                                                                                            if($row_fields!="image"){ echo $row->{$row_fields};}
                                                                                            else{
                                                                                        ?>
                                                                                        <img src="<?php echo $section_image_path.$row->{$row_fields}?>" width="150px"></img>
                                                                                    </td>
                                                                                    <?php } }?>
                                                                                    <td>
                                                                                        <a href="<?php echo base_url()."index.php/".$this->uri->segment(1)."/edit/".$row->id;?>" class="btn btn-small btn-inverse"><i class="icon-edit"></i></a>
                                                                                        <a href="<?php echo base_url()."index.php/".$this->uri->segment(1)."/delete/".$row->id;?>" class="btn btn-small btn-danger" onclick="return confirm('Are you sure?')"><i class="icon-trash"></i></a>
                                                                                    </td>
                                                                                </tr>
                                                                                <?php } ?>      
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
        </div>
    </div>
</div>