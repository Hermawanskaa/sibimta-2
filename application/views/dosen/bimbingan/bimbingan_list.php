<?php
$this->load->view('template/head');
?>

<?php
$this->load->view('dosen/template/topbar');
$this->load->view('dosen/template/sidebar');
?>

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

                        <div class="box box-info box-header with-border">
                            <?php foreach($result as $row): ?>
                                <h5><p><strong>NIM : </strong><?php echo strtoupper($row['mhs_nim']);?><br></p></h5><hr>
                                <h5><p><strong>Nama : </strong><?php echo strtoupper($row['mhs_nama']);?><br></p></h5><hr>
                                <h5><p><strong>Judul : </strong><?php echo strtoupper($row['jdl_judul']);?><br></p></h5><hr>
                                <h5><p><strong>Dosen Pembimbing : </strong><?php foreach($dosen[$row['dsn_id']] as $dos) { echo"&nbsp;$dos,"; } ?><br></p></h5>
                            <?php endforeach; ?>
                        </div>

                                <div class="table-responsive">
                                    <table id="list_dosen" class="table table-bordered table-striped dataTable">
                                        <div id="text-popup-html" class="white-popup mfp-with-anim mfp-hide">
                                            <form role='form' action='' method="POST" >
                                                <input type='hidden' name='mhsid' id='mhsid' value='<?php echo $_res['mhs_id']; ?>' />
                                                <input type='hidden' name='jdl_id' id='jdl_id' value='<?php echo $_res['jdl_id']; ?>' />
                                                <input type='hidden' name='lap_id' id='lap_id' value='<?php echo $_res['lap_id']; ?>' />
                                            </form>
                                        <thead>
                                        <th>NO</th>
                                        <th>KAT BAB</th>
                                        <th>TOPIK BIMBINGAN</th>
                                        <th>TANGGAL</th>
                                        <th>WAKTU</th>
                                        <th>DETAIL</th>
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
                                                <?php echo$key->lap_topik; ?></a>
                                            </td>
                                            <td><?php echo $tanggal_jdl.'-'.$bulan_jdl.'-'.$tahun_jdl; ?></td>
                                            <td><?php echo $key->lap_waktu; ?></td>
                                            <td><a href="<?php echo site_url('admin/bimbingan/open_bimbingan/'.$key->mhs_id.'/'.$key->lap_id);?>" />
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
