<?php

$html_class         = "class=";
$html_class_active  = "'active'";
$this->load->model("system_queries_model");
?>
<div id="navigation">

		<div class="container-fluid">
			<a href="<?php echo base_url()?>index.php/home" id="brand">SiTepat</a>
			<ul class='main-nav'>
				<?php 
					foreach($menus_back as $rows){ 
						if($rows->url != "#"){
				?>
					<li <?php if($this->uri->segment(1) == $rows->url||!$this->uri->segment(1) && $rows->url == "home"){ echo "class='active'";}?>><a href="<?php echo base_url()?>index.php/<?php echo $rows->url?>"><?php echo $rows->name?></a></li>
				<?php 
				
						}else{
				?> 
					<li  class="<?php if($this->uri->segment(1) == $rows->url){ echo "active";}?> dropdown">
					<a href="<?php echo base_url()?>#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $rows->name?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<?php 
						/*	if($this->session->userdata("loged_in")==TRUE){
								$q_menus_sub    = "SELECT roles_detail.*, menus_sub.* "
												. "FROM roles_detail, menus_sub "
												. "WHERE menus_sub.id=roles_detail.menus_sub_id AND roles_detail.roles_id = ".$this->session->userdata("user_role")." AND menus_sub.menus_id = ".$rows->id."  "
												. "ORDER BY position ASC";
							}else{*/
								$q_menus_sub    = "SELECT * "
												. "FROM menus_sub "
												. "WHERE menus_id = ".$rows->id." /* and auth = 0 */ " 
												. "ORDER BY position ASC ";
						//}
							
							$retrieve_menus_sub = $this->system_queries_model->custom_query($q_menus_sub);
						   
							foreach($retrieve_menus_sub->result() as $row){
						?>
						<li><a href="<?php echo base_url()?>index.php/<?php echo $row->url?>"><?php echo $row->name;?></a></li>
						<?php } ?>
					   
					</ul>
				</li>
				<?php }  } ?>
			</ul>
			<div class="user">
<!--				<ul class="icon-nav">
					<li class='dropdown'>
						<a href="<?php echo base_url()?>dist/#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-envelope"></i><span class="label label-lightred">4</span></a>
						<ul class="dropdown-menu pull-right message-ul">
							<li>
								<a href="<?php echo base_url()?>dist/#">
									<img src="<?php echo base_url()?>dist/img/demo/user-1.jpg" alt="">
									<div class="details">
										<div class="name">Jane Doe</div>
										<div class="message">
											Lorem ipsum Commodo quis nisi ...
										</div>
									</div>
								</a>
							</li>
							<li>
								<a href="<?php echo base_url()?>dist/#">
									<img src="<?php echo base_url()?>dist/img/demo/user-2.jpg" alt="">
									<div class="details">
										<div class="name">John Doedoe</div>
										<div class="message">
											Ut ad laboris est anim ut ...
										</div>
									</div>
									<div class="count">
										<i class="icon-comment"></i>
										<span>3</span>
									</div>
								</a>
							</li>
							<li>
								<a href="<?php echo base_url()?>dist/#">
									<img src="<?php echo base_url()?>dist/img/demo/user-3.jpg" alt="">
									<div class="details">
										<div class="name">Bob Doe</div>
										<div class="message">
											Excepteur Duis magna dolor!
										</div>
									</div>
								</a>
							</li>
							<li>
								<a href="<?php echo base_url()?>dist/components-messages.html" class='more-messages'>Go to Message center <i class="icon-arrow-right"></i></a>
							</li>
						</ul>
					</li>
					<li class="dropdown sett">
						<a href="<?php echo base_url()?>dist/#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-cog"></i></a>
						<ul class="dropdown-menu pull-right theme-settings">
							<li>
								<span>Layout-width</span>
								<div class="version-toggle">
									<a href="<?php echo base_url()?>dist/#" class='set-fixed'>Fixed</a>
									<a href="<?php echo base_url()?>dist/#" class="active set-fluid">Fluid</a>
								</div>
							</li>
							<li>
								<span>Topbar</span>
								<div class="topbar-toggle">
									<a href="<?php echo base_url()?>dist/#" class='set-topbar-fixed'>Fixed</a>
									<a href="<?php echo base_url()?>dist/#" class="active set-topbar-default">Default</a>
								</div>
							</li>
							<li>
								<span>Sidebar</span>
								<div class="sidebar-toggle">
									<a href="<?php echo base_url()?>dist/#" class='set-sidebar-fixed'>Fixed</a>
									<a href="<?php echo base_url()?>dist/#" class="active set-sidebar-default">Default</a>
								</div>
							</li>
						</ul>
					</li>
					<li class='dropdown colo'>
						<a href="<?php echo base_url()?>dist/#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-tint"></i></a>
						<ul class="dropdown-menu pull-right theme-colors">
							<li class="subtitle">
								Predefined colors
							</li>
							<li>
								<span class='red'></span>
								<span class='orange'></span>
								<span class='green'></span>
								<span class="brown"></span>
								<span class="blue"></span>
								<span class='lime'></span>
								<span class="teal"></span>
								<span class="purple"></span>
								<span class="pink"></span>
								<span class="magenta"></span>
								<span class="grey"></span>
								<span class="darkblue"></span>
								<span class="lightred"></span>
								<span class="lightgrey"></span>
								<span class="satblue"></span>
								<span class="satgreen"></span>
							</li>
						</ul>
					</li>
					<li class='dropdown language-select'>
						<a href="<?php echo base_url()?>dist/#" class='dropdown-toggle' data-toggle="dropdown"><img src="<?php echo base_url()?>dist/img/demo/flags/us.gif" alt=""><span>US</span></a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="<?php echo base_url()?>dist/#"><img src="<?php echo base_url()?>dist/img/demo/flags/br.gif" alt=""><span>Brasil</span></a>
							</li>
							<li>
								<a href="<?php echo base_url()?>dist/#"><img src="<?php echo base_url()?>dist/img/demo/flags/de.gif" alt=""><span>Deutschland</span></a>
							</li>
							<li>
								<a href="<?php echo base_url()?>dist/#"><img src="<?php echo base_url()?>dist/img/demo/flags/es.gif" alt=""><span>España</span></a>
							</li>
							<li>
								<a href="<?php echo base_url()?>dist/#"><img src="<?php echo base_url()?>dist/img/demo/flags/fr.gif" alt=""><span>France</span></a>
							</li>
						</ul>
					</li>
				</ul>-->
				<div class="dropdown">
					<a href="<?php echo base_url()?>dist/#" class='dropdown-toggle' data-toggle="dropdown">John Doe <img src="<?php echo base_url()?>dist/img/demo/user-avatar.jpg" alt=""></a>
					<ul class="dropdown-menu pull-right">
						<li>
							<a href="<?php echo base_url()?>dist/more-userprofile.html">Edit profile</a>
						</li>
						<li>
							<a href="<?php echo base_url()?>dist/#">Account settings</a>
						</li>
						<li>
							<a href="<?php echo base_url()?>dist/more-login.html">Sign out</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
        </div>
