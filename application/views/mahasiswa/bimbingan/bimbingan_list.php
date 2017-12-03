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
        Admin Dashboard        <small>List BIMBINGAN</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="">BIMBINGAN</a></li>
        <li class="active">LIST BIMBINGAN</li>
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
                                            echo"<button class='btn btn-flat'><i class='fa fa-plus-square-o'></i> Add Data</button>";
                                        }else{
                                            echo"<a href='".site_url('bimbingan/add_bimbingan/'.$no)."'>
												<button class='btn btn-primary btn-square'>Add Data</button>
											     </a>
											    ";
                                        }
                                    }else{
                                        echo"<a href='".site_url('bimbingan/add_bimbingan/'.$no)."'>
                                             <button class='btn btn-primary btn-square'>Add Data</button>
											 </a>
											";
                                    } ?>
                            </div>
                            <div class="col-sm-1">
                                <img class="img-circle" src="<?php echo base_url('/assets/img/list.png') ?>" alt="User Avatar">
                                <div class="col-sm-1">
                                </div>
                            </div>
                            <h3 class="widget-user-username">BIMBINGAN</h3>
                            <h5 class="widget-user-desc">LIST BIMBINGAN</h5>
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
                                <th>LAPORAN</th>
                                <th>TANGGAL PENGAJUAN</th>
                                <th>WAKTU PENGAJUAN</th>
                                <th>AKSI</th>
                                <th>STATUS</th>
                                <th>REVISI</th>
                                <th>BIMBINGAN</th>
                                <th>TANGGAL BIMBINGAN</th>
                                <th>WAKTU BIMBINGAN</th>

                                </tr>
                                </thead>
                                <tbody id="tbody_dosen">
                                <?php
                                $number=1;
                                foreach($bimbingan->result() as $key){
                                $tahun_jdl = substr($key->lap_tanggal,0,4);
                                $bulan_jdl = substr($key->lap_tanggal,5,2);
                                $tanggal_jdl = substr($key->lap_tanggal,8,2);

                                $tahun_bim = substr($key->bimb_tgl,0,4);
                                $bulan_bim = substr($key->bimb_tgl,5,2);
                                $tanggal_bim = substr($key->bimb_tgl,8,2);
                                ?>

                                <td><?php echo $number++;?></td>
                                <td><a href="<?php echo site_url('bimbingan/get_file_laporan/'.$no.'/'.$key->lap_file); ?>"><?= substr($key->lap_file,14,5); ?>...</a></td>
                                <td><?= $tanggal_jdl.'-'.$bulan_jdl.'-'.$tahun_jdl;?></td>
                                <td><?= $key->lap_waktu; ?></td>
                                    <?php if($key->bimb_status =="Menunggu Diperiksa Dosen P1"){ ?>
                                        <td>
                                            <a href='<?php echo site_url('bimbingan/edit_bimbingan/'.$no.'/'.$key->lap_id); ?>'>
                                                <button class="btn btn-xs btn-flat btn-success btnbrg-edit">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </a>
                                        </td>
                                    <?php }else{ echo "
															<td>
																<button class='btn btn-xs btn-flat btn-default'>
																	<i class='fa fa-edit'></i>
																</button>
															</td>"
                                    ;} ?>
                                    <td><?= $key->bimb_status; ?></td>
                                    <?php if($key->bimb_file == "Tak ada File Revisi"){ ?>
                                    <td><?= $key->bimb_file; ?></td>
                                    <?php } else { ?>
                                    <td><a href="<?php echo site_url('laporan/get_file_revisi/'.$no.'/'.$key->bimb_file); ?>"><?= substr($key->bimb_file,6,5); ?>...</a></td>
                                    <?php } ?>
                                    <td><?= $key->bimb_catatan; ?></td>
                                    <td><?= $bulan_bim.'-'.$bulan_bim.'-'.$tahun_bim; ?></td>
                                    <td><?= $key->bimb_wkt; ?></td>
                                    </tr>
                                    <?php
                                    }?>
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
