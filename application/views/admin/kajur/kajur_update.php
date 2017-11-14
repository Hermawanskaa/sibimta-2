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
      Kajur      <small>Edit Kajur</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="">Kajur</a></li>
      <li class="active">Edit Kajur</li>
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
        <h3 class="widget-user-username">Kajur</h3>
        <h5 class="widget-user-desc">Edit Kajur</h5>
        <hr>
  </div>
</div>
</div>

 <!-- Main Content --> 
<div class="boxbox-widget widget-user-2">
                                   
                    <form class="form-horizontal">
    <div class="box-body">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">NIP</label>
        <div class="col-sm-6">
          <input type="input" class="form-control" id="id_member" placeholder="Id Member">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-6">
          <input type="password" class="form-control" id="password" placeholder="password">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
        <div class="col-sm-6">
          <input type="input" class="form-control" id="nama" placeholder="nama">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>
        <div class="col-sm-6">
          <input type="alamat" class="form-control" id="alamat" placeholder="Alamat">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">No Hp</label>
        <div class="col-sm-6">
          <input type="no Hp" class="form-control" id="no_hp" placeholder="Nomor Hp">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-6">
          <input type="email" class="form-control" id="email" placeholder="Email">
        </div>
      </div>
    </div>

<!-- Footer Content -->
    <div class="box box-footer">
                            <button class="btn btn-primary" id="btn_save" data-stype='stay'>
                            <i class="fa fa-save" ></i> Save
                            </button>
                            <button class="btn btn-primary" id="btn_save" data-stype='back'>
                            <i class="ion ion-ios-list-outline" ></i> Save and Go to The List
                            </button>
                            <button class="btn btn-default col" id="btn_cancel">
                            <i class="fa fa-undo"></i> Cancel
                            </button> 
                        </div>
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
