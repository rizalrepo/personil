<?php
include '../../app/config.php';

$no = 1;

if (isset($_POST['cetak'])) {

    $tgl1 = $_POST['tgl1'];
    $cektgl1 = isset($tgl1);
    $tgl2 = $_POST['tgl2'];
    $cektgl2 = isset($tgl2);
    if ($tgl1 == $cektgl1 && $tgl2 == $cektgl2) {

        $sql = mysqli_query($con, "SELECT * FROM tugas WHERE tgl_surat BETWEEN '$tgl1' AND '$tgl2' ORDER BY tgl_surat ASC");

        $label = 'LAPORAN PERINTAH TUGAS <br> Tanggal dimulai : ' . tgl($tgl1) . ' s/d ' . tgl($tgl2);
    } else {
        $sql = mysqli_query($con, "SELECT * FROM tugas ORDER BY tgl_surat DESC");
        $label = 'LAPORAN PERINTAH TUGAS';
    }
}

require_once '../../assets/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'LEGAL-L']);
ob_start();
?>

<script type="text/javascript">
    window.print();
</script>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Perintah Tugas</title>
</head>

<style>
    th {
        color: white;
    }
</style>

<body>
    <div class="table-responsive">
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td align="center">
                    <img src="<?= base_url('assets/images/logo.png') ?>" align="left" height="75">
                </td>
                <td align="center">
                    <h4>KEPOLISIAN NEGARA REPUBLIK INDONESIA</h4>
                    <h2>DAERAH KALIMANTAN SELATAN SEKOLAH POLISI NEGARA</h2>
                    <h6>Jl. Ir. P. M. Noor, Guntung Paikat, Kec. Banjarbaru Selatan, Kota Banjar Baru, Kalimantan Selatan Kodepos 70714</h6>
                </td>
                <td align="center">
                    <img src="<?= base_url('assets/images/pelengkap.png') ?>" align="right" height="75">
                </td>
            </tr>
        </table>
    </div>
    <hr size="2px" color="black">

    <h4 align="center">
        <?= $label ?><br>
    </h4>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <table border="1" cellspacing="0" cellpadding="6" width="100%">
                    <thead>
                        <tr bgcolor="#20C997" align="center">
                            <th>No</th>
                            <th>Nomor Surat</th>
                            <th>Tanggal Surat</th>
                            <th>Agenda</th>
                            <th>Tanggal</th>
                            <th>Lama Tugas</th>
                            <th>Tempat/Lokasi</th>
                            <th>Yang Bertugas</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($data = mysqli_fetch_array($sql)) {
                            $tgl1 = $data['tgl_mulai'];
                            $tgl2 = date('Y-m-d', strtotime('-1 days', strtotime($tgl1)));
                            $a = date_create($tgl2);
                            $b = date_create($data['tgl_selesai']);
                            $diff = date_diff($a, $b);
                        ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?></td>
                                <td align="center"><?= $data['no_surat'] ?></td>
                                <td align="center"><?= tgl($data['tgl_surat']) ?></td>
                                <td><?= $data['agenda'] ?></td>
                                <td align="center">
                                    <?php if ($data['tgl_mulai'] == $data['tgl_selesai']) {
                                        echo tgl($data['tgl_mulai']);
                                    } else {
                                        echo tgl($data['tgl_mulai']) . ' s/d ' . tgl($data['tgl_selesai']);
                                    } ?>
                                </td>
                                <td align="center"><?= $diff->d . ' Hari' ?></td>
                                <td align="center"><?= $data['tempat'] ?></td>
                                <td>
                                    <?php
                                    $d = $con->query("SELECT * FROM tugas_detail td JOIN personil p ON p.id_personil = td.id_personil WHERE td.id_tugas = '$data[id_tugas]' ");
                                    while ($row = $d->fetch_array()) {
                                        echo ' - ' . $row['nm_personil'] . '| NRP/NIK ' . $row['nrp_nip'] . '<br>';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>

            </div>
        </div>
    </div>
    <br>
    <br>

    <br>
    <div class="table-responsive">
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td align="center" width="80%">
                </td>
                <td align="center">
                    <h6>
                        Banjarbaru, <?= tgl(date('Y-m-d')) ?><br>
                        KA SPN POLDA KALIMANTAN SELATAN
                        <br><br><br><br><br><br><br>
                        RESTIKA P. NAINGGOLAN, S.I.K
                        <hr style="margin-top: 0; margin-bottom: 0;">
                        KOMISARIS BESAR POLISI NRP 76030830
                    </h6>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output();
?>