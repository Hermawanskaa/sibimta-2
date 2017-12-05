<?php
$this->load->view('template/head');
?>

<?php
$this->load->view('dosen/template/topbar');
$this->load->view('dosen/template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dosen Dashboard        <small>Riwayat Bimbingan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="">BIMBINGAN</a></li>
        <li class="active">Riwayat Bimbingan</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info box-header with-border">
                <div class="box-body">
                    <div class="row">
                        <div class="widget-user-header">
                            <div class="row col-md-2 pull-right">
                            </div>
                            <div class="col-sm-1">
                                <img class="img-circle" src="<?php echo base_url('/assets/img/list.png') ?>" alt="User Avatar">
                                <div class="col-sm-1">
                                </div>
                            </div>
                            <h3 class="widget-user-username">BIMBINGAN</h3>
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

                        <?php foreach($result as $row): ?>
                            <div class="box">
                                <div class="box-header with-border">
                                    <h2 class="box-title">NIM : </h2>
                                    <strong><?php echo strtoupper($row['mhs_nim']);?></strong>
                                </div>
                                <div class="box-header with-border">
                                    <h2 class="box-title">Nama : </h2>
                                    <strong><?php echo strtoupper($row['mhs_nama']);?></strong>
                                </div>
                                <div class="box-header with-border">
                                    <h2 class="box-title">Judul : </h2>
                                    <strong><?php echo strtoupper($row['jdl_judul']);?></strong>
                                </div>

                                <div class="box-header with-border">
                                    <h3 class="box-title">Dosen Pembimbing  : </h3>
                                    <strong><?php foreach($dosen[$row['dsn_id']] as $dos) { echo"&nbsp;$dos,"; } ?></strong>
                                </div>
                            </div>
                        <?php endforeach; ?>

                            <div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
                                <div class='inline-popups' style='float:right;'>
                                    <div id="text-popup-html" class="white-popup mfp-with-anim mfp-hide">
                                        <form role='form' action='' method="POST" >
                                            <input type='hidden' name='mhsid' id='mhsid' value='<?php echo $_res['mhs_id']; ?>' />
                                            <input type='hidden' name='jdl_id' id='jdl_id' value='<?php echo $_res['jdl_id']; ?>' />
                                        </form>
                                    </div>
                                </div>
                                <table id="tbl-personal" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th rowspan=2>NO</th>
                                        <th rowspan=2>KATEGORI LAPORAN</th>
                                        <th rowspan=2>FILE</th>
                                        <th colspan=2>PENGAJUAN</th>
                                        <th rowspan=2>STATUS</th>
                                        <th rowspan=2>REVISI</th>
                                        <th rowspan=2>BIMBINGAN</th>
                                        <th colspan=2>BIMBINGAN</th>
                                        <th rowspan=2>AKSI</th>
                                    </tr>
                                    <tr>
                                        <th>TANGGAL</th>
                                        <th>WAKTU</th>
                                        <th>TANGGAL</th>
                                        <th>WAKTU</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no=1;
                                    $pengid = $this->uri->segment(5);
                                    foreach($laporan->result() as $key){
                                        $status = $key->bimb_status;
                                        $mhsid = $key->mhs_id;
                                        $dos_id = $key->pemb_id;

                                        $tahun_jdl = substr($key->lap_tanggal,0,4);
                                        $bulan_jdl = substr($key->lap_tanggal,5,2);
                                        $tanggal_jdl = substr($key->lap_tanggal,8,2);
                                        $tahun_bim = substr($key->bimb_tgl,0,4);
                                        $bulan_bim = substr($key->bimb_tgl,5,2);
                                        $tanggal_bim = substr($key->bimb_tgl,8,2);
                                        ?>
                                        <tr>
                                            <td><?php echo $no++;?></td>
                                            <td><?php echo $key->katlap_kategori; ?></td>
                                            <td>
                                                <a href="<?php echo site_url('bimbingan/get_file_laporan/'.$key->katlap_id.'/'.$key->lap_file); ?>"><?= substr($key->lap_file,14,5); ?></a>
                                            </td>
                                            <td><?php echo $tanggal_jdl.'-'.$bulan_jdl.'-'.$tahun_jdl; ?></td>
                                            <td><?php echo $key->lap_waktu; ?></td>
                                            <td><?php echo $status; ?></td>
                                            <td>
                                                <?php if($key->bimb_file=="Tak ada File Revisi"){
                                                    echo $key->bimb_file;
                                                } else { echo "
															<a href='".site_url('bimbingan/get_file_revisi/'.$key->katlap_id.'/'.$key->bimb_file)."'>
															".substr($key->bimb_file,14,5)."
															</a>
															"; } ?>
                                            </td>
                                            <td><?php echo $key->bimb_catatan; ?></td>
                                            <td><?php echo $tanggal_bim.'-'.$bulan_bim.'-'.$tahun_bim; ?></td>
                                            <td><?php echo $key->bimb_wkt; ?></td>
                                            <td>
                                                <?php foreach($terakhir->result() as $s){ $lapid  = $s->lap_id; }
                                                if ($key->lap_id == $lapid){
                                                    if($dos_id % 2 == 0){
                                                        if($status=='Menunggu Diperiksa' or $status=='REVISI - P2'){
                                                            echo"
																<a href='".site_url('admin/bimbingan/edit_bimbingan/'.$key->lap_id.'/'.$pengid)."'>
																	<button class='btn btn-xs btn-flat btn-success'>
																		<i class='fa fa-edit'></i>
																	</button>
																</a>
																";
                                                        }else{ echo"
																<button class='btn btn-xs btn-flat btn-default'>
																	<i class='fa fa-edit'></i>
																</button>
																	";
                                                        }
                                                    }
                                                    if($dos_id % 2 == 1){
                                                        if($status != 'ACC'){ echo"
																<a href='".site_url('admin/bimbingan/edit_bimbingan/'.$key->lap_id.'/'.$pengid)."'>
																	<button class='btn btn-xs btn-flat btn-success'>
																		<i class='fa fa-edit'></i>
																	</button>
																</a>
																	";
                                                        }else{ echo"
																<button class='btn btn-xs btn-flat btn-default'>
																	<i class='fa fa-edit'></i>
																</button>
																	";
                                                        }
                                                    }
                                                }else { echo"
														<button class='btn btn-xs btn-flat btn-default'>
															<i class='fa fa-edit'></i>
														</button>
															"; } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
                    <hr>
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
