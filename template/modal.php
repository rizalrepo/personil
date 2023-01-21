<div class="modal fade" id="lap_personil">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Laporan Data Personil</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" target="_blank" action="<?= base_url('admin/personil/cetak') ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Berdasarkan Pangkat</label>
                                <select name="id_pangkat" class="form-control select2" style="width: 100%;">
                                    <option value="">-- Pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM pangkat ORDER BY id_pangkat ASC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_pangkat'] ?>"><?= $row['nm_pangkat'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Berdasarkan Jabatan</label>
                                <select name="id_jabatan" class="form-control select2" style="width: 100%;">
                                    <option value="">-- Pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM jabatan ORDER BY id_jabatan ASC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_jabatan'] ?>"><?= $row['nm_jabatan'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" name="cetak" class="btn bg-teal btn-block"><i class="fa fa-print"> </i> Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="lap_cuti">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Laporan Data Cuti</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" target="_blank" action="<?= base_url('admin/cuti/cetak') ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Berdasarkan Tanggal Surat Cuti</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><i>Dari Tanggal</i></label>
                                            <input type="date" class="form-control" name="tgl1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><i>Sampai Tanggal</i></label>
                                            <input type="date" class="form-control" name="tgl2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" name="cetak" class="btn bg-teal btn-block"><i class="fa fa-print"> </i> Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="lap_mutasi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Laporan Data Mutasi</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" target="_blank" action="<?= base_url('admin/mutasi/cetak') ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Dari Tanggal</label>
                                <input type="date" class="form-control" name="tgl1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sampai Tanggal</label>
                                <input type="date" class="form-control" name="tgl2">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" name="cetak" class="btn bg-teal btn-block"><i class="fa fa-print"></i> Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="lap_tugas">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Laporan Data Perintah Tugas</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" target="_blank" action="<?= base_url('admin/tugas/cetak') ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Berdasarkan Tanggal Surat Perintah Tugas</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><i>Dari Tanggal</i></label>
                                            <input type="date" class="form-control" name="tgl1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><i>Sampai Tanggal</i></label>
                                            <input type="date" class="form-control" name="tgl2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" name="cetak" class="btn bg-teal btn-block"><i class="fa fa-print"> </i> Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="lap_kegiatan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Laporan Data Kegiatan</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" target="_blank" action="<?= base_url('admin/kegiatan/cetak') ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Berdasarkan Tanggal Mulai Kegiatan</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><i>Dari Tanggal</i></label>
                                            <input type="date" class="form-control" name="tgl1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><i>Sampai Tanggal</i></label>
                                            <input type="date" class="form-control" name="tgl2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Berdasarkan Jenis Kegiatan</label>
                                <select name="id_jenis_kegiatan" class="form-control select2" style="width: 100%;">
                                    <option value="">-- Pilih --</option>
                                    <?php $data = $con->query("SELECT * FROM jenis_kegiatan ORDER BY id_jenis_kegiatan ASC"); ?>
                                    <?php foreach ($data as $row) : ?>
                                        <option value="<?= $row['id_jenis_kegiatan'] ?>"><?= $row['nm_jenis_kegiatan'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" name="cetak" class="btn bg-teal btn-block"><i class="fa fa-print"> </i> Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>