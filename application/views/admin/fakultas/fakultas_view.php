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
      Fakultas      <small>Detail Fakultas</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="">Fakultas</a></li>
      <li class="active">Detail Fakultas</li>
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
        <h3 class="widget-user-username">Fakultas</h3>
        <h5 class="widget-user-desc">Detail Fakultas</h5>
        <hr>
  </div>
</div>
</div>

 <!-- Main Content -->              
                  <div class="form-horizontal" name="form_Fakultas" id="form_Fakultas" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Id Member </label>
                        <div class="col-sm-8">
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Pass </label>
                        <div class="col-sm-8">
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Nama </label>
                        <div class="col-sm-8">
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Alamat </label>
                        <div class="col-sm-8">
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">No Hp </label>
                        <div class="col-sm-8">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Email </label>
                        <div class="col-sm-8">
                        </div>
                    </div>
                    <br>
                    <br>

<!-- Footer Content -->
                    <div class="box box-footer">
                            <button class="btn btn-primary" id="btn_save" data-stype='back'>
                            <i class="ion ion-ios-list-outline" ></i> Edit Fakultas
                            </button>
                            <button class="btn btn-default col" id="btn_cancel">
                            <i class="fa fa-undo"></i> Go Fakultas List
                            </button> 
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
