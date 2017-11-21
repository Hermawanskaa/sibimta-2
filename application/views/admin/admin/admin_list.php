<?php 
$this->load->view('template/head');
?>

<?php
$this->load->view('admin/template/topbar');
$this->load->view('admin/template/sidebar');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Admin        <small>List All Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="">Admin</a></li>
        <li class="active">List All Admin</li>
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
                                <a class="btn btn-primary" id="btn_add_new" href="<?= base_url('admin/admin/add_admin'); ?>"><i class="fa fa-plus-square-o" ></i> Add Dosen</a>
                                <a class="btn btn-primary" href=""><i class="fa fa-file-excel-o" ></i> Export XLS</a>
                                <a class="btn btn-primary" href=""><i class="fa fa-file-pdf-o" ></i> Export PDF</a>
                            </div>
                            <div class="col-sm-1">
                                <img class="img-circle" src="<?php echo base_url('/assets/img/list.png') ?>" alt="User Avatar">
                                <div class="col-sm-1">
                                </div>
                            </div>
                            <h3 class="widget-user-username">Dosen</h3>
                            <h5 class="widget-user-desc">List All Dosen <i href="" class="label bg-yellow"><?php echo $total_rows ?> items</i></h5>
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
                        <?php if ($this->session->flashdata('msg')) { ?>
                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-warning"></i> Peringatan!</h4>
                                <?php echo $this->session->flashdata('msg');?>
                            </div>
                        <?php }?>

                        <form name="form_dosen" id="form_dosen" action="">
                            <div class="table-responsive">
                                <table id="list_dosen" class="table table-bordered table-striped dataTable">
                                    <thead>
                                        <th>No</th>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>No HP</th>
                                        <th>Alamat</th>
                                        <th>Email</th>
                                        <th>level</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody_dosen">

                                    <?php
                                    foreach($admin_data as $row): ?>
                                        <tr>
                                            <td width="80px"><?php echo $row->id; ?></td>
                                            <td><?php echo $row->nip; ?></td>
                                            <td><?php echo $row->nama; ?></td>
                                            <td><?php echo $row->no_hp; ?></td>
                                            <td><?php echo $row->alamat; ?></td>
                                            <td><?php echo $row->email; ?></td>
                                            <td><?php echo $row->level; ?></td>
                                            <td width="200">
                                                <a href="<?= base_url('admin/admin/view_admin/'.$row->nip); ?>" class="label-default"><i class="fa fa-newspaper-o"></i> View</a>
                                                <a href="<?= base_url('admin/admin/edit_admin/'.$row->nip); ?>" class="label-default"><i class="fa fa-edit "></i> Update</a>
                                                <a href="<?= base_url('admin/admin/delete_admin/'.$row->nip); ?>" class="label-default remove-data"><i class="fa fa-close"></i> Remove</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php if ($total_rows == 0) :?>
                                        <tr>
                                            <td colspan="100">
                                                data is not available
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                    <hr>
                    <!-- /.widget-user -->
                    <div class="row">
                        <div class="col-md-8">
                            <div class="col-sm-3 padd-left-0">
                                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>" placeholder="Filter">
                            </div>
                            <div class="col-sm-1 padd-left-0 ">
                                <?php
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin/admin/list_admin'); ?>" class="btn btn-primary">Reset</a>
                                    <?php
                                }
                                ?>
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>

                        </div>
                        </form>
                        <div class="col-md-4">
                            <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate" >
                                <?= $pagination; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</section>

<?php 
$this->load->view('template/js');
?>
