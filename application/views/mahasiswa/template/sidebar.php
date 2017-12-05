<aside class="main-sidebar">
    <section class="sidebar">
        <br>
        <div class="text-center image">
            <img src="<?php echo base_url().'uploads/foto/mahasiswa/'.$this->session->userdata('foto');;?>" width="50%" class="img-circle" alt="User Image" />
        </div>
        <div class="user-panel">
            <div class="text-center info">
                <p><?= ucwords($this->session->userdata('nama')); ?></p>
                <p><?= ucwords($this->session->userdata('nim')); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="header"><center><b>MENU MAHASISWA</b></center></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>User Profile</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('profil/profil_mahasiswa') ?>"><i class="fa fa-circle-o"></i>Detail Mahasiswa</a></li>
                    <li><a href="<?= base_url('mahasiswa/update_password'); ?>"><i class="fa fa-circle-o"></i> Ganti Password</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Pesan Masuk</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('mahasiswa/pesan') ?>"><i class="fa fa-circle-o"></i>Pesan Masuk</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Tugas Akhir</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('skripsi') ?>"><i class="fa fa-circle-o"></i>Status TA</a></li>
                </ul>
            </li>
    </section>
</aside>
<div class="content-wrapper">