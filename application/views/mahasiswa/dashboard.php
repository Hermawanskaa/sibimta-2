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
        <?php if(!empty($result) || $result !=''): ?>
        <?php foreach($result as $row): ?>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Judul Skripsi : </h3>
                <strong><?php echo strtoupper($row['jdl_judul']);?></strong>
            </div>
            <?php endforeach; ?>
            <div class="box-header with-border">
                <h3 class="box-title">Dosen Pembimbing  : </h3>
                <strong><?php foreach($dosen[$row['dsn_id']] as $dos) { echo"&nbsp;$dos,"; } ?></strong>
            </div>
            <?php endif; ?>
        </div>

        <div class="box">
            <div class="box-header with-border">
        <?php
        $stat		= 'AKTIF';
        $nama		= array('judul','BAB 1', 'BAB 2', 'BAB 3', 'BAB 4', 'BAB 5', 'BAB 6');
        $link		= array('skripsi', 'bimbingan', 'bimbingan', 'bimbingan', 'bimbingan', 'bimbingan', 'bimbingan');
        $doc		= array('0','4','5','6','7','8','9');

        for($i=0; $i<7; $i++){ foreach($dashboard->result() as $row)
        $judul 		= $row->judul;
        $bab1		= $row->bab1;
        $bab2		= $row->bab2;
        $bab3		= $row->bab3;
        $bab4		= $row->bab4;
        $bab5		= $row->bab5;
        $bab6		= $row->bab6;
        $data		= array($judul, $bab1, $bab2, $bab3, $bab4, $bab5, $bab6);
        echo "<div class='col-sm-4'>"; ?>

            <?php if($data[$i] != $stat): ?>
                <div class='box box-primary' style='background-color:#E0E0ED'>
                    <div class=' text-center'>
                        <h4> <img src='<?=base_url();?>assets/img/lock.png' width='5%'>&nbsp;&nbsp;<?php echo strtoupper($nama[$i]);?></h4>
                    </div>
                </div>
                <?php elseif($nama[$i]!='judul'):?>
                <div class='box box-primary'>
                    <a href='<?php echo site_url($link[$i].'/kategori/'.$doc[$i]);?>'>
                        <div class=' text-center'>
                            <h4><img src='<?=base_url();?>assets/img/journal.png' width='5%'>&nbsp;&nbsp;<?php echo strtoupper($nama[$i]);?></h4>
                        </div>
                    </a>
                </div>
                <?php else:?>
                <div class='box box-primary'>
                    <a href='<?php echo site_url($link[$i]);?>'>
                        <div class=' text-center'>
                            <h4><img src='<?=base_url();?>assets/img/journal.png' width='5%'>&nbsp;&nbsp;<?php echo strtoupper($nama[$i]);?></h4>
                        </div>
                    </a>
                </div>
            <?php endif;?>
            </div>
            <?php } ?>
    </section>

<?php
$this->load->view('template/js');
?>
