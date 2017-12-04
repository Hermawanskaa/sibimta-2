<?php
$this->load->view('template/head');
?>

<?php
$this->load->view('mahasiswa/template/topbar');
$this->load->view('mahasiswa/template/sidebar');
?>

<!-- Page Header -->
<section class="content-header">
   <h1>
      Profil      <small>Detail Profil</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="">Profil</a></li>
      <li class="active">Detail Profil</li>
   </ol>
</section>

<section class="content">
    <div class="row" >
        <div class="col-md-12">
            <div class="box box-info box-header with-border">
                <div class="box-body ">
                    <div class="col-md-3">
                        <div class="text-center">
                            <img src="<?php echo base_url().'uploads/foto/mahasiswa/'.$this->session->userdata('foto');;?>" class="avatar img-circle" alt="avatar">
                        </div>
                    </div>

                    <!-- edit form column -->
                    <div class="widget-user-header">
                        <div class="row col-md-4 pull-right">

                        </div>
                        <div class="col-sm-1">
                            <img class="img-circle" src="<?php echo base_url('/assets/img/list.png') ?>" alt="User Avatar">
                        </div>
                        <h3 class="widget-user-username col-sm-3"><strong>PERSONAL INFO</strong></h3>
                    </div>

                    <div class="col-md-9 personal-info">
                        <hr>
                        <div class="form-horizontal" name="form_Admin" id="form_Admin" >
                            <div class="form-group ">
                                <label for="content" class="col-sm-2 control-label">NIM</label>
                                <div class="col-sm-8"><?php echo $mahasiswa['mhs_nim']; ?></div>
                            </div>
                            <hr>
                            <div class="form-group ">
                                <label for="content" class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-8"><?php echo $mahasiswa['mhs_nama']; ?></div>
                            </div>
                            <hr>
                            <div class="form-group ">
                                <label for="content" class="col-sm-2 control-label">Nomor Hp</label>
                                <div class="col-sm-8"><?php echo $mahasiswa['mhs_nohp']; ?></div>
                            </div>
                            <hr>
                            <div class="form-group ">
                                <label for="content" class="col-sm-2 control-label">Alamat</label>
                                <div class="col-sm-8"><?php echo $mahasiswa['mhs_alamat']; ?></div>
                            </div>
                            <hr>
                            <div class="form-group ">
                                <label for="content" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-8"><?php echo $mahasiswa['mhs_email']; ?></div>
                            </div>
                            <hr>
                            <div class="form-group ">
                                <label for="content" class="col-sm-2 control-label">Angkatan</label>
                                <div class="col-sm-8"><?php echo $mahasiswa['mhs_angkatan']; ?></div>
                            </div>
                            <hr>
                            <div class="form-group ">
                                <label for="content" class="col-sm-2 control-label">Jurusan</label>
                                <div class="col-sm-8"><?php echo $mahasiswa['jrs_nama']; ?></div>
                            </div>
                            <hr>
                            <br>
                            <br>
                            <!-- Footer Content -->
                            <div class="box box-footer">
                                <a class="btn btn-primary" href="<?= base_url('mahasiswa'); ?>"><i class="fa fa-undo center-block"" data-stype='back'></i> Back to Dashboard</a>
                                <a class="btn btn-primary" href="<?= base_url('mahasiswa/update_password'); ?>"><i class="fa fa-file-pdf-o" ></i> Change Password</a>
                            </div>
                        </div>
                </div>



        </div>
    </div>
    </div>
</section>
<!-- /.content -->


<?php
$this->load->view('template/js');
?>
