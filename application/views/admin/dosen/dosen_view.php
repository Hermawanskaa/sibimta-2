<?php 
$this->load->view('template/head');
?>

<?php
$this->load->view('template/topbar');
$this->load->view('admin/template/sidebar');
?>

<!-- Page Header -->
<section class="content-header">
   <h1>
      Dosen      <small>Detail Dosen</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="">Dosen</a></li>
      <li class="active">Detail Dosen</li>
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
            <img class="img-circle" src="assets/img/view.png" alt="User Avatar">
            <div class="col-sm-1">
        </div>
        </div>
        <h3 class="widget-user-username">Dosen</h3>
        <h5 class="widget-user-desc">Detail Dosen</h5>
        <hr>
  </div>
</div>
</div>

 <!-- Main Content -->              
        <?php echo form_open(base_url('admin/view_dosen'.$user['id_member']), 'class="form-horizontal"' )?>
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label" name="id_member" id="id_member">NIP</label>
                        <div class="col-sm-8"><?= $user['id_member']; ?>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label" name="nama" id="nama">Nama</label>
                        <div class="col-sm-8">
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label" name="alamat" id="alamat">Alamat</label>
                        <div class="col-sm-8"><?= $user['alamat']; ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label" name="no_hp" id="no_hp">No Hp</label>
                        <div class="col-sm-8"><?= $user['no_hp']; ?>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label" name="email" id="email">Email</label>
                        <div class="col-sm-8"><?= $user['email']; ?>
                        </div>
                    </div>
                    <br>
                    <br>

<!-- Footer Content -->
    <div class="box box-footer">
                            <button class="btn btn-primary" id="view" type="submit" name="submit" value="Update User" data-stype='stay'>
                            <i class="fa fa-save" ></i> Update and Go to The List
                            </button>
                            <button class="btn btn-default col" id="btn_cancel">
                            <i class="fa fa-undo"></i> Cancel
                            </button> 
                        </div>
            <?php echo form_close( ); ?>
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
