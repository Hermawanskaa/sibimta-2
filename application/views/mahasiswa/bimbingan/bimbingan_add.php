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

<!-- Page Header -->
<section class="content-header">
    <h1>
        Mahasiswa Dashboard     <small>Add Bimbingan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="">Mahasiswa</a></li>
        <li class="active">Add Bimbingan</li>
    </ol>
</section>

<!-- Header Content -->
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
                            <h5 class="widget-user-desc">Add Bimbingan</h5>
                            <hr>
                        </div>
                    </div>
                </div>
                <?php if(isset($msg) || validation_errors() !== ''): ?>
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-warning"></i> Peringatan!</h4>
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

                <?php if($this->uri->segment(2)=="add_bimbingan"){
                    $files = $file;
                    $act = "add_bimbingan";
                    $lap_id = "";
                }
                elseif($this->uri->segment(2)=="edit_bimbingan"){
                    foreach($bimbingan->result() as $key){
                        $files = $key->lap_file;
                    }
                    $act = "edit_bimbingan";
                    $lap_id = $this->uri->segment(3);
                }
                elseif($this->uri->segment(2)=="submit"){
                    $act = $link;
                    $lap_id = $id;
                } ?>

                <form role="form" class="form-horizontal" enctype="multipart/form-data" action="<?=site_url('bimbingan/submit/'.$this->uri->segment(3));?>" method="POST" >
                    <input type="hidden" id="lap_id" name="lap_id" value="<?php echo $lap_id; ?>" />
                    <input type="hidden" id="act" name="act" value="<?php echo $act; ?>" />
                    <div class="form-group">
                        <label for="lap_topik" class="col-sm-2 control-label">Topik Bimbingan</label>
                        <div class="col-sm-6">
                            <input type="input" class="form-control" name="lap_topik" id="lap_topik" placeholder="Topik Bimbingan">
                            <small class="info help-block">
                            </small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lap_jenis" class="col-sm-2 control-label">Jenis Bimbingan</label>
                        <div class="col-sm-6">
                            <select name='lap_jenis' id='lap_jenis' class="form-control">
                                <option value=''>Please Select</option>
                                <option value="ONLINE">ONLINE</option>
                                <option value="OFFLINE">OFFLINE</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bimb_catatan" class="col-sm-2 control-label">Pembahasan Topik</label>
                        <div class="col-sm-6">
                            <textarea type="input" rows="5" class="form-control"  name="bimb_catatan" id="bimb_catatan" placeholder="Pembahasan Topik"></textarea>
                            <small class="info help-block">
                            </small>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <button class="btn btn-primary btn-square">Simpan</button>
                            <a href="<?=site_url('bimbingan/kategori_bimbingan/'.$this->uri->segment(3));?>" class="btn btn-warning btn-square">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</section><!-- /.content -->


<?php
$this->load->view('template/js');
?>
