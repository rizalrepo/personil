<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'kegiatan';
include_once '../../template/sidebar.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><i class="far fa-calendar-alt ml-1 mr-1"></i> Data Kegiatan</h4>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a href="tambah" class="btn btn-sm bg-dark"><i class="fa fa-plus-circle"> Tambah Data</i></a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-purple card-outline">
                        <!-- form start -->
                        <div class="card-body" style="background-color: white;">

                            <?php if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') { ?>
                                <div id="notif" class="alert bg-primary" role="alert"><i class="fa fa-check-circle mr-2"></i><b><?= $_SESSION['pesan'] ?></b></div>
                            <?php $_SESSION['pesan'] = '';
                            } ?>
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped dataTable">
                                    <thead class="bg-purple">
                                        <tr align="center">
                                            <th>No</th>
                                            <th>Nama Kegiatan</th>
                                            <th>Jenis Kegiatan</th>
                                            <th>Tanggal</th>
                                            <th>Tempat</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = $con->query("SELECT * FROM kegiatan a JOIN jenis_kegiatan b ON a.id_jenis_kegiatan = b.id_jenis_kegiatan ORDER BY a.id_kegiatan DESC");
                                        while ($row = $data->fetch_array()) {
                                            $tgl1 = $row['tgl_mulai'];
                                            $tgl2 = date('Y-m-d', strtotime('-1 days', strtotime($tgl1)));
                                            $a = date_create($tgl2);
                                            $b = date_create($row['tgl_selesai']);
                                            $diff = date_diff($a, $b);

                                            $mulai = date('Y-m-d', strtotime($row['tgl_mulai']));
                                            $selesai = date('Y-m-d', strtotime($row['tgl_selesai']));

                                            if ((date('Y-m-d') >= $mulai) && (date('Y-m-d') <= $selesai)) {
                                                $waktu = '<span class="btn btn-xs btn-primary">Sedang Dilaksanakan</span>';
                                            } else if (date('Y-m-d') < $mulai) {
                                                $waktu = '<span class="btn btn-xs btn-warning">Belum Dilaksanakan</span>';
                                            } else if (date('Y-m-d') > $selesai) {
                                                $waktu = '<span class="btn btn-xs btn-success">Telah Dilaksanakan</span>';
                                            }
                                        ?>
                                            <tr>
                                                <td align="center" width="5%"><?= $no++ ?></td>
                                                <td><?= $row['nm_kegiatan'] ?></td>
                                                <td align="center"><?= $row['nm_jenis_kegiatan'] ?></td>
                                                <td align="center">
                                                    <?php if ($row['tgl_mulai'] == $row['tgl_selesai']) { ?>
                                                        <?= tgl($row['tgl_mulai']) ?>
                                                    <?php } else { ?>
                                                        <?= tgl($row['tgl_mulai']) . ' s/d ' . tgl($row['tgl_selesai']) ?>
                                                    <?php } ?>
                                                    <hr class="mt-1 mb-1">
                                                    Lama Kegiatan : <b><?= $diff->d . ' Hari' ?></b>
                                                    <hr class="mt-1 mb-1">
                                                    <?= $waktu ?>
                                                </td>
                                                <td align="center"><?= $row['tempat'] ?></td>
                                                <td><?= $row['ket'] ?></td>
                                                <td align="center" width="9%">
                                                    <a href="edit?id=<?= $row[0] ?>" class="btn btn-info btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                                                    <a href="hapus?id=<?= $row[0] ?>" class="btn btn-danger btn-xs alert-hapus" title="Hapus"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
                <!--/.col (left) -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include_once '../../template/footer.php';
?>