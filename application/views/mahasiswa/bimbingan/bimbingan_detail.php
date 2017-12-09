<?php
$this->load->view('template/head');
?>

<?php
$this->load->view('mahasiswa/template/topbar');
$this->load->view('mahasiswa/template/sidebar');
?>


<section class="content-header">
    <h1>
        Mahasiswa Dashboard     <small>Detail Bimbingan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="">Mahasiswa</a></li>
        <li class="active">Detail Bimbingan</li>
    </ol>
</section>

<section class="content">
    <div class="row" >
        <div class="col-md-12">
            <div class="box box-info box-header with-border">
                    <?php foreach($topik->result() as $row): ?>
                    <h4><p><strong>Topik : </strong><?php echo $row->lap_topik;?><br></p></h4><hr>
                    <h4><p><strong>Jenis : </strong><?php echo $row->lap_jenis;?><br></p></h4><hr>
                    <h4><p><strong>Tanggal : </strong><?php echo $row->lap_tanggal;?><br></p></h4><hr>
                    <h4><p><strong>Waktu : </strong><?php echo $row->lap_waktu;?><br></p></h4>
                    <?php endforeach; ?>
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

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <span class="glyphicon glyphicon-comment"></span>  Bimbingan
                            </div>
                            <br>
                            <div class="container">
                                <?php if(count($log) > 0):?>
                                <?php foreach($log->result() as $key): ?>
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <div class="thumbnail">
                                                <img class="img-responsive user-photo" src="<?php echo base_url().'uploads/foto/mahasiswa/'.$this->session->userdata('foto');;?>">
                                            </div>
                                        </div>

                                        <div class="col-md-10">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <strong><?= $key->mhs_nama; ?></strong> <span class="text-muted">commented on <?php echo $key->bimb_wkt; ?></span>
                                                </div>
                                                <div class="panel-body">
                                                    <?= $key->bimb_catatan; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>

                            <div class="panel-footer">
                                <div class="input-group col-md-12">
                                    <?php echo form_open_multipart(base_url('bimbingan/add_bimbingan/'.$key->mhs_id),  'class="form-horizontal"');  ?>
                                    <textarea id="btn-input" type="text" id='bimb_catatan' name="bimb_catatan" class="form-control" rows="4" placeholder="Type your message here..."></textarea>
                                    <hr>
                                    <span><p class="text-danger"><hr>Attachment (Optional)</p></span>
                                    <div class="pull-left">
                                        <input name="userfile" id="fileInput" class="form-control" type="file" />
                                    </div>
                                    <button class="btn btn-warning pull-right" type="submit" name="submit" id="submit">Kirim Pesan</button>
                                    <?php echo form_close( ); ?>
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
