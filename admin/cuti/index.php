<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'cuti';
include_once '../../template/sidebar.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><i class="fas fa-calendar-times ml-1 mr-1"></i> Data Cuti</h4>
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
                                            <th>Nomor Surat</th>
                                            <th>Data Personil</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = $con->query("SELECT * FROM cuti a JOIN personil b ON a.id_personil = b.id_personil JOIN pangkat c ON b.id_pangkat = c.id_pangkat JOIN jabatan d ON b.id_jabatan = d.id_jabatan ORDER BY a.id_cuti DESC");
                                        while ($row = $data->fetch_array()) {
                                            $tgl1 = $row['tgl_mulai'];
                                            $tgl2 = date('Y-m-d', strtotime('-1 days', strtotime($tgl1)));
                                            $a = date_create($tgl2);
                                            $b = date_create($row['tgl_selesai']);
                                            $diff = date_diff($a, $b);
                                        ?>
                                            <tr>
                                                <td align="center" width="5%"><?= $no++ ?></td>
                                                <td align="center"><?= $row['no_surat'] ?></td>
                                                <td>
                                                    <b>Nama </b> : <?= $row['nm_personil'] ?>
                                                    <hr class="mt-1 mb-1">
                                                    <b>NRP/NIP </b> : <?= $row['nrp_nip'] ?>
                                                    <hr class="mt-1 mb-1">
                                                    <b>Pangkat </b> : <?= $row['nm_pangkat'] ?>
                                                    <hr class="mt-1 mb-1">
                                                    <b>Jabatan </b> : <?= $row['nm_jabatan'] ?>
                                                </td>
                                                <td><?= $row['ket'] ?></td>
                                                <td align="center">
                                                    <?= tgl($row['tgl_mulai']) . ' s/d ' . tgl($row['tgl_selesai']) ?>
                                                    <hr class="my-1">
                                                    Lama Cuti : <?= $diff->d . ' Hari' ?>
                                                </td>
                                                <td align="center" width="12%">
                                                    <a href="surat?id=<?= $row[0] ?>" target="_blank" class="btn bg-olive btn-xs" title="Surat"><i class="fas fa-envelope-open-text"></i></a>
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