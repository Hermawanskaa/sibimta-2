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
        Admin Dashboard    <small>Edit Jurusan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="">Admin</a></li>
        <li class="active">Edit Jurusan</li>
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
                                <img class="img-circle" src="<?php echo base_url('/assets/img/add2.png') ?>" alt="User Avatar">
                                <div class="col-sm-1">
                                </div>
                            </div>
                            <h3 class="widget-user-username">Jurusan</h3>
                            <h5 class="widget-user-desc">Edit Jurusan</h5>
                            <hr>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="boxbox-widget widget-user-2">
                    <?php if(isset($msg) || validation_errors() !== ''): ?>
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
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

                    <?php echo form_open_multipart(base_url('admin/jurusan/edit_jurusan/'.$user['jrs_id']),  'class="form-horizontal"');  ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="jrs_id" class="col-sm-2 control-label">ID Jurusan</label>
                            <div class="col-sm-6">
                                <input type="input" class="form-control" name="jrs_id" id="jrs_id" placeholder="ID Jurusan" value="<?= $user['jrs_id']; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jrs_nama" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-6">
                                <input type="input" class="form-control" name="jrs_nama" id="jrs_nama" placeholder="Nama Jurusan" value="<?= $user['jrs_nama']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jrs_kode" class="col-sm-2 control-label">Kode</label>
                            <div class="col-sm-6">
                                <input type="input" class="form-control" name="jrs_kode" id="jrs_kode" placeholder="Kode Jurusan" value="<?= $user['jrs_kode']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fak_id" class="col-sm-2 control-label">Fakultas</label>
                            <div class="col-sm-6">
                                <select name="fak_id" id="fak_id" class="form-control">
                                    <option value=''>Please Select</option>
                                    <?php foreach($fakultas->result() as $row):?>
                                        <option value="<?php echo $row->fak_id;?>"><?php echo $row->fak_nama;?></option>
                                        <?php echo $row->fak_id;?>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Content -->
                <div class="box box-footer">
                    <button class="btn btn-primary" type="submit" name="submit" value="Add User" id="submit" data-stype='stay'>
                        <i class="fa fa-save" ></i> Save
                    </button>
                    <a class="btn btn-primary" href="<?= base_url('admin/jurusan/list_jurusan'); ?>"><i class="fa fa-undo"" data-stype='back'></i> Back to List</a>
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
