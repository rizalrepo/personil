<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'mutasi';
include_once '../../template/sidebar.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><i class="fas fa-id-card-alt ml-1 mr-1"></i> Data Mutasi Jabatan</h4>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
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
                                            <th>Data Personil</th>
                                            <th>Mutasi ke Jabatan</th>
                                            <th>Jabatan Sebelumnya</th>
                                            <th>Tanggal</th>
                                            <th>Verifikasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = $con->query("SELECT * FROM mutasi a JOIN personil b ON a.id_personil = b.id_personil JOIN pangkat c ON b.id_pangkat = c.id_pangkat JOIN jabatan d ON b.id_jabatan = d.id_jabatan ORDER BY a.id_mutasi DESC");
                                        while ($row = $data->fetch_array()) {
                                        ?>
                                            <tr>
                                                <td align="center" width="5%"><?= $no++ ?></td>
                                                <td>
                                                    <b>Nama </b> : <?= $row['nm_personil'] ?>
                                                    <hr class="mt-1 mb-1">
                                                    <b>NRP/NIP </b> : <?= $row['nrp_nip'] ?>
                                                    <hr class="mt-1 mb-1">
                                                    <b>Pangkat </b> : <?= $row['nm_pangkat'] ?>
                                                </td>
                                                <td align="center">
                                                    <span class="btn btn-xs btn-success"><?= $row['nm_jabatan'] ?></span>
                                                </td>
                                                <td align="center">
                                                    <?php $d = $con->query("SELECT * FROM jabatan WHERE id_jabatan = '$row[id_jabatan_lama]' ")->fetch_array(); ?>
                                                    <span class="btn btn-xs btn-warning"><?= $d['nm_jabatan'] ?></span>
                                                </td>
                                                <td align="center"><?= tgl($row['tanggal']) ?></td>
                                                <td align="center">
                                                    <?php if ($row['verif'] == 1) { ?>
                                                        <span class="btn btn-xs btn-warning">Menunggu</span>
                                                    <?php } else if ($row['verif'] == 2) { ?>
                                                        <span class="btn btn-xs btn-success">Disetujui</span>
                                                    <?php } else { ?>
                                                        <span class="btn btn-xs btn-danger">Ditolak</span><br>
                                                        <?= $row['verif_ket'] ?>
                                                    <?php }  ?>
                                                </td>
                                                <td align="center" width="12%">
                                                    <?php if ($row['verif'] == 1) { ?>
                                                        <a href="edit?id=<?= $row[0] ?>" class="btn btn-info btn-xs" title="Edit"><i class="fa fa-edit"></i> Verifikasi</a>
                                                    <?php } else if ($row['verif'] == 2) { ?>
                                                        <a href="<?= base_url('file/mutasi/' . $row['file_sk']) ?>" target="_blank" class="btn bg-olive btn-xs" title="File SK"><i class="fas fa-file-pdf"></i></a>
                                                    <?php } else { ?>
                                                        #
                                                    <?php }  ?>
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