<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'ebook';
include_once '../../template/sidebar.php';

$id = $_GET['id'];
$query = $con->query("SELECT * FROM ebook WHERE id_ebook = '$id' ");
$row = $query->fetch_array();

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><i class="fas fa-sign ml-1 mr-1"></i> Edit Data Ebook</h4>
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
                                        <input type="text" class="form-control" name="judul" value="<?= $row['judul'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Penulis</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="penulis" value="<?= $row['penulis'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Penerbit</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="penerbit" value="<?= $row['penerbit'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tahun Terbit</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="tahun" value="<?= $row['tahun'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Kategori</label>
                                    <div class="col-sm-10">
                                        <select name="id_kategori" class="form-control select2" style="width: 100%;">
                                            <?php $data = $con->query("SELECT * FROM kategori ORDER BY id_kategori ASC"); ?>
                                            <?php foreach ($data as $d) :
                                                if ($d['id_kategori'] == $row['id_kategori']) { ?>
                                                    <option value="<?= $d['id_kategori']; ?>" selected="<?= $d['id_kategori']; ?>"><?= $d['nm_kategori'] ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $d['id_kategori'] ?>"><?= $d['nm_kategori'] ?></option>
                                            <?php }
                                            endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">File Cover</label>
                                    <div class="col-sm-10">
                                        <input type="file" accept=".jpg,.JPG,.jpeg,.JPEG,.png,.PNG" class="form-control" name="cover">
                                        <label class="mt-0 mb-0" style='color: red; font-style: italic; font-size: 12px;'>* Biarkan Kosong jika File tidak di Ubah !</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">File PDF</label>
                                    <div class="col-sm-10">
                                        <input type="file" accept=".pdf,.PDF" class="form-control" name="pdf">
                                        <label class="mt-0 mb-0" style='color: red; font-style: italic; font-size: 12px;'>* Biarkan Kosong jika File tidak di Ubah !</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tanggal Posting</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="tgl_posting" value="<?= $row['tgl_posting'] ?>" required>
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
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $id_kategori = $_POST['id_kategori'];
    $tgl_posting = $_POST['tgl_posting'];

    $f_cover = "";

    if (!empty($_FILES['cover']['name'])) {
        $filelama = $row['cover'];

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
                if (file_exists($dir_file . $filelama)) {
                    unlink($dir_file . $filelama);
                }
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
                        text:  'File Harus JPG, JPEG dan PNG',
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
        $cover = $row['cover'];
        $f_cover .= "Upload Success!";
    }


    $f_pdf = "";

    if (!empty($_FILES['pdf']['name'])) {
        $filelama = $row['pdf'];

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
                if (file_exists($dir_file . $filelama)) {
                    unlink($dir_file . $filelama);
                }
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
        $pdf = $row['pdf'];
        $f_pdf .= "Upload Success!";
    }

    if (!empty($f_cover && $f_pdf)) {

        $update = $con->query("UPDATE ebook SET 
            judul = '$judul',
            penulis = '$penulis',
            penerbit = '$penerbit',
            tahun = '$tahun',
            id_kategori = '$id_kategori',
            cover = '$cover',
            pdf = '$pdf',
            tgl_posting = '$tgl_posting'
            WHERE id_ebook = '$id'
        ");

        if ($update) {
            $_SESSION['pesan'] = "Data Berhasil di Update";
            echo "<meta http-equiv='refresh' content='0; url=index'>";
        } else {
            echo "Data anda gagal diubah. Ulangi sekali lagi";
            echo "<meta http-equiv='refresh' content='0; url=edit?id=$id'>";
        }
    }
}


?>