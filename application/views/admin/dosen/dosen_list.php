<?php 
$this->load->view('template/head');
?>

<?php
$this->load->view('template/topbar');
$this->load->view('admin/template/sidebar');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dosen        <small>List All Dosen</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="">Dosen</a></li>
        <li class="active">List All Dosen</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info box-header with-border">
                <div class="box-body">
                   <div class="row">
         <div class="widget-user-header">
            <div class="row col-md-4 pull-right">
                        <a class="btn btn-primary" id="btn_add_new" href="<?= base_url('admin/add_dosen'); ?>"><i class="fa fa-plus-square-o" ></i> Add Dosen</a>
                        <a class="btn btn-primary" href=""><i class="fa fa-file-excel-o" ></i> Export XLS</a>
                        <a class="btn btn-primary" href=""><i class="fa fa-file-pdf-o" ></i> Export PDF</a>
                     </div>
        <div class="col-sm-1">
            <img class="img-circle" src="assets/img/list.png" alt="User Avatar">
            <div class="col-sm-1">
        </div>
        </div>
        <h3 class="widget-user-username">Dosen</h3>
        <h5 class="widget-user-desc">List All Dosen <i class="label bg-yellow">items</i></h5>
        <hr>
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

                  <form name="form_dosen" id="form_dosen" action="">
                  <div class="table-responsive"> 
                  <table class="table table-bordered table-striped dataTable">
                     <thead>
                        <tr class="">
                           <th>NIP</th>
                           <th>Pass</th>
                           <th>Nama</th>
                           <th>Alamat</th>
                           <th>No Hp</th>
                           <th>Email</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody_dosen">
                        <tr>
                          <?php foreach($all_users as $row): ?>
                           <td><?= $row['id_member']; ?></td> 
                           <td><?= $row['pass']; ?></td> 
                           <td><?= $row['nama']; ?></td> 
                           <td><?= $row['alamat']; ?></td> 
                           <td><?= $row['no_hp']; ?></td> 
                           <td><?= $row['email']; ?></td> 
                           <td width="200">
                              <a href="<?= base_url('admin/view_dosen/'.$row['id_member']); ?>" class="label-default"><i class="fa fa-newspaper-o"></i> View
                              
                              <a href="<?= base_url('admin/edit_dosen/'.$row['id_member']); ?>" class="label-default"><i class="fa fa-edit "></i> Update</a>
                              
                              <a href="<?= base_url('admin/delete_dosen/'.$row['id_member']); ?>" data-href="" class="label-default remove-data"><i class="fa fa-close"></i> Remove</a>
                           </td>
                        </tr>
                         <?php endforeach; ?>
                     </tbody>
                  </table>
                  </div>
               </div>
               <hr>
               <!-- /.widget-user -->
               <div class="row">
                  <div class="col-md-8">
                     <div class="col-sm-3 padd-left-0">
                        <input type="text" class="form-control" name="q" id="filter" placeholder="Filter" value="">
                     </div>
                     <div class="col-sm-3 padd-left-0 ">
                        <select type="text" class="form-control chosen chosen-select" name="f" id="field" >
                           <option value="">All</option>
                           <option value="id_member">Id Member</option>
                           <option value="pass">Pass</option>
                           <option value="nama">Nama</option>
                           <option value="alamat">Alamat</option>
                           <option value="no_hp">No Hp</option>
                           <option value="email">Email</option>
                          </select>
                     </div>


<!-- Footer Content -->
                     <div class="col-sm-1 padd-left-0 ">
                        <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="filter search">
                        Filter
                        </button>
                     </div>
                  </div>
                  </form>                  
                  <div class="col-md-4">
                     <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate" >
                     </div>
                    </div>
                  </div>
                </div>
            </div>
         </div>
      </div>
</section>

<?php 
$this->load->view('template/js');
?>

<script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
