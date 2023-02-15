<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'cuti';
include_once '../../template/sidebar.php';

$id = $_GET['id'];
$query = $con->query("SELECT * FROM cuti a JOIN personil b ON a.id_personil = b.id_personil JOIN pangkat c ON b.id_pangkat = c.id_pangkat JOIN jabatan d ON b.id_jabatan = d.id_jabatan WHERE a.id_cuti ='$id'");
$row = $query->fetch_array();

$vf = [
    '' => '-- Pilih --',
    '1' => 'Menunggu',
    '2' => 'Disetujui',
    '3' => 'Ditolak',
];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><i class="fas fa-calendar-times ml-1 mr-1"></i> Edit Data Cuti</h4>
                </div><!-- /.col -->
                <div class="col-sm-6 float-right">
                    <a href="#" onClick="history.go(-1);" class="btn btn-xs bg-dark float-right"><i class="fa fa-arrow-left"> Kembali</i></a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- left column -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-purple card-outline">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body" style="background-color: white;">
                            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nomor Surat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $row['no_surat'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tanggal Surat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= tgl($row['tgl_surat']) ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama Personil</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nm_personil" value="<?= $row['nm_personil'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">NRP / NIP</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nrp_nip" value="<?= $row['nrp_nip'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Pangkat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nm_pangkat" value="<?= $row['nm_pangkat'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Jabatan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nm_jabatan" value="<?= $row['nm_jabatan'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $row['ket'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tanggal Cuti</label>
                                    <div class="col-sm-10">
                                        <?php if ($row['tgl_mulai'] == $row['tgl_selesai']) {
                                            $tgl_cuti = tgl($row['tgl_mulai']);
                                        } else {
                                            $tgl_cuti = tgl($row['tgl_mulai']) . ' s/d ' . tgl($row['tgl_selesai']);
                                        } ?>
                                        <input type="text" class="form-control" value="<?= $tgl_cuti ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Verifikasi</label>
                                    <div class="col-sm-10">
                                        <?= form_dropdown('verif', $vf, $row['verif'], 'class="form-control" required id="sts"') ?>
                                    </div>
                                </div>
                                <div class="form-group row" id="ket" hidden>
                                    <label class="col-sm-2 col-form-label">Keterangan Ditolak</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="verif_ket"><?= $row['verif_ket'] ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" name="submit" class="btn btn-sm bg-cyan float-right"><i class="fa fa-save"> Verifikasi</i></button>
                                        <button type="reset" class="btn btn-sm btn-danger float-right mr-1"><i class="fa fa-times-circle"> Batal</i></button>
                                    </div>
                                </div>
                            </form>
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

<script type='text/javascript'>
    $(window).load(function() {
        $("#sts").change(function() {
            console.log($("#sts option:selected").val());
            if ($("#sts option:selected").val() == '3') {
                $('#ket').prop('hidden', false);
            } else {
                $('#ket').prop('hidden', 'true');
            }
        });
    });
</script>

<?php
if (isset($_POST['submit'])) {
    $verif = $_POST['verif'];
    $verif_ket = $_POST['verif_ket'];

    $update = $con->query("UPDATE cuti SET 
        verif = '$verif',
        verif_ket = '$verif_ket'
        WHERE id_cuti = '$id'
    ");

    if ($update) {
        $_SESSION['pesan'] = "Data Cuti Berhasil di Verifikasi";
        echo "<meta http-equiv='refresh' content='0; url=index'>";
    } else {
        echo "Data anda gagal diubah. Ulangi sekali lagi";
        echo "<meta http-equiv='refresh' content='0; url=edit?id=$id'>";
    }
}



?>