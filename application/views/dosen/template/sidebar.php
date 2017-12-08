<aside class="main-sidebar">
    <section class="sidebar">
        <br>
        <div class="text-center image">
            <img src="<?php echo base_url().'uploads/foto/dosen/'.$this->session->userdata('foto');;?>" width="50%" class="img-circle" alt="User Image" />
        </div>
        <div class="user-panel">
            <div class="text-center info">
                <p><?= ucwords($this->session->userdata('nama')); ?></p>
                <p><?= ucwords($this->session->userdata('nip')); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header"><center><b>MENU DOSEN</b></center></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>User Profile</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('profil/profil_dosen') ?>"><i class="fa fa-circle-o"></i>Detail Dosen</a></li>
                    <li><a href="<?= base_url('dosen/update_password'); ?>"><i class="fa fa-circle-o"></i> Ganti Password</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Pesan Masuk</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('dosen/pesan') ?>"><i class="fa fa-circle-o"></i>Pesan Masuk</a></li>
                </ul>
            </li>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">