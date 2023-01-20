<?php
require '../../app/config.php';
include_once '../../template/header.php';
include_once '../../template/sidebar.php';
include_once '../../template/footer.php';

$id = $_GET['id'];
$data  = $con->query("SELECT * FROM ebook WHERE id_ebook = '$id'")->fetch_array();
$query  = $con->query("DELETE FROM ebook WHERE id_ebook = '$id'");
if ($query) {
    $cover = $data['cover'];
    $pdf = $data['pdf'];
    if ($cover != null) {
        unlink('../../file/cover/' . $cover);
    }
    if ($pdf != null) {
        unlink('../../file/pdf/' . $pdf);
    }
    $_SESSION['pesan'] = "Data Berhasil di Hapus";
    echo "<meta http-equiv='refresh' content='0; url=index'>";
} else {
    echo "Data anda gagal dihapus. Ulangi sekali lagi";
    echo "<meta http-equiv='refresh' content='0; url=index'>";
}
