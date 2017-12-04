<?php
$this->load->view('template/head');
?>

<?php
$this->load->view('dosen/template/topbar');
$this->load->view('dosen/template/sidebar');
?>
<!-- Page Header -->
<section class="content-header">
    <h1>
        Dosen Dashboard      <small>Update Password</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="">Dosen</a></li>
        <li class="active">Edit Password</li>
    </ol>
</section>

<!-- Header Content -->
<section class="content">
    <div class="row" >
        <div class="col-md-12">
            <div class="box box-info box-header with-border">
                <div class="box-body">
                    <div class="row">
                        <div class="widget-user-header">
                            <div class="col-sm-1">
                                <img class="img-circle" src="<?php echo base_url('/assets/img/add2.png') ?>" alt="User Avatar">
                                <div class="col-sm-1">
                                </div>
                            </div>
                            <h3 class="widget-user-username">Password</h3>
                            <h5 class="widget-user-desc">Update New Password</h5>
                            <hr>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="boxbox-widget widget-user-2">
                    <?php if(isset($msg) || validation_errors() !== ''): ?>
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-warning"></i> Peringatan!</h4>
                            <?= validation_errors();?>
                            <?= isset($msg)? $msg: ''; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('msg')) { ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-warning"></i> Peringatan!</h4>
                            <?php echo $this->session->flashdata('msg');?>
                        </div>
                    <?php }?>

                    <?php echo form_open(base_url('dosen/update_password'),  'class="form-horizontal"');  ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="password_lama" class="col-sm-2 control-label">Password Lama</label>
                            <div class="col-sm-6">
                                <input type="input" class="form-control" name="password_lama" id="password_lama" placeholder="Password Lama">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_baru" class="col-sm-2 control-label">Password Baru</label>
                            <div class="col-sm-6">
                                <input type="input" class="form-control" name="password_baru" id="password_baru" placeholder="Password Baru">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="konfirmasi_password" class="col-sm-2 control-label">Konfirmasi Password</label>
                            <div class="col-sm-6">
                                <input type="input" class="form-control" name="konfirmasi_password" id="konfirmasi_password" placeholder="Konfirmasi Password">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Content -->
                    <div class="box box-footer">
                        <button class="btn btn-primary" type="submit" name="submit" value="Add User" id="submit" data-stype='stay'>
                            <i class="fa fa-save" ></i> Save
                        </button>
                        <a class="btn btn-primary" href="<?= base_url('dosen'); ?>"><i class="fa fa-undo" data-stype='back'></i> Cancel</a>
                    </div>
                    <?php echo form_close( ); ?>
                </div>
            </div>
        </div>
        <!--/box body -->
    </div>
    <!--/box -->
    </div>
</section>

<?php
$this->load->view('template/js');
?>
