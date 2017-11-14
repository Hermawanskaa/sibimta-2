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
      User
      <small>Profile User</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="">User</a></li>
      <li class="active">Profile</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row" >
     
      <div class="col-md-12">
         <div class="box box-info box-header with-border">
            <div class="box-body ">
                   <!-- /.col -->
                  <div class="col-md-12">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user" >
                      <!-- Add the bg color to the header using any of the bg-* classes -->
                      <div class="widget-user-header " style="background: url('assets/AdminLTE-2.0.5/dist/img/photo1.png') center center;">
                        <h3 class="widget-user-username text-white"></h3>
                        <h5 class="widget-user-desc text-white"></h5>
                      </div>
                      <div class="widget-user-image">
                        <img class="img-circle" src="assets/AdminLTE-2.0.5/dist/img/avatar.png" alt="User Avatar" style="height: 80px; width: 80px" >
                      </div>
                      <div class="box-footer">
                       
                        <!-- /.row -->
                      </div>
                    </div>     
                    </div>
                    <div class="col-md-6">
                      <!-- Widget: user widget style 1 -->
                      <div class="box box-info box-header with-border">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="">
                          <h3 class="">Group User</h3>
                        </div>
                        <div class="box-footer no-padding">
                          <ul class="nav nav-stacked">
                            <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                          </ul>
                        </div>
                      </div>
                      <!-- /.widget-user -->
                    </div>

                     <div class="col-md-6">
                      <!-- Widget: user widget style 1 -->
                      <div class="box box-info box-header with-border">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="">
                          <h3 class="">Detail User</h3>
                        </div>
                        <div class="box-footer no-padding">
                          <ul class="nav nav-stacked">
                            <li><a href="#"><i class='fa fa-shield color-orange'></i> Status 
                                <span class="pull-right badge bg-red">Banned</span></a>
                                <span class="pull-right badge bg-blue">Active</span></a>
                            </li>
                            <li><a href="#"><i class='fa  fa-safari  color-orange'></i> Last Login <span class="pull-right "></span></a></li>
                            <li><a href="#"><i class='fa fa-history color-orange'></i> Last Activity <span class="pull-right "></a></li>
                            <li><a href="#"><i class='fa fa-calendar-check-o  color-orange'></i> Date Created <span class="pull-right "></span></a></li>
                            <li><a href="#"><i class='fa fa-chrome color-orange'></i> IP Address <span class="pull-right "></span></a></li>
                          </ul>
                        </div>
                      </div>
                      <!-- /.widget-user -->
                    </div>
                    <hr>
                   <div class="row-fluid col-md-12" >
                        <a class="btn btn-primary" id="btn_edit" data-stype='back' title="edit profile (Ctrl+e)" href=""><i class="fa fa-edit" ></i> Edit Profile</a>
                  </div>

                 
            </div>
            <!--/box body -->
         </div>
         <!--/box -->

      </div>
   </div>
</section>
<!-- /.content -->


<?php 
$this->load->view('template/js');
?>
