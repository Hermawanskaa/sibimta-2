<?php
$this->load->view('template/head');
?>

<?php
$this->load->view('admin/template/topbar');
$this->load->view('admin/template/sidebar');
?>

<!-- Page Header -->
<section class="content-header">
    <h1>
        Admin Dashboard     <small>Detail Fakultas</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="">Admin</a></li>
        <li class="active">Detail Fakultas</li>
    </ol>
</section>

<!-- Header Content -->
<section class="content">
    <div class="row" >
        <div class="col-md-12">
            <div class="box box-info box-header with-border">
                <div class="box-body ">
                    <div class="row">
                        <div class="widget-user-header">
                            <div class="col-sm-1">
                                <img class="img-circle" src="<?php echo base_url('/assets/img/view.png') ?>" alt="User Avatar">
                                <div class="col-sm-1">
                                </div>
                            </div>
                            <h3 class="widget-user-username">Fakultas</h3>
                            <h5 class="widget-user-desc">Detail Fakultas</h5>
                            <hr>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="form-horizontal" name="form_Admin" id="form_Admin" >

                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-8">
                            <?= $user['fak_nama']; ?>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Kode</label>
                        <div class="col-sm-8">
                            <?= $user['fak_kode']; ?>
                        </div>
                    </div>
                    <br>
                    <br>

                    <!-- Footer Content -->
                    <div class="box box-footer col-sm-offset-2 col-sm-8">
                        <a href="<?= base_url('admin/fakultas/edit_fakultas/'.$user['fak_id']); ?>" class="btn btn-primary" ><i class="ion ion-ios-list-outline""></i> Update</a>
                        <a class="btn btn-warning" href="<?= base_url('admin/fakultas/list_fakultas'); ?>"><i class="fa fa-undo"" data-stype='back'></i> Back to List</a>
                    </div>
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
