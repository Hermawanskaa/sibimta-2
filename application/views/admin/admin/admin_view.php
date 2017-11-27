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
      Admin Dashboard     <small>Detail Admin</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="">Admin</a></li>
      <li class="active">Detail Admin</li>
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
        <h3 class="widget-user-username">Admin</h3>
        <h5 class="widget-user-desc">Detail Admin</h5>
        <hr>
  </div>
</div>
</div>

 <!-- Main Content -->              
                  <div class="form-horizontal" name="form_Admin" id="form_Admin" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">NIP</label>
                        <div class="col-sm-8">
                            <?= $user['adm_nip']; ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-8">
                            <?= $user['adm_nama']; ?>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">No HP</label>
                        <div class="col-sm-8">
                            <?= $user['adm_nohp']; ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Alamat</label>
                        <div class="col-sm-8">
                           <?= $user['adm_alamat']; ?>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-8">
                            <?= $user['adm_email']; ?>
                        </div>
                    </div>
                      <div class="form-group ">
                          <label for="content" class="col-sm-2 control-label">Level</label>
                          <div class="col-sm-8">
                              <?= $user['adm_level']; ?>
                          </div>
                      </div>
                    <br>
                    <br>

<!-- Footer Content -->
                    <div class="box box-footer">
                        <a href="<?= base_url('admin/admin/edit_admin/'.$user['adm_nip']); ?>" class="btn btn-primary" ><i class="ion ion-ios-list-outline""></i> Update</a>
                        <a class="btn btn-primary" href="<?= base_url('admin/admin/list_admin'); ?>"><i class="fa fa-undo"" data-stype='back'></i> Back to List</a>
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
