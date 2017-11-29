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
        Admin Dashboard     <small>Detail Mahasiswa</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="">Admin</a></li>
        <li class="active">Detail Mahasiswa</li>
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
                            <h3 class="widget-user-username">Mahasiswa</h3>
                            <h5 class="widget-user-desc">Detail Mahasiswa</h5>
                            <hr>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="form-horizontal" name="form_Mahasiswa" id="form_Mahasiswa" >

                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">NIM</label>
                        <div class="col-sm-8">
                            <?= $user['mhs_nim']; ?>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-8">
                            <?= $user['mhs_nama']; ?>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">No HP</label>
                        <div class="col-sm-8">
                            <?= $user['mhs_nohp']; ?>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Alamat</label>
                        <div class="col-sm-8">
                            <?= $user['mhs_alamat']; ?>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-8">
                            <?= $user['mhs_email']; ?>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Angkatan</label>
                        <div class="col-sm-8">
                            <?= $user['mhs_angkatan']; ?>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Jurusan</label>
                        <div class="col-sm-8">
                            <?= $user['jrs_nama']; ?>
                        </div>
                    </div>

                    <br>
                    <br>

                    <!-- Footer Content -->
                    <div class="box box-footer">
                        <a href="<?= base_url('admin/mahasiswa/edit_mahasiswa/'.$user['mhs_nim']); ?>" class="btn btn-primary" ><i class="ion ion-ios-list-outline""></i> Update</a>
                        <a class="btn btn-primary" href="<?= base_url('admin/mahasiswa/list_mahasiswa'); ?>"><i class="fa fa-undo"" data-stype='back'></i> Back to List</a>
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
