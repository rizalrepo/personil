<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'mutasi';
include_once '../../template/sidebar.php';

$id = $_GET['id'];
$query = $con->query("SELECT * FROM mutasi a JOIN personil b ON a.id_personil = b.id_personil JOIN pangkat c ON b.id_pangkat = c.id_pangkat JOIN jabatan d ON b.id_jabatan = d.id_jabatan WHERE a.id_mutasi ='$id'");
$row = $query->fetch_array();

$r = $con->query("SELECT * FROM jabatan WHERE id_jabatan = '$row[id_jabatan_lama]'")->fetch_array();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><i class="fas fa-id-card-alt ml-1 mr-1"></i> Edit Data Mutasi Jabatan</h4>
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
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $row['nm_personil'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">NRP / NIP</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $row['nrp_nip'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Pangkat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $row['nm_pangkat'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Jabatan Sebelumnya</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $r['nm_jabatan'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Mutasi ke Jabatan</label>
                                    <div class="col-sm-10">
                                        <select name="id_jabatan" class="form-control select2" style="width: 100%;">
                                            <?php $data = $con->query("SELECT * FROM jabatan ORDER BY id_jabatan ASC"); ?>
                                            <?php foreach ($data as $d) :
                                                if ($d['id_jabatan'] == $row['id_jabatan']) { ?>
                                                    <option value="<?= $d['id_jabatan']; ?>" selected="<?= $d['id_jabatan']; ?>"><?= $d['nm_jabatan'] ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $d['id_jabatan'] ?>"><?= $d['nm_jabatan'] ?></option>
                                            <?php }
                                            endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tanggal</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="tanggal" value="<?= $row['tanggal'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">File SK</label>
                                    <div class="col-sm-10">
                                        <input type="file" accept=".pdf,.PDF" class="form-control" name="file_sk">
                                        <label class="mt-0 mb-0" style='color: red; font-style: italic; font-size: 12px;'>* Biarkan Kosong jika File tidak di Ubah !</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" name="submit" class="btn btn-sm bg-cyan float-right"><i class="fa fa-save"> Update</i></button>
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

<?php
if (isset($_POST['submit'])) {
    $id_jabatan = $_POST['id_jabatan'];
    $tanggal = $_POST['tanggal'];

    $f_file_sk = "";

    if (!empty($_FILES['file_sk']['name'])) {

        $filelama = $row['file_sk'];

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
                if (file_exists($dir_file . $filelama)) {
                    unlink($dir_file . $filelama);
                }

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
                        window.location.replace('edit?id=$id');
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
                    window.location.replace('edit?id=$id');
                } ,2000);  
            </script>";
        }
    } else {
        $file_sk = $row['file_sk'];
        $f_file_sk .= "Upload Success!";
    }

    if (!empty($f_file_sk)) {

        $update = $con->query("UPDATE mutasi SET 
            id_jabatan = '$id_jabatan',
            tanggal = '$tanggal',
            file_sk = '$file_sk'
            WHERE id_mutasi = '$id'
        ");

        if ($update) {

            $con->query("UPDATE personil SET id_jabatan = '$id_jabatan' WHERE id_personil = '$row[id_personil]' ");

            $_SESSION['pesan'] = "Data Berhasil di Update";
            echo "<meta http-equiv='refresh' content='0; url=index'>";
        } else {
            echo "Data anda gagal diubah. Ulangi sekali lagi";
            echo "<meta http-equiv='refresh' content='0; url=edit?id=$id'>";
        }
    }
}



?>