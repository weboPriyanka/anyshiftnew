<!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-purple" style="background:#33277F;">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse1" href="javascript:"><span></span></a>
            <a href="<?= base_url() ?>" class="b-brand">
               <div class="b-bg">
                   <i class="feather icon-trending-up"></i>
               </div>
               <span class="b-title">Facility Owner</span>
           </a>
        </div>
        <a class="mobile-menu" id="mobile-header" href="javascript:">
            <i class="feather icon-more-horizontal"></i>
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li><a href="javascript:" class="full-screen" onclick="javascript:toggleFullScreen()"><i class="feather icon-maximize"></i></a></li>
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle" href="javascript:" data-toggle="dropdown">Dropdown</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="javascript:">Action</a></li>
                        <li><a class="dropdown-item" href="javascript:">Another action</a></li>
                        <li><a class="dropdown-item" href="javascript:">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <div class="main-search">
                        <div class="input-group">
                            <input type="text" id="m-search" class="form-control" placeholder="Search . . ." />
                            <a href="javascript:" class="input-group-append search-close">
                                <i class="feather icon-x input-group-text"></i>
                            </a>
                            <span class="input-group-append search-btn btn btn-primary">
                                <i class="feather icon-search input-group-text"></i>
                            </span>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="javascript:" data-toggle="dropdown"><i class="icon feather icon-bell"></i></a>
                        <div class="dropdown-menu dropdown-menu-right notification">
                            <div class="noti-head">
                                <h6 class="d-inline-block m-b-0">Notifications</h6>
                                <div class="float-right">
                                    <a href="javascript:" class="m-r-10">mark as read</a>
                                </div>
                            </div>
                            <ul class="noti-body">
							    <?php if(!empty($JobNotifications)){?>
                                <li class="n-title">
                                    <p class="m-b-0">JOBS ADDED</p>
                                </li>
								<?php foreach($JobNotifications as $job){?>
                                <li class="notification">
                                    <div class="media">
                                        <div class="media-body">
                                            <p><strong><?php echo $job['sm_name'];?></strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i><?php echo $job['not_text'];?></span></p>
                                            <p><?php echo $job['not_text'];?></p>
                                        </div>
                                    </div>
                                </li>
								<?php }} ?>
                                <li class="n-title">
                                    <p class="m-b-0">EARLIER</p>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="../assets/images/user/avatar-2.jpg" alt="Generic placeholder image" />
                                        <div class="media-body">
                                            <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                            <p>Prchace New Theme and make payment</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="../assets/images/user/avatar-3.jpg" alt="Generic placeholder image" />
                                        <div class="media-body">
                                            <p><strong>Sara Soudein</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                            <p>currently login</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li><a href="javascript:" class="displayChatbox"><i class="icon feather icon-mail"></i></a></li>
                <li>
                    <div class="dropdown drp-user">
                        <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon feather icon-settings"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="<?= base_url() ?>app_assets/images/user/avatar-1.jpg" class="img-radius" alt="User-Profile-Image" />
                                <span><?php echo ucwords($this->session->userdata('rudra_fo_fname')).'&nbsp;'.ucwords($this->session->userdata('rudra_fo_lname')); ?></span>
                                <a href="<?= base_url('tv-owner-logout') ?>" class="dud-logout" title="Logout">
                                    <i class="feather icon-log-out"></i>
                                </a>
                            </div>
                            <ul class="pro-body">
								<!-- <li><a href="<?= base_url('fo_profile') ?>" class="dropdown-item"><i class="feather icon-user"></i> PProfile</a></li>
                                 -->
                                <!--li><a href="javascript:" class="dropdown-item"><i class="feather icon-settings"></i> Settings</a></li>
                                
								<li><a href="./message.html" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a></li>
                                <li><a href="./auth-signin.html" class="dropdown-item"><i class="feather icon-lock"></i> Lock Screen</a></li-->
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>
    <!-- [ Header ] end -->
	
	