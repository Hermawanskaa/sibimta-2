<?php
$this->load->view('template/head');
?>

<?php
$this->load->view('dosen/template/topbar');
$this->load->view('dosen/template/sidebar');
?>

<section class="content-header">
    <h1>
        Dosen Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dosen Dashboard</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info box-header with-border">

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
            <?php } ?>
            <div class="box box-info box-header with-border">
            <div class="table-responsive">
                <table id="list_dosen" class="table table-bordered table-striped dataTable">
                    <div id="text-popup-html" class="white-popup mfp-with-anim mfp-hide">
                        <thead>
                        <th>NO</th>
                        <th>NAMA MAHASISWA</th>
                        <th>JUDUL</th>
                        <th>DETAIL</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; ?>
                        <?php foreach($mahasiswa_bimbingan->result() as $key): ?>
                            <tr>
                                <td><?php echo $no++;?></td>
                                <td><?php echo $key->mhs_nama; ?></td>
                                <td><?php echo$key->jdl_judul; ?></td>
                                <td><a href="<?php echo site_url('admin/bimbingan/detail_bimbingan/'.$key->mhs_id);?>" />
                                    <button class="btn btn-xs btn-flat btn-info btnbrg-edit" type="submit" name="detail" value="Detail">
                                        Detail
                                    </button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>
    </div>
</section>


<?php
$this->load->view('template/js');
?>
