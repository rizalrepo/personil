<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'tugas';
include_once '../../template/sidebar.php';

$id = $_GET['id'];
$query = $con->query(" SELECT * FROM tugas WHERE id_tugas ='$id'");
$row = $query->fetch_array();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><i class="fas fa-briefcase ml-1 mr-1"></i> Edit Data Perintah Tugas</h4>
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
                                        <input type="date" class="form-control" name="tgl_surat" value="<?= $row['tgl_surat'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Agenda</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="agenda" value="<?= $row['agenda'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tanggal Mulai</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="tgl_mulai" value="<?= $row['tgl_mulai'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tanggal Selesai</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="tgl_selesai" value="<?= $row['tgl_selesai'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tempat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="tempat" value="<?= $row['tempat'] ?>" required>
                                    </div>
                                </div>
                                <hr>
                                <a href="#" data-toggle="modal" data-target="#modal-tambah" class="btn btn-sm bg-maroon mb-2"><i class="fa fa-plus-circle"></i> Tambah Personil</a>
                                <input type="hidden" id="dataid" value="<?= $id; ?>">
                                <div id="data-personil">

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" name="submit" class="btn btn-sm bg-info float-right"><i class="fa fa-save"> Update</i></button>
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
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Personil</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form-tambah" method="POST" enctype="multipart/form-data" action="detail/simpan.php">
                    <div class="card-body">
                        <input type="hidden" name="id_tugas" value="<?= $id ?>">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama personil</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" style="width: 100%;" id="id_personil" name="id_personil" required>
                                    <option value=""> -- Pilih -- </option>
                                    <?php
                                    $q = $con->query("SELECT * FROM personil ORDER BY nm_personil ASC");
                                    while ($d = $q->fetch_array()) {
                                    ?>
                                        <option value="<?= $d['id_personil'] ?>"><?= $d['nm_personil'] ?> | NPP/NIP. <?= $d['nrp_nip'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-info">Simpan</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
<?php
include_once '../../template/footer.php';
?>
<script>
    muncul();
    var data = "detail/tampil.php";

    function muncul() {
        $.post('detail/tampil.php', {
                id: $("#dataid").val()
            },
            function(data) {
                $("#data-personil").html(data);
            }
        );
    }

    $("#form-tambah").submit(function(e) {
        e.preventDefault();

        var dataform = $("#form-tambah").serialize();
        $.ajax({
            url: "detail/simpan.php",
            type: "POST",
            data: dataform,
            success: function(result) {
                var hasil = JSON.parse(result);
                if (hasil.hasil == "sukses") {
                    $('#modal-tambah').modal('hide');
                    $('#id_personil').val(null).trigger('change');
                    muncul();
                }
            }
        });
    });

    $(document).on('click', '#hapus', function(e) {
        e.preventDefault();
        $.post('detail/hapus.php', {
                id: $(this).attr('data-id')
            },
            function(html) {
                muncul();
            }
        );
    });
</script>
<?php
if (isset($_POST['submit'])) {
    $tgl_surat = $_POST['tgl_surat'];
    $agenda = $_POST['agenda'];
    $tgl_mulai = $_POST['tgl_mulai'];
    $tgl_selesai = $_POST['tgl_selesai'];
    $tempat = $_POST['tempat'];

    $update = $con->query("UPDATE tugas SET 
        tgl_surat = '$tgl_surat',
        agenda = '$agenda',
        tgl_mulai = '$tgl_mulai',
        tgl_selesai = '$tgl_selesai',
        tempat = '$tempat'
        WHERE id_tugas = '$id'
    ");

    if ($update) {
        $_SESSION['pesan'] = "Data Berhasil di Update";
        echo "<meta http-equiv='refresh' content='0; url=index'>";
    } else {
        echo "Data anda gagal diubah. Ulangi sekali lagi";
        echo "<meta http-equiv='refresh' content='0; url=edit?id=$id'>";
    }
}


?>