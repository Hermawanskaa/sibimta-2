<?php
$this->load->view('template/head');
?>

<?php
$this->load->view('dosen/template/topbar');
$this->load->view('dosen/template/sidebar');
?>

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
                            <img src="<?php echo base_url().'uploads/foto/dosen/'.$this->session->userdata('foto');;?>" width="50%" class="avatar img-circle" alt="avatar">
                        </div>
                    </div>

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
                                <label for="content" class="col-sm-2 control-label">NIP</label>
                                <div class="col-sm-8"><?php echo $dosen['dsn_nip']; ?></div>
                            </div>
                            <hr>
                            <div class="form-group ">
                                <label for="content" class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-8"><?php echo $dosen['dsn_nama']; ?></div>
                            </div>
                            <hr>
                            <div class="form-group ">
                                <label for="content" class="col-sm-2 control-label">Nomor Hp</label>
                                <div class="col-sm-8"><?php echo $dosen['dsn_nohp']; ?></div>
                            </div>
                            <hr>
                            <div class="form-group ">
                                <label for="content" class="col-sm-2 control-label">Alamat</label>
                                <div class="col-sm-8"><?php echo $dosen['dsn_alamat']; ?></div>
                            </div>
                            <hr>
                            <div class="form-group ">
                                <label for="content" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-8"><?php echo $dosen['dsn_email']; ?></div>
                            </div>
                            <hr>
                            <hr>
                            <br>
                            <br>
                            <!-- Footer Content -->
                            <div class="box box-footer">
                                <a class="btn btn-warning" href="<?= base_url('dosen'); ?>"><i class="fa fa-undo center-block"" data-stype='back'></i> Back to Dashboard</a>
                                <a class="btn btn-primary" href="<?= base_url('dosen/update_password'); ?>"><i class="fa fa-file-pdf-o" ></i> Change Password</a>
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
