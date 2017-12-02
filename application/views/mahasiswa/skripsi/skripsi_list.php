<?php
$this->load->view('template/head');
?>

<?php
$this->load->view('mahasiswa/template/topbar');
$this->load->view('mahasiswa/template/sidebar');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Mahasiswa Dashboard        <small>Status Skripsi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="">Mahasiswa</a></li>
        <li class="active">Status Skripsi</li>
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
                                <a class="btn btn-primary" id="btn_add_new" href="<?= base_url('admin/skripsi/add_skripsi'); ?>"><i class="fa fa-plus-square-o" ></i> Add Data</a>
                                <a class="btn btn-primary" href=""><i class="fa fa-file-excel-o" ></i> Export XLS</a>
                                <a class="btn btn-primary" href=""><i class="fa fa-file-pdf-o" ></i> Export PDF</a>
                            </div>
                            <div class="col-sm-1">
                                <img class="img-circle" src="<?php echo base_url('/assets/img/list.png') ?>" alt="User Avatar">
                                <div class="col-sm-1">
                                </div>
                            </div>
                            <h3 class="widget-user-username">Skripsi</h3>
                            <h5 class="widget-user-desc">Status Skripsi <i href="" class="label bg-yellow">items</i></h5>
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
                                    <a href="<?php echo site_url('admin/skripsi/list_skripsi'); ?>" id="import" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-import"></i> Syncron</a>

                                    <?php echo anchor('admin/skripsi/list_skripsi', '<i class="glyphicon glyphicon-refresh"></i> Refresh', array('class' => 'btn btn-info btn-sm')); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <form action="<?php echo site_url('admin/skripsi/list_skripsi'); ?>" method="get">
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
                            <table id="list_skripsi" class="table table-bordered table-striped dataTable">
                                <thead>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Detail</th>
                                <th>ACTION</th>
                                </tr>
                                </thead>
                                <tbody id="tbody_skripsi">
                                <?php $no=1; foreach($skripsi->result() as $row){
                                $tahun_jdl = substr($row->jdl_tanggal,0,4);
                                $bulan_jdl = substr($row->jdl_tanggal,5,2);
                                $tanggal_jdl = substr($row->jdl_tanggal,8,2);
                                ?>
                                <td><?php echo $no++;?> </td>
                                <td><?php echo $row->jdl_judul; ?></td>
                                <td><?= $tanggal_jdl.'-'.$bulan_jdl.'-'.$tahun_jdl;?></td>
                                <td><?php echo $row->jdl_status; ?></td>
                                <td><a href="<?php echo site_url('skripsi/detail_skripsi/'.$row->jdl_id);?>" />
                                    <button class="btn btn-xs btn-flat btn-info btnbrg-edit" type="submit" name="detail" value="Detail">
                                        Detail
                                    </button>
                                    </a>
                                </td>
                                <?php } ?>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <!-- /.widget-user -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-right" >
                            </div>
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
