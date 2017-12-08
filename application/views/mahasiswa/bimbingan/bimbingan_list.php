<?php
$this->load->view('template/head');
?>

<?php
$this->load->view('mahasiswa/template/topbar');
$this->load->view('mahasiswa/template/sidebar');
?>

<?php
    $no = $this->uri->segment(3);
    if ($no != 4 && $no != 5 && $no != 6 && $no != 7 && $no != 8 && $no != 9 ){
    redirect('mahasiswa');
}
foreach($bab->result() as $row){}
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Mahasiswa Dashboard        <small>List Bimbingan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="">Bimbingan</a></li>
        <li class="active">List Bimbingan</li>
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
                                <?php if($cek->num_rows() <> 0){
                                    foreach($cek->result() as $row){ $status = $row->bimb_status; }
                                    if($status == 'Menunggu Diperiksa' || $status == 'Menunggu Diperiksa Dosen P1' || $status == 'Diajukan Untuk Diperiksa Dosen P1' || $status== 'ACC'){
                                        echo"<button class='btn btn-flat'><i class='fa fa-plus-square-o'></i> Add Bimbingan</button>";
                                    }else{
                                        echo"<a href='".site_url('bimbingan/add_bimbingan/'.$no)."'>
												<button class='btn btn-primary btn-square'>Add Bimbingan</button>
											     </a>
											    ";
                                    }
                                }else{
                                    echo"<a href='".site_url('bimbingan/add_bimbingan/'.$no)."'>
                                             <button class='btn btn-primary btn-square'>Add Bimbingan</button>
											 </a>
											";
                                } ?>
                            </div>
                            <div class="col-sm-1">
                                <img class="img-circle" src="<?php echo base_url('/assets/img/list.png') ?>" alt="User Avatar">
                                <div class="col-sm-1">
                                </div>
                            </div>
                            <?php foreach($bab->result() as $row): ?>
                            <h3 class="widget-user-username">BIMBINGAN - <b><?php echo $row->katlap_kategori;?></b></h3>
                            <?php endforeach; ?>
                            <h5 class="widget-user-desc">Riwayat Bimbingan</h5>
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
                            <th>NO</th>
                            <th>TOPIK BIMBINGAN</th>
                            <th>JENIS BIMBINGAN</th>
                            <th>TANGGAL BIMBINGAN</th>
                            <th>WAKTU BIMBINGAN</th>
                            <th>DETAIL</th>
                            </tr>
                            </thead>
                            <tbody id="tbody_dosen">
                            <?php $number=1; foreach($laporan->result() as $key){
                                $tahun_lap = substr($key->lap_tanggal,0,4);
                                $bulan_lap = substr($key->lap_tanggal,5,2);
                                $tanggal_lap = substr($key->lap_tanggal,8,2); ?>

                                <td><?php echo $number++;?></td>
                                <td><?= $key->lap_topik; ?></td>
                                <td><?= $key->lap_jenis; ?></td>
                                <td><?= $tanggal_lap.'-'.$bulan_lap.'-'.$tahun_lap;?></td>
                                <td><?= $key->lap_waktu; ?></td>
                                <td><a href="<?php echo site_url('bimbingan/detail_bimbingan/'.$key->lap_id);?>" />
                                    <button class="btn btn-xs btn-flat btn-info btnbrg-edit" type="submit" name="detail" value="Detail">
                                        Detail
                                    </button>
                                    </a>
                                </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

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
