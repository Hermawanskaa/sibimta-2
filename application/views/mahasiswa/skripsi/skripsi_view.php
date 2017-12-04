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
        Mahasiswa Dashboard     <small>Detail Skripsi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="">Mahasiswa</a></li>
        <li class="active">Detail Skripsi</li>
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
                            <h3 class="widget-user-username">Skripsi</h3>
                            <h5 class="widget-user-desc">Detail Skripsi</h5>
                            <hr>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="form-horizontal" name="form_Admin" id="form_Admin" >
                <?php foreach ($user as $row) ;?>
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Mahasiswa</label>
                        <div class="col-sm-8">
                            <?php echo $row->mhs_id; ?>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Judul</label>
                        <div class="col-sm-8">
                            <?php echo $row->jdl_judul; ?>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Deskripsi</label>
                        <div class="col-sm-8">
                            <?php echo $row->jdl_deskripsi; ?>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Judul (English)</label>
                        <div class="col-sm-8">
                            <?php echo $row->jdl_enjudul; ?>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-8">
                            <?php echo $row->jdl_status; ?>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Tanggal Mulai</label>
                        <div class="col-sm-8">
                            <?php echo $row->jdl_tanggal; ?>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="box box-footer">
                        <a class="btn btn-primary" href="<?= base_url('mahasiswa'); ?>"><i class="fa fa-undo"" data-stype='back'></i> Back</a>
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
