<header>
<body class="skin-yellow">
    <div class="wrapper">

        <header class="main-header">
            <a href="<?php echo base_url('admin/dashboard') ?>" class="logo"><b>SIBIMTA</b>UMY</a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo base_url().'uploads/foto/admin/'.$this->session->userdata('foto');;?>" class="user-image" alt="User Image"/>
                                <span class="hidden-xs"><?= ucwords($this->session->userdata('nama')); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="<?php echo base_url().'uploads/foto/admin/'.$this->session->userdata('foto');;?>" class="img-circle" alt="User Image" />
                                    <p><?= ucwords($this->session->userdata('nama')); ?>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo base_url('admin/profile/profile_admin') ?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url('auth/login/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

