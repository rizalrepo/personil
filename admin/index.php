<?php
require '../app/config.php';
include_once '../template/header.php';
$page = 'dashboard';
include_once '../template/sidebar.php';

$a = $con->query("SELECT COUNT(*) AS total FROM personil")->fetch_array();
$b1 = $con->query("SELECT COUNT(*) AS total FROM cuti")->fetch_array();
$b2 = $con->query("SELECT COUNT(*) AS total FROM cuti WHERE verif = 1 ")->fetch_array();
$c1 = $con->query("SELECT COUNT(*) AS total FROM mutasi")->fetch_array();
$c2 = $con->query("SELECT COUNT(*) AS total FROM mutasi WHERE verif = 1")->fetch_array();
$d = $con->query("SELECT COUNT(*) AS total FROM tugas")->fetch_array();
$e = $con->query("SELECT COUNT(*) AS total FROM kegiatan")->fetch_array();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <div class="info-box bg-gradient-purple mb-3">
                        <span class="info-box-icon bg-gradient-purple elevation-2"><i class="fas fa-id-badge"></i></span>
                        <div class="info-box-content">
                            <h6 class="info-box-text mt-2 mb-0">Data Personil</h6>
                            <?= $a['total'] ?> Total Data
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="info-box bg-gradient-purple mb-3">
                        <span class="info-box-icon bg-gradient-purple elevation-2"><i class="fas fa-calendar-times"></i></span>
                        <div class="info-box-content">
                            <h6 class="info-box-text mt-2 mb-0">Data Cuti</h6>
                            <span class="badge badge-success"><?= $b1['total'] ?> Total Data</span> | <span class="badge badge-warning"><?= $b2['total'] ?> Data Belum Verifikasi</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="info-box bg-gradient-primary mb-3">
                        <span class="info-box-icon bg-gradient-primary elevation-2"><i class="fas fa-id-card-alt"></i></span>
                        <div class="info-box-content">
                            <h6 class="info-box-text mt-2 mb-0">Data Mutasi Jabatan</h6>
                            <span class="badge badge-success"><?= $c1['total'] ?> Total Data</span> | <span class="badge badge-warning"><?= $c2['total'] ?> Data Belum Verifikasi</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="info-box bg-gradient-primary mb-3">
                        <span class="info-box-icon bg-gradient-primary elevation-2"><i class="fas fa-briefcase"></i></span>
                        <div class="info-box-content">
                            <h6 class="info-box-text mt-2 mb-0">Data Perintah Tugas</h6>
                            <?= $d['total'] ?> Total Data
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="info-box bg-gradient-primary mb-3">
                        <span class="info-box-icon bg-gradient-primary elevation-2"><i class="far fa-calendar-alt"></i></span>
                        <div class="info-box-content">
                            <h6 class="info-box-text mt-2 mb-0">Data Kegiatan</h6>
                            <?= $e['total'] ?> Total Data
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include_once '../template/footer.php';
?>