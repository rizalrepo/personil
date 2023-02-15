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
                    <h4 class="m-0 text-dark"><i class="fas fa-id-card-alt ml-1 mr-1"></i> Tambah Data Mutasi Jabatan</h4>
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
                                    <label class="col-sm-2 col-form-label">Nama Personil</label>
                                    <div class="col-sm-10 input-group">
                                        <input type="text" class="form-control" hidden name="id_personil" id="id_personil" required>
                                        <input type="text" class="form-control" id="nm_personil" required readonly>
                                        <span class="input-group-append">
                                            <button type="button" data-toggle="modal" data-target="#modal_personil" class="btn bg-purple btn-flat"><i class="fa fa-search"></i> Pilih</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">NRP / NIP</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nrp_nip" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Pangkat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nm_pangkat" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Jabatan Sekarang</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nm_jabatan" readonly>
                                        <input type="hidden" class="form-control" name="id_jabatan_lama" id="id_jabatan_lama" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Mutasi ke Jabatan</label>
                                    <div class="col-sm-10">
                                        <select name="id_jabatan" class="form-control select2" style="width: 100%;">
                                            <option value="">-- Pilih --</option>
                                            <?php $data = $con->query("SELECT * FROM jabatan ORDER BY id_jabatan ASC"); ?>
                                            <?php foreach ($data as $row) : ?>
                                                <option value="<?= $row['id_jabatan'] ?>"><?= $row['nm_jabatan'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tanggal</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="tanggal" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">File SK</label>
                                    <div class="col-sm-10">
                                        <input type="file" accept=".pdf,.PDF" class="form-control" name="file_sk" required>
                                        <label class="mt-0 mb-0" style='color: red; font-style: italic; font-size: 12px;'>* File harus PDF dan Ukuran file maksimal 2MB</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" name="submit" class="btn btn-sm bg-cyan float-right"><i class="fa fa-save"> Simpan</i></button>
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

<div class="modal fade" id="modal_personil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih mutasi dari Personil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered">
                        <thead class="bg-lightblue">
                            <tr align="center">
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>NRP / NIP</th>
                                <th>Pangkat</th>
                                <th>Jabatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            $data = $con->query("SELECT * FROM personil a JOIN pangkat b ON a.id_pangkat = b.id_pangkat JOIN jabatan c ON a.id_jabatan = c.id_jabatan ORDER BY a.id_personil ASC");
                            while ($row = $data->fetch_array()) {
                            ?>
                                <tr>
                                    <td align="center" width="5%"><?= $no++ ?></td>
                                    <td><?= $row['nm_personil'] ?></td>
                                    <td align="center"><?= $row['nrp_nip'] ?></td>
                                    <td align="center"><?= $row['nm_pangkat'] ?></td>
                                    <td align="center"><?= $row['nm_jabatan'] ?></td>
                                    <td align="center" width="18%">
                                        <button class="btn btn-xs bg-purple" id="select" data-nm_personil="<?= $row['nm_personil'] ?>" data-id_personil="<?= $row['id_personil'] ?>" data-nrp_nip="<?= $row['nrp_nip']  ?>" data-nm_pangkat="<?= $row['nm_pangkat']  ?>" data-nm_jabatan="<?= $row['nm_jabatan'] ?>" data-id_jabatan_lama="<?= $row['id_jabatan'] ?>">
                                            <i class="fas fa-check-circle"></i> Pilih
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '#select', function() {
            var nm_personil = $(this).data('nm_personil');
            var id_personil = $(this).data('id_personil');
            var nrp_nip = $(this).data('nrp_nip');
            var nm_pangkat = $(this).data('nm_pangkat');
            var nm_jabatan = $(this).data('nm_jabatan');
            var id_jabatan_lama = $(this).data('id_jabatan_lama');
            $('#nm_personil').val(nm_personil);
            $('#id_personil').val(id_personil);
            $('#nrp_nip').val(nrp_nip);
            $('#nm_pangkat').val(nm_pangkat);
            $('#nm_jabatan').val(nm_jabatan);
            $('#id_jabatan_lama').val(id_jabatan_lama);
            $('#modal_personil').modal('hide');
        });
    })
</script>

<?php
if (isset($_POST['submit'])) {
    $id_personil = $_POST['id_personil'];
    $id_jabatan = $_POST['id_jabatan'];
    $id_jabatan_lama = $_POST['id_jabatan_lama'];
    $tanggal = $_POST['tanggal'];

    $f_file_sk = "";

    if (!empty($_FILES['file_sk']['name'])) {

        // UPLOAD FILE 
        $file      = $_FILES['file_sk']['name'];
        $x_file    = explode('.', $file);
        $ext_file  = end($x_file);
        $file_sk = rand(1, 99999) . '.' . $ext_file;
        $size_file = $_FILES['file_sk']['size'];
        $tmp_file  = $_FILES['file_sk']['tmp_name'];
        $dir_file  = '../../file/mutasi/';
        $allow_ext        = array('pdf', 'PDF');
        $allow_size       = 2097152;
        // var_dump($file_sk); die();

        if (in_array($ext_file, $allow_ext) === true) {
            if ($size_file <= $allow_size) {
                move_uploaded_file($tmp_file, $dir_file . $file_sk);

                $f_file_sk .= "Upload Success";
            } else {
                echo "
                <script type='text/javascript'>
                    setTimeout(function () {    
                        swal({
                            title: '',
                            text:  'Ukuran File Terlalu Besar, Maksimal 2 Mb',
                            type: 'warning',
                            timer: 3000,
                            showConfirmButton: true
                        });     
                    },10);   
                    window.setTimeout(function(){ 
                        window.location.replace('tambah');
                    } ,2000); 
                </script>";
            }
        } else {
            echo "
            <script type='text/javascript'>
                setTimeout(function () {    
                    swal({
                        title: 'Format File Tidak Didukung',
                        text:  'File Harus PDF',
                        type: 'warning',
                        timer: 3000,
                        showConfirmButton: true
                    });     
                },10);  
                window.setTimeout(function(){ 
                    window.location.replace('tambah');
                } ,2000);  
            </script>";
        }
    } else {
        $file_sk = $_POST['file_sk'];
        $f_file_sk .= "Upload Success!";
    }

    if (!empty($f_file_sk)) {

        $tambah = $con->query("INSERT INTO mutasi VALUES (
            default, 
            '$id_personil', 
            '$id_jabatan',
            '$id_jabatan_lama',
            '$tanggal',
            '$file_sk',
            1,
            default
        )");

        if ($tambah) {

            $con->query("UPDATE personil SET id_jabatan = '$id_jabatan' WHERE id_personil = '$id_personil' ");

            $_SESSION['pesan'] = "Data Berhasil di Simpan";
            echo "<meta http-equiv='refresh' content='0; url=index'>";
        } else {
            echo "Data anda gagal disimpan. Ulangi sekali lagi";
            echo "<meta http-equiv='refresh' content='0; url=tambah'>";
        }
    }
}



?>