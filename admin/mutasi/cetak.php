<?php
include '../../app/config.php';

$no = 1;

if (isset($_POST['cetak'])) {

    $tgl1 = $_POST['tgl1'];
    $cektgl1 = isset($tgl1);
    $tgl2 = $_POST['tgl2'];
    $cektgl2 = isset($tgl2);
    if ($tgl1 == $cektgl1 && $tgl2 == $cektgl2) {

        $sql = mysqli_query($con, "SELECT * FROM mutasi a JOIN personil b ON a.id_personil = b.id_personil JOIN pangkat c ON b.id_pangkat = c.id_pangkat JOIN jabatan d ON b.id_jabatan = d.id_jabatan WHERE a.tanggal BETWEEN '$tgl1' AND '$tgl2' ORDER BY tanggal ASC");

        $label = 'LAPORAN MUTASI JABATAN PERSONIL <br> Tanggal Mutasi : ' . tgl($tgl1) . ' s/d ' . tgl($tgl2);
    } else {
        $sql = mysqli_query($con, "SELECT * FROM mutasi a JOIN personil b ON a.id_personil = b.id_personil JOIN pangkat c ON b.id_pangkat = c.id_pangkat JOIN jabatan d ON b.id_jabatan = d.id_jabatan ORDER BY tanggal DESC");
        $label = 'LAPORAN MUTASI JABATAN PERSONIL';
    }
}

require_once '../../assets/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [380, 215]]);
ob_start();
?>

<script type="text/javascript">
    window.print();
</script>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Mutasi Jabatan Personil</title>
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
                    <img src="<?= base_url('assets/images/logo.png') ?>" align="left" height="100">
                </td>
                <td align="center">
                    <h4>KEPOLISIAN NEGARA REPUBLIK INDONESIA</h4>
                    <h2>DAERAH KALIMANTAN SELATAN SEKOLAH POLISI NEGARA</h2>
                    <h6>Jl. Ir. P. M. Noor, Guntung Paikat, Kec. Banjarbaru Selatan, Kota Banjar Baru, Kalimantan Selatan Kodepos 70714</h6>
                </td>
                <td align="center">
                    <img src="<?= base_url('assets/images/pelengkap.png') ?>" align="right" height="100">
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
                            <th>Nama</th>
                            <th>NRP / NIP</th>
                            <th>Pangkat</th>
                            <th>Mutasi ke Jabatan</th>
                            <th>Jabatan Sebelumnya</th>
                            <th>Tanggal Mutasi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($data = mysqli_fetch_array($sql)) { ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?></td>
                                <td><?= $data['nm_personil'] ?></td>
                                <td align="center"><?= $data['nrp_nip'] ?></td>
                                <td align="center"><?= $data['nm_pangkat'] ?></td>
                                <td align="center"><?= $data['nm_jabatan'] ?></td>
                                <td align="center">
                                    <?php $d = $con->query("SELECT * FROM jabatan WHERE id_jabatan = '$data[id_jabatan_lama]' ")->fetch_array(); ?>
                                    <?= $d['nm_jabatan'] ?>
                                </td>
                                <td align="center"><?= tgl($data['tanggal']) ?></td>
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