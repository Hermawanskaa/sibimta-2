<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url().'uploads/foto/admin/'.$this->session->userdata('foto');;?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?= ucwords($this->session->userdata('nama')); ?></p>
                <p><?= ucwords($this->session->userdata('nip')); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header"><center><b>MENU ADMIN</b></center></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Admin</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('admin/admin/list_admin') ?>"><i class="fa fa-circle-o"></i>Daftar Admin</a></li>
                    <li><a href="<?php echo site_url('admin/admin/add_admin') ?>"><i class="fa fa-circle-o"></i>Input Admin</a></li>
                </ul>
            </li>
           
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dosen</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('admin/dosen/list_dosen') ?>"><i class="fa fa-circle-o"></i>Daftar Dosen</a></li>
                    <li><a href="<?php echo site_url('admin/dosen/add_dosen') ?>"><i class="fa fa-circle-o"></i>Input Dosen</a></li>
                </ul>
            </li>

             <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Mahasiswa</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('admin/mahasiswa/list_mahasiswa') ?>"><i class="fa fa-circle-o"></i>Daftar Mahasiswa</a></li>
                    <li><a href="<?php echo site_url('admin/mahasiswa/add_mahasiswa') ?>"><i class="fa fa-circle-o"></i>Input Mahasiswa</a></li>
                </ul>
            </li>

             <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Fakultas</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('admin/fakultas/list_fakultas') ?>"><i class="fa fa-circle-o"></i>Daftar Fakultas</a></li>
                    <li><a href="<?php echo site_url('admin/fakultas/add_fakultas') ?>"><i class="fa fa-circle-o"></i>Input Fakultas</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Program Studi</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('admin/jurusan/list_jurusan') ?>"><i class="fa fa-circle-o"></i>Daftar Jurusan</a></li>
                    <li><a href="<?php echo site_url('admin/jurusan/add_jurusan') ?>"><i class="fa fa-circle-o"></i>Input Jurusan</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dosen Pembimbing</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('admin/pembimbing/list_pembimbing') ?>"><i class="fa fa-circle-o"></i>Daftar Dosbing</a></li>
                    <li><a href="<?php echo site_url('admin/pembimbing/add_pembimbing') ?>"><i class="fa fa-circle-o"></i>Input Dosbing</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Master Laporan</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('admin/katlap/list_katlap') ?>"><i class="fa fa-circle-o"></i>Kategori Laporan</a></li>
                    <li><a href="<?php echo site_url('admin/katlap/add_katlap') ?>"><i class="fa fa-circle-o"></i>Input Kategori</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Tugas Akhir</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('admin/skripsi/list_skripsi') ?>"><i class="fa fa-circle-o"></i>Daftar Tugas Akhir</a></li>
                    <li><a href="<?php echo site_url('admin/skripsi/add_skripsi') ?>"><i class="fa fa-circle-o"></i>Input Tugas Akhir</a></li>
                </ul>
            </li>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">