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
        Mahasiswa Dashboard        <small>List All Pesan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="">Pesan</a></li>
        <li class="active">List All Pesan</li>
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
                                <a class="btn btn-primary" id="btn_add_new" href="<?= base_url('mahasiswa/pesan/add_pesan'); ?>"><i class="fa fa-plus-square-o" ></i> Add Pesan</a>
                            </div>
                            <div class="col-sm-1">
                                <img class="img-circle" src="<?php echo base_url('/assets/img/list.png') ?>" alt="User Avatar">
                                <div class="col-sm-1">
                                </div>
                            </div>
                            <h3 class="widget-user-username">Pesan</h3>
                            <h5 class="widget-user-desc">List All Pesan <i href="" class="label bg-yellow">items</i></h5>
                            <hr>
                        </div>
                    </div>
                    <div class="boxbox-widget widget-user-2">
                        <?php if(isset($msg) || validation_errors() !== ''): ?>
                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                                <?= validation_errors();?>
                                <?= isset($msg)? $msg: ''; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('msg')): ?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-warning"></i> Peringatan!</h4>
                                <?php echo $this->session->flashdata('msg');?>
                            </div>
                        <?php endif; ?>
                        <br>
                        <div class="table-responsive">
                            <table id="list_dosen" class="table table-bordered table-striped dataTable">
                                <thead>
                                <th>No</th>
                                <th>Pesan</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Detail</th>
                                <th>Status</th>
                                <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="tbody_pesan">
                                <?php foreach($pesan as $row): ?>
                                    <td><?php echo $row->pesdos_id?></td>
                                    <td><?php echo "<b>".$row->dsn_nama."</b>"; ?>&nbsp; Menjawab Pesan <?php echo "<b>".$row->katlap_kategori."</b> Anda"; ?></td>
                                    <td><?php echo $row->pesdos_tanggal;?></td>
                                    <td><?php echo $row->pesdos_waktu;?></td>
                                    <td>
                                        <a href="<?php echo base_url('mahasiswa/detail_pesan/'.$row->katlap_id.'/'.$row->pesdos_id);?>" />
                                           <button class="btn btn-xs btn-primary btn-info" type="submit" name="detail" value="Detail">Detail</button>
                                        </a>
                                    </td>
                                    <td width="50px">
                                        <?php if($row->pesdos_status == 0){ ?>
                                            <a href='<?php echo base_url('mahasiswa/open/'.$row->pesdos_id); ?>' onClick="return confirm('Tandai Pesan Sudah Terbaca?')" >
                                            <img src="<?php echo base_url();?>assets/img/mail_close.png" width="50%"></a>
                                        <?php }else { ?>
                                            <img src="<?php echo base_url();?>assets/img/mail_open.png" width="50%">
                                        <?php } ?>
                                    </td>
                                    <td width="100px">
                                        <a href="<?= base_url('mahasiswa/delete_pesan/'.$row->pesdos_id); ?>" class="label-default remove-data" onClick="return confirm('Apa anda yakin akan menghapus pesan?')">
                                            <i class="fa fa-close"></i> Remove</a>
                                    </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-right" >
                                <?/*= $pagination; */?>
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
