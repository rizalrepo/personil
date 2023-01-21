<?php

include '../../../app/config.php';

$tugas    = $_POST['id_tugas'];
$personil   = $_POST['id_personil'];

$tambah = $con->query("INSERT INTO tugas_detail VALUES (
        default,
        '$tugas', 
        '$personil'
    )");

if ($tambah) {
    $data['hasil'] = 'sukses';
} else {

    $data['hasil'] = 'gagal';
}

echo json_encode($data);
