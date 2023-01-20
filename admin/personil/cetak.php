<?php
include '../../app/config.php';

$no = 1;

if (isset($_POST['cetak'])) {

    $id_pangkat = $_POST['id_pangkat'];
    $cekid_pangkat = isset($id_pangkat);
    $id_jabatan = $_POST['id_jabatan'];
    $cekid_jabatan = isset($id_jabatan);
    if ($id_pangkat == $cekid_pangkat && $id_jabatan == null) {

        $sql = mysqli_query($con, "SELECT * FROM personil a JOIN pangkat b ON a.id_pangkat = b.id_pangkat JOIN jabatan c ON a.id_jabatan = c.id_jabatan WHERE a.id_pangkat = '$id_pangkat' ORDER BY id_personil DESC ");

        $dt = $con->query("SELECT * FROM pangkat WHERE id_pangkat = '$id_pangkat'")->fetch_array();
        $label = 'LAPORAN PERSONIL <br> Pangkat : ' . $dt['nm_pangkat'];
    } else if ($id_pangkat == null && $id_jabatan == $cekid_jabatan) {

        $sql = mysqli_query($con, "SELECT * FROM personil a JOIN pangkat b ON a.id_pangkat = b.id_pangkat JOIN jabatan c ON a.id_jabatan = c.id_jabatan WHERE a.id_jabatan = '$id_jabatan' ORDER BY id_personil DESC ");

        $dt = $con->query("SELECT * FROM jabatan WHERE id_jabatan = '$id_jabatan'")->fetch_array();
        $label = 'LAPORAN PERSONIL <br> Jabatan : ' . $dt['nm_jabatan'];
    } else if ($id_jabatan == $cekid_jabatan && $id_pangkat == $cekid_pangkat) {

        $sql = mysqli_query($con, "SELECT * FROM personil a JOIN pangkat b ON a.id_pangkat = b.id_pangkat JOIN jabatan c ON a.id_jabatan = c.id_jabatan WHERE a.id_jabatan = '$id_jabatan' AND a.id_pangkat = '$id_pangkat' ORDER BY id_personil DESC ");

        $dt1 = $con->query("SELECT * FROM pangkat WHERE id_pangkat = '$id_pangkat'")->fetch_array();
        $dt2 = $con->query("SELECT * FROM jabatan WHERE id_jabatan = '$id_jabatan'")->fetch_array();
        $label = 'LAPORAN PERSONIL <br> Pangkat : ' . $dt1['nm_pangkat'] . '<br> Jabatan : ' . $dt2['nm_jabatan'];
    } else {
        $sql = mysqli_query($con, "SELECT * FROM personil a JOIN pangkat b ON a.id_pangkat = b.id_pangkat JOIN jabatan c ON a.id_jabatan = c.id_jabatan ORDER BY id_personil DESC");
        $label = 'LAPORAN PERSONIL';
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
    <title>Laporan Personil</title>
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
                        <tr bgcolor="#007BFF" align="center">
                            <th>No</th>
                            <th>Data Personil</th>
                            <th>TTL</th>
                            <th>Usia</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Alamat</th>
                            <th>No. HP</th>
                            <th>TMT</th>
                            <th>Masa Bakti</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($data = mysqli_fetch_array($sql)) {
                            $today = new DateTime('today');
                            $tgl = new DateTime($data['tgl_lahir']);
                            $y = $today->diff($tgl)->y;

                            $tmt = new DateTime($data['tmt']);
                            $ytmt = $today->diff($tmt)->y;
                        ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?></td>
                                <td>
                                    <b>Nama</b> : <?= $data['nm_personil'] ?>
                                    <hr style="margin-top: 3px; margin-bottom: 3px;">
                                    <b>NRP / NIP</b> : <?= $data['nrp_nip'] ?>
                                    <hr style="margin-top: 3px; margin-bottom: 3px;">
                                    <b>Pangkat</b> : <?= $data['nm_pangkat'] ?>
                                    <hr style="margin-top: 3px; margin-bottom: 3px;">
                                    <b>Jabatan</b> : <?= $data['nm_jabatan'] ?>
                                </td>
                                <td align="center" width="20%"><?= $data['tmpt_lahir'] . ', ' . tgl($data['tgl_lahir']) ?></td>
                                <td align=" center"><?= $y . ' Tahun' ?></td>
                                <td align="center"><?= $data['jk'] ?></td>
                                <td align="center"><?= $data['agama'] ?></td>
                                <td><?= $data['alamat'] ?></td>
                                <td align="center"><?= $data['hp'] ?></td>
                                <td align="center"><?= tgl($data['tmt']) ?></td>
                                <td align="center"><?= $ytmt . ' Tahun' ?></td>
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