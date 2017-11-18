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
      Dosen      <small>Edit Dosen</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="">Admin</a></li>
      <li class="active">Edit Dosen</li>
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
            <img class="img-circle" src="assets/img/add2.png" alt="User Avatar">
            <div class="col-sm-1">
        </div>
        </div>
        <h3 class="widget-user-username">Dosen</h3>
        <h5 class="widget-user-desc">Edit Dosen</h5>
        <hr>
  </div>
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
           
    <?php echo form_open(base_url('admin/edit/'.$user['id']), 'class="form-horizontal"' )?> 
    <div class="box-body">
      <div class="form-group">
        <label for="id_member" class="col-sm-2 control-label">NIP</label>
        <div class="col-sm-6">
          <input type="input" class="form-control" id="id_member" value="<?= $user['id_member']; ?>">
        </div>
      </div>
      <div class="form-group">
        <label for="nama" class="col-sm-2 control-label">Nama</label>
        <div class="col-sm-6">
          <input type="input" class="form-control" id="nama" value="<?= $user['nama']; ?>">
        </div>
      </div>
      <div class="form-group">
        <label for="alamat" class="col-sm-2 control-label">Alamat</label>
        <div class="col-sm-6">
          <input type="alamat" class="form-control" id="alamat" value="<?= $user['alamat']; ?>">
        </div>
      </div>
      <div class="form-group">
        <label for="no_hp" class="col-sm-2 control-label">No Hp</label>
        <div class="col-sm-6">
          <input type="no Hp" class="form-control" id="no_hp" value="<?= $user['no_hp']; ?>">
        </div>
      </div>
      <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-6">
          <input type="email" class="form-control" id="email" value="<?= $user['email']; ?>">
        </div>
      </div>
    </div>

<!-- Footer Content -->
    <div class="box box-footer">
                            <button class="btn btn-primary" id="btn_save" data-stype='stay' type="submit" name="submit" value="Update User">
                            <i class="fa fa-save" ></i> Save Save and Go to The List
                            </button>
                            <button class="btn btn-default col" id="btn_cancel">
                            <i class="fa fa-undo"></i> Cancel
                            </button> 
                        </div>
    <?php echo form_close(); ?>
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
