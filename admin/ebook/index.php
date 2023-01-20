<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'ebook';
include_once '../../template/sidebar.php';
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><i class="fas fa-sign ml-1 mr-1"></i> Data Ebook</h4>
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
                                            <th>Data Ebook</th>
                                            <th>Kategori Ebook</th>
                                            <th>File Ebook</th>
                                            <th>Tanggal Posting</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = $con->query("SELECT * FROM ebook a JOIN kategori b ON a.id_kategori = b.id_kategori ORDER BY a.id_ebook DESC");
                                        while ($row = $data->fetch_array()) {
                                        ?>
                                            <tr>
                                                <td align="center" width="5%"><?= $no++ ?></td>
                                                <td>
                                                    <b>Judul </b> : <?= $row['judul'] ?>
                                                    <hr class="mt-1 mb-1">
                                                    <b>Penulis </b> : <?= $row['penulis'] ?>
                                                    <hr class="mt-1 mb-1">
                                                    <b>Penerbit </b> : <?= $row['penerbit'] ?>
                                                    <hr class="mt-1 mb-1">
                                                    <b>Tahun </b> : <?= $row['tahun'] ?>
                                                </td>
                                                <td align="center"><?= $row['nm_kategori'] ?></td>
                                                <td align="center">
                                                    <a href="<?= base_url('file/cover/' . $row['cover']) ?>" class="mb-2 btn btn-block btn-xs bg-olive" target="_blank"><i class="fas fa-image"></i> Lihat Cover</a>
                                                    <a href="<?= base_url('file/pdf/' . $row['pdf']) ?>" class="btn btn-block btn-xs bg-olive" target="_blank"><i class="fas fa-file-pdf"></i> Lihat File</a>
                                                </td>
                                                <td align="center"><?= tgl($row['tgl_posting']) ?></td>
                                                <td align="center" width="9%">
                                                    <a href="edit?id=<?= $row[0] ?>" class="btn btn-info btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                                                    <a href="hapus?id=<?= $row[0] ?>" class="btn btn-danger btn-xs alert-hapus" title="Hapus"><i class="fa fa-trash"></i> </a>
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