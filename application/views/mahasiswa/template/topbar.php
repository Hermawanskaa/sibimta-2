<header>
    <body class="skin-blue">
    <div class="wrapper">

        <header class="main-header">
            <a href="<?php echo base_url('mahasiswa') ;?>" class="logo"><b>SIBIMTA</b>UMY</a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <?php
                        $id = $this->session->userdata('id');
                        $this->db->select('COUNT(*) as jumlah');
                        $this->db->from(' pesan_dosen');
                        $this->db->where('mhs_id',$id);
                        $this->db->where('pesdos_status',0);
                        $this->db->where('pesan_dosen.katlap_id !=',3);
                        $query= $this->db->get();

                        if($query->num_rows() <> 0){
                            $data = $query->row();
                            $jumlah = intval($data->jumlah);
                        }else{ $jumlah = 0; } ?>

                        <li class="dropdown messages-menu">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success"><?php echo $jumlah; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header" id="load_row">Kamu memiliki <?php echo $jumlah; ?> pesan</li>
                                <?php
                                $this->db->select('*');
                                $this->db->from('pesan_dosen');
                                $this->db->join('dosen','pesan_dosen.dsn_id = dosen.dsn_id');
                                $this->db->join('kategori_laporan','pesan_dosen.katlap_id = kategori_laporan.katlap_id');
                                $this->db->where('mhs_id',$id);
                                $this->db->where('pesdos_status',0);
                                $this->db->where('pesan_dosen.katlap_id !=',3);
                                $this->db->order_by('pesdos_id','desc');
                                $query= $this->db->get();
                                foreach($query->result() as $key=>$notif): ?>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="<?php echo site_url('mahasiswa/detail_pesan/'.$notif->katlap_id.'/'.$notif->pesdos_id);?>">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url().'uploads/foto/dosen/'.$notif->dsn_foto;?>" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                    <?php echo $notif->dsn_nama; ?>
                                                    <small><i class="fa fa-clock-o"></i> <?php echo $notif->pesdos_tanggal; ?></small>
                                                </h4>
                                                <p>Menjawab <i>'Pengajuan <?php echo "<b>".$notif->katlap_kategori."</b>'</i>&nbsp;&nbsp;&nbsp;Anda</font> "; ?></p>
                                            </a>
                                        </li>
                                    </ul>
                                    <?php endforeach; ?>
                                </li>

                                <li class="footer"><a href="<?php echo base_url('mahasiswa/pesan/') ;?>">See All Messages</a></li>
                            </ul>
                        </li>

                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo base_url().'uploads/foto/mahasiswa/'.$this->session->userdata('foto');;?>" class="user-image" alt="User Image"/>
                                <span class="hidden-xs"><?= ucwords($this->session->userdata('nama')); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="<?php echo base_url().'uploads/foto/mahasiswa/'.$this->session->userdata('foto');;?>" class="img-circle" alt="User Image" />
                                    <p><?= ucwords($this->session->userdata('nama')); ?>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo base_url('profil') ?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url('auth/login/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>