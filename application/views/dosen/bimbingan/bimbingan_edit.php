<?php
$this->load->view('template/head');
?>

<?php
$this->load->view('dosen/template/topbar');
$this->load->view('dosen/template/sidebar');
?>

<section class="content-header">
    <h1>
        Dosen Dashboard     <small>Respon Bimbingan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="">Dosen</a></li>
        <li class="active">Respon Bimbingan</li>
    </ol>
</section>

<section class="content">
    <div class="row" >
        <div class="col-md-12">
            <div class="box box-info box-header with-border">
                <div class="box-body ">
                    <div class="row">
                        <div class="widget-user-header">
                            <div class="col-sm-1">
                                <img class="img-circle" src="<?php echo base_url('/assets/img/view.png') ?>" alt="User Avatar">
                                <div class="col-sm-1">
                                </div>
                            </div>
                            <h3 class="widget-user-username">Bimbingan</h3>
                            <h5 class="widget-user-desc">Respon Bimbingan</h5>
                            <hr>
                        </div>
                    </div>
                </div>

                <?php
                $pengid = $this->uri->segment(5);
                foreach($bimbingan->result() as $key){
                    $lapid 		= $key->lap_id;
                    $mhs		= $key->mhs_id;
                    $katlap 	= $key->katlap_id;
                    $bimid		= $key->bimb_id;
                    $koment 	= $key->bimb_catatan;
                    $stat 		= $key->bimb_status;
                } ?>

                <div class="the-box full">
                    <form role="form" class="form-horizontal" enctype="multipart/form-data" action="<?=site_url('admin/bimbingan/submit');?>" method="POST" >
                        <input type="hidden" id="pengid" name="pengid" value="<?php echo $pengid; ?>" />
                        <input type="hidden" id="bimid" name="bimid" value="<?php echo $bimid; ?>" />
                        <input type="hidden" id="lapid" name="lapid" value="<?php echo $lapid; ?>" />
                        <input type="hidden" id="katlap" name="katlap" value="<?php echo $katlap; ?>" />
                        <input type="hidden" id="mhs" name="mhs" value="<?php echo $mhs; ?>" />
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Bimbingan</label>
                            <div class="col-sm-8">
                                <textarea name="komentar" id="komentar" rows="7" class="form-control" <?php if($key->bimb_catatan=="Tak ada Komentar"){echo "placeholder='$key->bimb_catatan'";} ?>><?php if($key->bimb_catatan!="Tak ada Komentar"){echo $key->bimb_catatan;} ?></textarea>
                                <span><?php echo form_error('komentar'); ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Revisi (maks. 5MB)</label>
                            <div class="col-sm-8">
                                <input name="userfile" id="fileInput" type="file" class="form-control" />
                                <?php if ($this->uri->segment(3)=="submit"){ ?>
                                    <span><?php echo $error; ?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-8">
                                <input name="status" id="status" type="radio" value="ACC" <?php	if($stat=="REVISI"){echo "checked";}?> /> ACC
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input name="status" id="status" type="radio" value="REVISI" <?php	if($stat!="REVISI"){echo "checked";}?>/> Revisi
                            </div>
                        </div>
                        <tr>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">
                                    <button class="btn btn-primary btn-square">Simpan</button>
                                    <a href="<?=site_url('admin/bimbingan/detail_bimbingan/'.$mhs.'/'.$pengid);?>" class="btn btn-warning btn-square">Kembali</a>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
</section>

<?php
$this->load->view('template/js');
?>
