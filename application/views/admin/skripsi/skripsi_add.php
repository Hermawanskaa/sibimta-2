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
        Admin Dashboard      <small>Add Skripsi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="">Admin</a></li>
        <li class="active">Add Skripsi</li>
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
                            <h3 class="widget-user-username">Skripsi</h3>
                            <h5 class="widget-user-desc">Add New Skripsi</h5>
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

                    <?php echo form_open_multipart(base_url('admin/skripsi/add_skripsi'),  'class="form-horizontal"');  ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="mhs_id" class="col-sm-2 control-label">Mahasiswa</label>
                            <div class="col-sm-6">
                                <select name="mhs_id" id="mhs_id" class="form-control">
                                    <option value=''>Please Select</option>
                                    <?php foreach($mahasiswa->result() as $row):?>
                                        <option value="<?php echo $row->mhs_id;?>"><?php echo $row->mhs_nama;?></option>
                                        <?php echo $row->mhs_id;?>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_baru" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-6">
                                <input type="input" class="form-control" name="password_baru" id="password_baru" placeholder="Password">
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
                        <div class="form-group">
                            <label for="jdl_judul" class="col-sm-2 control-label">Judul Skripsi</label>
                            <div class="col-sm-6">
                                <input type="input" class="form-control" name="jdl_judul" id="jdl_judul" placeholder="Judul Skripsi">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jdl_deskripsi" class="col-sm-2 control-label">Deskripsi Judul</label>
                            <div class="col-sm-6">
                                <textarea type="input" rows="5" class="form-control"  name="jdl_deskripsi" id="jdl_deskripsi" placeholder="Deskripsi Judul"></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pembimbing1" class="col-sm-2 control-label">Pembimbing 1</label>
                            <div class="col-sm-6">
                            <select name="pembimbing1" id="pembimbing1" class="form-control">
                                <option value=''>Please Select</option>
                                <?php foreach($bagidosen1->result() as $row):?>
                                    <option value="<?php echo $row->bagi_id;?>"><?php echo $row->dsn_nama;?></option>
                                    <?php echo $row->bagi_id;?>
                                <?php endforeach;?>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pembimbing2" class="col-sm-2 control-label">Pembimbing 2 </label>
                            <div class="col-sm-6">
                                <select name="pembimbing2" id="pembimbing2" class="form-control">
                                    <option value=''>Please Select</option>
                                    <?php foreach($bagidosen2->result() as $row):?>
                                        <option value="<?php echo $row->bagi_id;?>"><?php echo $row->dsn_nama;?></option>
                                        <?php echo $row->bagi_id;?>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jdl_enjudul" class="col-sm-2 control-label">Judul (English)</label>
                            <div class="col-sm-6">
                                <input type="input" class="form-control" name="jdl_enjudul" id="jdl_enjudul" placeholder="Judul (English)">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jdl_status" class="col-sm-2 control-label">Status Judul</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="jdl_status" id="jdl_status" placeholder="Status Judul">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jdl_tanggal" class="col-sm-2 control-label">Mulai Skripsi</label>
                            <div class="col-sm-6">
                                <input type="date" class="form-control" name="jdl_tanggal" id="jdl_tanggal" placeholder="Tanggal Mulai">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Content -->
                <div class="box box-footer">
                    <button class="btn btn-primary" type="submit" name="submit" value="Add User" id="submit" data-stype='stay'>
                        <i class="fa fa-save" ></i> Save
                    </button>
                    <a class="btn btn-primary" href="<?= base_url('admin/skripsi/list_skripsi'); ?>"><i class="fa fa-undo" data-stype='back'></i> Back to List</a>


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
