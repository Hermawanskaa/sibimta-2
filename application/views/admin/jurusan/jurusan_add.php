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
      Jurusan      <small>Add Jurusan</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="">Jurusan</a></li>
      <li class="active">Add Jurusan</li>
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
        <h3 class="widget-user-username">Jurusan</h3>
        <h5 class="widget-user-desc">Add Jurusan</h5>
        <hr>
  </div>
</div>
</div>

 <!-- Main Content --> 
<div class="boxbox-widget widget-user-2">
                                   
                    <form class="form-horizontal">
    <div class="box-body">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">ID Jurusan</label>
        <div class="col-sm-6">
          <input type="input" class="form-control" id="id_jurusan" placeholder="ID Jurusan">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Nama</label>
        <div class="col-sm-6">
          <input type="input" class="form-control" id="password" placeholder="Nama Jurusan">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Kode</label>
        <div class="col-sm-6">
          <input type="input" class="form-control" id="kode" placeholder="Kode Jurusan">
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
