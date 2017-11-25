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
        Admin Dashboard    <small>Edit Pembimbing</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="">Admin</a></li>
        <li class="active">Edit Pembimbing</li>
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
                            <h3 class="widget-user-username">Pembimbing</h3>
                            <h5 class="widget-user-desc">Edit Pembimbing</h5>
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

                    <?php echo form_open_multipart(base_url('admin/pembimbing/edit_pembimbing/'.$user['bagi_id']),  'class="form-horizontal"');  ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="dsn_id" class="col-sm-2 control-label">Dosen</label>
                            <div class="col-sm-6">
                                <select name="dsn_id" id="dsn_id" class="form-control">
                                    <option value=''>Please Select</option>
                                    <?php foreach($dosen->result() as $row):?>
                                        <option value="<?php echo $row->dsn_id;?>"><?php echo $row->dsn_nama;?></option>
                                        <?php echo $row->dsn_id;?>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pembimbing1" class="col-sm-2 control-label">Pembimbing satu</label>
                            <div class="col-sm-6">
                                <label><input name="pembimbing1" type="radio" id="pembimbing1" value="Y"> YA</label>
                                <label><input name="pembimbing1" type="radio" id="pembimbing1" value="T"> TIDAK</label>
                                </small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pembimbing2" class="col-sm-2 control-label">Pembimbing dua</label>
                            <div class="col-sm-6">
                                <label><input name="pembimbing2" type="radio" id="pembimbing2" value="Y"> YA</label>
                                <label><input name="pembimbing2" type="radio" id="pembimbing2" value="T"> TIDAK</label>
                                </small>
                            </div>
                        </div>
                    </div>

                <!-- Footer Content -->
                <div class="box box-footer">
                    <button class="btn btn-primary" type="submit" name="submit" value="Add User" id="submit" data-stype='stay'>
                        <i class="fa fa-save" ></i> Save
                    </button>
                    <a class="btn btn-primary" href="<?= base_url('admin/pembimbing/list_pembimbing'); ?>"><i class="fa fa-undo"" data-stype='back'></i> Back to List</a>
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
