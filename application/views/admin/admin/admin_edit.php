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
       Admin Dashboard      <small>Edit Admin</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="">Admin</a></li>
      <li class="active">Edit Admin</li>
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
        <h3 class="widget-user-username">Admin</h3>
        <h5 class="widget-user-desc">Edit Admin</h5>
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

    <?php echo form_open_multipart(base_url('admin/admin/edit_admin/'.$user['nip']),  'class="form-horizontal"');  ?>
    <div class="box-body">
        <div class="form-group">
            <label for="nip" class="col-sm-2 control-label">NIP</label>
            <div class="col-sm-6">
                <input type="input" class="form-control" name="nip" id="nip" placeholder="NIP" value="<?= $user['nip']; ?>" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="nama" class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-6">
                <input type="input" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?= $user['nama']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-6">
                <input type="input" class="form-control" name="password" id="password" placeholder="Password" value="<?= $user['password']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="no_hp" class="col-sm-2 control-label">Nomor Hp</label>
            <div class="col-sm-6">
                <input type="number" class="form-control" name="no_hp" id="no_hp" placeholder="Nomor HP" value="<?= $user['no_hp']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="alamat" class="col-sm-2 control-label">Alamat</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?= $user['alamat']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-6">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= $user['email']; ?>">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="level" class="col-sm-2 control-label">Level Admin</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" name="level" id="level" placeholder="Level Admin" value="<?= $user['level']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="foto" class="col-sm-2 control-label">Avatar</label>
        <div class="col-sm-6">
            <input name="avatar" id="avatar" type="file" class="form-control" />
        </div>
    </div>

</div>

          <!-- Footer Content -->
          <div class="box box-footer">
              <button class="btn btn-primary" type="submit" name="submit" value="Add User" id="submit" data-stype='stay'>
                  <i class="fa fa-save" ></i> Save
              </button>
              <a class="btn btn-primary" href="<?= base_url('admin/admin/list_admin'); ?>"><i class="fa fa-undo"" data-stype='back'></i> Back to List</a>
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
