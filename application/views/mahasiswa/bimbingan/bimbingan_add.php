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

                <?php echo form_open_multipart(base_url('bimbingan/add_bimbingan'),  'class="form-horizontal"');  ?>
                <div class="box-body">
                    <div class="form-group">
                        <label for="pembimbing1" class="col-sm-2 control-label">Pembimbing satu</label>
                        <div class="col-sm-6">
                            <label><input name="pembimbing1" type="radio" id="pembimbing1" value="Y"> YA</label>
                            <label><input name="pembimbing1" type="radio" id="pembimbing1" value="T"> TIDAK</label>
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Footer Content -->
                <div class="box box-footer">
                    <button class="btn btn-primary" type="submit" name="submit" value="Add User" id="submit" data-stype='stay'>
                        <i class="fa fa-save" ></i> Save
                    </button>
                    <a class="btn btn-primary" href="<?= base_url('mahasiswa'); ?>"><i class="fa fa-undo" data-stype='back'></i> Back to List</a>


                </div>
                <?php echo form_close( ); ?>
            </div>
        </div>
    </div>
    <!--/box body -->
    </div>
    <!--/box -->
    </div>
</section><!-- /.content -->


<?php
$this->load->view('template/js');
?>
