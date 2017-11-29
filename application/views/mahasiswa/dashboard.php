<?php
$this->load->view('template/head');
?>

<?php
$this->load->view('mahasiswa/template/topbar');
$this->load->view('mahasiswa/template/sidebar');
?>

<section class="content-header">
    <h1>
        Dashboard Mahasiswa
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard Mahasiswa</li>
    </ol>
</section>

    <section class="content">
        <?php if(!empty($result) || $result !=''){ ?>
        <?php foreach($result as $row) { ?>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Judul Skripsi : </h3>
                <strong><?php echo strtoupper($row['jdl_judul']);?></strong>
            </div>
            <div class="box-header with-border">
                <h3 class="box-title">Dosen Pembimbing  : </h3>
                <strong>
            <?php foreach($dosen[$row['dsn_id']] as $dos) {
            echo"&nbsp;$dos,"; } } ?></strong>
            </div>
            <?php }else{ } ?>
        </div>
    </section>
</section>


<?php
$this->load->view('template/js');
?>
