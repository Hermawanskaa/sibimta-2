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
        Admin Dashboard        <small>List All Dosen</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="">Admin</a></li>
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
                            <div class="row col-md-2 pull-right">
                                <a class="btn btn-primary" id="btn_add_new" href="<?= base_url('admin/dosen/add_dosen'); ?>"><i class="fa fa-plus-square-o" ></i> Add Dosen</a>
                            </div>
                            <div class="col-sm-1">
                                <img class="img-circle" src="<?php echo base_url('/assets/img/list.png') ?>" alt="User Avatar">
                                <div class="col-sm-1">
                                </div>
                            </div>
                            <h3 class="widget-user-username">Dosen</h3>
                            <h5 class="widget-user-desc">List All Dosen</h5>
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
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-warning"></i> Peringatan!</h4>
                                <?php echo $this->session->flashdata('msg');?>
                            </div>
                        <?php }?>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="btn-group small" role="group" aria-label="...">
                                    <a href="<?php echo site_url('admin/dosen/list_dosen'); ?>" id="import" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-import"></i> Syncron</a>

                                    <?php echo anchor('admin/dosen/list_dosen', '<i class="glyphicon glyphicon-refresh"></i> Refresh', array('class' => 'btn btn-info btn-sm')); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <form action="<?php echo site_url('admin/dosen/list_dosen'); ?>" method="get">
                                    <div class="input-group">
                                        <input type="text" class="form-control input-sm" name="keyword" value="<?php echo (!empty($_GET['keyword'])) ? $_GET['keyword'] : ''; ?>" placeholder="Search for...">
                                        <span class="input-group-btn">
                                        <button class="btn btn-primary btn-sm" type="submit" name="submit" value="cari">Go!</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br>

                        <div class="table-responsive">
                                <table id="list_dosen" class="table table-bordered table-striped dataTable">
                                    <thead>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>No HP</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody_dosen">
                                    <?php if (!empty($dosen_data)) : ?>
                                    <?php foreach($dosen_data as $row): ?>
                                        <td><?php echo $row->dsn_id; ?></td>
                                        <td><?php echo $row->dsn_nip; ?></td>
                                        <td><?php echo $row->dsn_nama; ?></td>
                                        <td><?php echo $row->dsn_nohp; ?></td>
                                        <td><?php echo $row->dsn_alamat; ?></td>
                                        <td><?php echo $row->dsn_email; ?></td>
                                        <td width="200">
                                            <a href="<?= base_url('admin/dosen/view_dosen/'.$row->dsn_nip); ?>" class="label-default bg">
                                                <i class="fa fa-newspaper-o"></i> View</a>
                                            <a href="<?= base_url('admin/dosen/edit_dosen/'.$row->dsn_nip); ?>" class="label-default">
                                                <i class="fa fa-edit "></i> Update</a>
                                            <a href="<?= base_url('admin/dosen/delete_dosen/'.$row->dsn_nip); ?>" class="label-default remove-data">
                                                <i class="fa fa-close"></i> Remove</a>
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
                        <div class="col-md-12">
                            <div class="text-right" >
                                <?= $pagination; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>



<?php
$this->load->view('template/js');
?>
