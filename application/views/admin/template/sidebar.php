<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?= ucwords($this->session->userdata('nama')); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header"><center><b>MENU ADMIN</b></center></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Mahasiswa</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('Admin') ?>"><i class="fa fa-circle-o"></i>Daftar Mahasiswa</a></li>
                    <li><a href="<?php echo site_url('input_mahasiswa') ?>"><i class="fa fa-circle-o"></i> Input Mahasiswa</a></li>
                </ul>
            </li>
           
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dosen</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('dashboard1') ?>"><i class="fa fa-circle-o"></i>Daftar Dosen</a></li>
                    <li><a href="<?php echo site_url('dashboard2') ?>"><i class="fa fa-circle-o"></i> Input Dosen</a></li>
                </ul>
            </li>

             <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Kaprodi</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('dashboard1') ?>"><i class="fa fa-circle-o"></i>Daftar Kaprodi</a></li>
                    <li><a href="<?php echo site_url('dashboard2') ?>"><i class="fa fa-circle-o"></i> Input Kaprodi</a></li>
                </ul>
            </li>

             <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Jurusan</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('dashboard1') ?>"><i class="fa fa-circle-o"></i>Daftar Jurusan</a></li>
                    <li><a href="<?php echo site_url('dashboard2') ?>"><i class="fa fa-circle-o"></i> Input Jurusan</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Tugas Akhir</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('dashboard1') ?>"><i class="fa fa-circle-o"></i>Daftar Tugas Akhir</a></li>
                    <li><a href="<?php echo site_url('dashboard2') ?>"><i class="fa fa-circle-o"></i> Input Tugas Akhir</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Log Bimbingan</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('dashboard1') ?>"><i class="fa fa-circle-o"></i>Daftar Log Bimbingan</a></li>
                </ul>
            </li>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">