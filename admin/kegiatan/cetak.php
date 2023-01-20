<?php
include '../../app/config.php';

$no = 1;

if (isset($_POST['cetak'])) {

    $tgl1 = $_POST['tgl1'];
    $cektgl1 = isset($tgl1);
    $tgl2 = $_POST['tgl2'];
    $cektgl2 = isset($tgl2);
    $id_jenis_kegiatan = $_POST['id_jenis_kegiatan'];
    $cekid_jenis_kegiatan = isset($id_jenis_kegiatan);
    if ($tgl1 == $cektgl1 && $tgl2 == $cektgl2 && $id_jenis_kegiatan == null) {

        $sql = mysqli_query($con, "SELECT * FROM kegiatan a JOIN jenis_kegiatan b ON a.id_jenis_kegiatan = b.id_jenis_kegiatan WHERE a.tgl_mulai BETWEEN '$tgl1' AND '$tgl2' ORDER BY tgl_mulai ASC");

        $label = 'LAPORAN KEGIATAN <br> Tanggal Mulai Kegiatan : ' . tgl($tgl1) . ' s/d ' . tgl($tgl2);
    } else if ($tgl1 == null && $tgl2 == null && $id_jenis_kegiatan == $cekid_jenis_kegiatan) {
        $sql = mysqli_query($con, "SELECT * FROM kegiatan a JOIN jenis_kegiatan b ON a.id_jenis_kegiatan = b.id_jenis_kegiatan WHERE a.id_jenis_kegiatan = '$id_jenis_kegiatan' ORDER BY tgl_mulai DESC");
        $dt = $con->query("SELECT * FROM jenis_kegiatan WHERE id_jenis_kegiatan = '$id_jenis_kegiatan'")->fetch_array();
        $label = 'LAPORAN KEGIATAN <br> Jenis Kegiatan : ' . $dt['nm_jenis_kegiatan'];
    } else if ($tgl1 == $cektgl1 && $tgl2 == $cektgl2 && $id_jenis_kegiatan == $cekid_jenis_kegiatan) {
        $sql = mysqli_query($con, "SELECT * FROM kegiatan a JOIN jenis_kegiatan b ON a.id_jenis_kegiatan = b.id_jenis_kegiatan WHERE a.tgl_mulai BETWEEN '$tgl1' AND '$tgl2' AND a.id_jenis_kegiatan = '$id_jenis_kegiatan' ORDER BY tgl_mulai ASC");
        $dt = $con->query("SELECT * FROM jenis_kegiatan WHERE id_jenis_kegiatan = '$id_jenis_kegiatan'")->fetch_array();
        $label = 'LAPORAN KEGIATAN <br> Tanggal Mulai Kegiatan : ' . tgl($tgl1) . ' s/d ' . tgl($tgl2) . '<br> Jenis Kegiatan : ' . $dt['nm_jenis_kegiatan'];
    } else {
        $sql = mysqli_query($con, "SELECT * FROM kegiatan a JOIN jenis_kegiatan b ON a.id_jenis_kegiatan = b.id_jenis_kegiatan ORDER BY tgl_mulai DESC");
        $label = 'LAPORAN KEGIATAN';
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
    <title>Laporan Kegiatan</title>
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
                    <h4>PEMERINTAH PROVINSI KALIMANTAN SELATAN</h4>
                    <h2>DEWAN PERWAKILAN RAKYAT DAERAH</h2>
                    <h6>Jl. Lambung Mangkurat No.18, Kertak Baru Ulu, Kec. Banjarmasin Tengah, Kota Banjarmasin, Kalimantan Selatan Kodepos 70111</h6>
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
                        <tr bgcolor="#17A2B8" align="center">
                            <th>No</th>
                            <th>Nama Kegiatan</th>
                            <th>Jenis Kegiatan</th>
                            <th>Tanggal</th>
                            <th>Lama Kegiatan</th>
                            <th>Tempat</th>
                            <th>Keterangan</th>
                            <th>Status Kegiatan</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        while ($data = mysqli_fetch_array($sql)) {
                            $tgl1 = $data['tgl_mulai'];
                            $tgl2 = date('Y-m-d', strtotime('-1 days', strtotime($tgl1)));
                            $a = date_create($tgl2);
                            $b = date_create($data['tgl_selesai']);
                            $diff = date_diff($a, $b);

                            $mulai = date('Y-m-d', strtotime($data['tgl_mulai']));
                            $selesai = date('Y-m-d', strtotime($data['tgl_selesai']));

                            if ((date('Y-m-d') >= $mulai) && (date('Y-m-d') <= $selesai)) {
                                $sts = 'Sedang Dilaksanakan';
                            } else if (date('Y-m-d') < $mulai) {
                                $sts = 'Belum Dilaksanakan';
                            } else if (date('Y-m-d') > $selesai) {
                                $sts = 'Telah Dilaksanakan';
                            }
                        ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?></td>
                                <td><?= $data['nm_kegiatan'] ?></td>
                                <td align="center"><?= $data['nm_jenis_kegiatan'] ?></td>
                                <td align="center">
                                    <?php if ($data['tgl_mulai'] == $data['tgl_selesai']) { ?>
                                        <?= tgl($data['tgl_mulai']) ?>
                                    <?php } else { ?>
                                        <?= tgl($data['tgl_mulai']) . ' s/d ' . tgl($data['tgl_selesai']) ?>
                                    <?php } ?>
                                </td>
                                <td align="center"><?= $diff->d . ' Hari' ?></td>
                                <td align="center"><?= $data['tempat'] ?></td>
                                <td><?= $data['ket'] ?></td>
                                <td align="center"><?= $sts ?></td>
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
                <td align="center" width="85%">
                </td>
                <td align="center">
                    <h6>
                        <?= tgl_indo(date('Y-m-d')) ?><br>
                        Banjarmasin <br>
                        <br><br><br><br>
                        <u>Kabag. Humas DPRD KALSEL</u><br>
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