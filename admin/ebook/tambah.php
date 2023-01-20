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
                    <h4 class="m-0 text-dark"><i class="fas fa-sign ml-1 mr-1"></i> Tambah Data Ebook</h4>
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
                                    <label class="col-sm-2 col-form-label">Judul</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="judul" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Penulis</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="penulis" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Penerbit</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="penerbit" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tahun Terbit</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="tahun" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Kategori</label>
                                    <div class="col-sm-10">
                                        <select name="id_kategori" class="form-control select2" style="width: 100%;">
                                            <option value="">-- Pilih --</option>
                                            <?php $data = $con->query("SELECT * FROM kategori ORDER BY id_kategori ASC"); ?>
                                            <?php foreach ($data as $row) : ?>
                                                <option value="<?= $row['id_kategori'] ?>"><?= $row['nm_kategori'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">File Cover</label>
                                    <div class="col-sm-10">
                                        <input type="file" accept=".jpg,.JPG,.jpeg,.JPEG,.png,.PNG" class="form-control" name="cover" required>
                                        <label class="mt-0 mb-0" style='color: red; font-style: italic; font-size: 12px;'>* File harus JPG, JPEG, PNG dan Ukuran file maksimal 2MB</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">File PDF</label>
                                    <div class="col-sm-10">
                                        <input type="file" accept=".pdf,.PDF" class="form-control" name="pdf" required>
                                        <label class="mt-0 mb-0" style='color: red; font-style: italic; font-size: 12px;'>* File harus PDF dan Ukuran file maksimal 5MB</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tanggal Posting</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="tgl_posting" value="<?= date('Y-m-d') ?>" required>
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

<?php
if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $id_kategori = $_POST['id_kategori'];
    $tgl_posting = $_POST['tgl_posting'];

    $f_cover = "";

    if (!empty($_FILES['cover']['name'])) {

        // UPLOAD FILE 
        $file      = $_FILES['cover']['name'];
        $x_file    = explode('.', $file);
        $ext_file  = end($x_file);
        $cover = rand(1, 99999) . '.' . $ext_file;
        $size_file = $_FILES['cover']['size'];
        $tmp_file  = $_FILES['cover']['tmp_name'];
        $dir_file  = '../../file/cover/';
        $allow_ext        = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG');
        $allow_size       = 2097152;
        
        // var_dump($cover); die();

        if (in_array($ext_file, $allow_ext) === true) {
            if ($size_file <= $allow_size) {
                move_uploaded_file($tmp_file, $dir_file . $cover);

                $f_cover .= "Upload Success";
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
                        text:  'File Harus JPG, JPEG dan PNG',
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
        $cover = $_POST['cover'];
        $f_cover .= "Upload Success!";
    }


    $f_pdf = "";

    if (!empty($_FILES['pdf']['name'])) {

        // UPLOAD FILE 
        $file      = $_FILES['pdf']['name'];
        $x_file    = explode('.', $file);
        $ext_file  = end($x_file);
        $pdf = rand(1, 99999) . '.' . $ext_file;
        $size_file = $_FILES['pdf']['size'];
        $tmp_file  = $_FILES['pdf']['tmp_name'];
        $dir_file  = '../../file/pdf/';
        $allow_ext        = array('pdf', 'PDF');
        $allow_size       = 5097152;
        // var_dump($pdf); die();

        if (in_array($ext_file, $allow_ext) === true) {
            if ($size_file <= $allow_size) {
                move_uploaded_file($tmp_file, $dir_file . $pdf);

                $f_pdf .= "Upload Success";
            } else {
                echo "
                <script type='text/javascript'>
                    setTimeout(function () {    
                        swal({
                            title: '',
                            text:  'Ukuran File Terlalu Besar, Maksimal 5 Mb',
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
        $pdf = $_POST['pdf'];
        $f_pdf .= "Upload Success!";
    }

    if (!empty($f_cover && $f_pdf)) {

        $tambah = $con->query("INSERT INTO ebook VALUES (
            default, 
            '$judul', 
            '$penulis', 
            '$penerbit',
            '$tahun',
            '$id_kategori',
            '$cover',
            '$pdf',
            '$tgl_posting'
        )");

        if ($tambah) {
            $_SESSION['pesan'] = "Data Berhasil di Simpan";
            echo "<meta http-equiv='refresh' content='0; url=index'>";
        } else {
            echo "Data anda gagal disimpan. Ulangi sekali lagi";
            echo "<meta http-equiv='refresh' content='0; url=tambah'>";
        }
    }
}


?>