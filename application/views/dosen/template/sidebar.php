<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url().'uploads/foto/dosen/'.$this->session->userdata('foto');;?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?= ucwords($this->session->userdata('nama')); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header"><center><b>MENU DOSEN</b></center></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Mahasiswa</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('Admin1/list_dosen') ?>"><i class="fa fa-circle-o"></i> Progress Mahasiswa</a></li>
                    <li><a href="<?php echo site_url('Admin1/add_dosen') ?>"><i class="fa fa-circle-o"></i> Bimbingan Mahasiswa</a></li>
                </ul>
            </li>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">