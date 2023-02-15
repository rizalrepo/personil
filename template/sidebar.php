<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-teal elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?= base_url() ?>/assets/images/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text">SPN POLDA KALSEL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <div class="user-panel mt-1 mb-1 d-flex">
            <div class="info">
                <a href="#" class="d-block"><i class="fas fa-user-circle mr-1"></i><b>
                        <?= $_SESSION['nm_user'] ?>
                    </b></a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Menu</li>
                <?php if ($_SESSION['level'] == 1) { ?>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>/admin/" class="nav-link <?php if ($page == 'dashboard') {
                                                                                echo 'active';
                                                                            } ?>">
                            <i class="nav-icon fa fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview  <?php if (
                                                            $page == 'user' || $page == 'pangkat' || $page == 'jabatan' || $page == 'jenis-kegiatan'
                                                        ) {
                                                            echo 'menu-open';
                                                        } ?>">
                        <a href="#" class="nav-link <?php if (
                                                        $page == 'user' || $page == 'pangkat' || $page == 'jabatan' || $page == 'jenis-kegiatan'
                                                    ) {
                                                        echo 'active';
                                                    } ?>">
                            <i class="nav-icon fa fa-database"></i>
                            <p>
                                Data Master
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/admin/user/" class="nav-link <?php if ($page == 'user') {
                                                                                            echo 'active';
                                                                                        } ?>">
                                    <i class="fas fa-user mr-1"></i>
                                    <p>Data Pengguna</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/admin/pangkat/" class="nav-link <?php if ($page == 'pangkat') {
                                                                                                echo 'active';
                                                                                            } ?>">
                                    <i class="fas fa-award mr-1"></i>
                                    <p>Data Pangkat</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/admin/jabatan/" class="nav-link <?php if ($page == 'jabatan') {
                                                                                                echo 'active';
                                                                                            } ?>">
                                    <i class="fas fa-sitemap mr-1"></i>
                                    <p>Data Jabatan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/admin/jenis-kegiatan/" class="nav-link <?php if ($page == 'jenis-kegiatan') {
                                                                                                        echo 'active';
                                                                                                    } ?>">
                                    <i class="fas fa-layer-group mr-1"></i>
                                    <p>Data Jenis Kegiatan</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="<?= base_url() ?>/admin/personil/" class="nav-link <?php if ($page == 'personil') {
                                                                                        echo 'active';
                                                                                    } ?>">
                            <i class="nav-icon fas fa-id-badge"></i>
                            <p>
                                Data Personil
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>/admin/cuti/" class="nav-link <?php if ($page == 'cuti') {
                                                                                    echo 'active';
                                                                                } ?>">
                            <i class="nav-icon fas fa-calendar-times"></i>
                            <p>
                                Data Cuti
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>/admin/mutasi/" class="nav-link <?php if ($page == 'mutasi') {
                                                                                        echo 'active';
                                                                                    } ?>">
                            <i class="nav-icon fas fa-id-card-alt"></i>
                            <p>
                                Data Mutasi Jabatan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>/admin/tugas/" class="nav-link <?php if ($page == 'tugas') {
                                                                                        echo 'active';
                                                                                    } ?>">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>
                                Data Perintah Tugas
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>/admin/kegiatan/" class="nav-link <?php if ($page == 'kegiatan') {
                                                                                        echo 'active';
                                                                                    } ?>">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Data Kegiatan
                            </p>
                        </a>
                    </li>

                    <li class="nav-header">Laporan</li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-print"></i>
                            <p>
                                Laporan Cetak
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_personil">
                                    <p><i class="fa fa-file-alt mr-1"></i> Personil</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_cuti">
                                    <p><i class="fa fa-file-alt mr-1"></i> Cuti</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_mutasi">
                                    <p><i class="fa fa-file-alt mr-1"></i> Mutasi Jabatan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_tugas">
                                    <p><i class="fa fa-file-alt mr-1"></i> Perintah Tugas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_kegiatan">
                                    <p><i class="fa fa-file-alt mr-1"></i> Kegiatan</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                <?php } else { ?>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>/admin/" class="nav-link <?php if ($page == 'dashboard') {
                                                                                echo 'active';
                                                                            } ?>">
                            <i class="nav-icon fa fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= base_url() ?>/admin/verif-cuti/" class="nav-link <?php if ($page == 'cuti') {
                                                                                            echo 'active';
                                                                                        } ?>">
                            <i class="nav-icon fas fa-calendar-times"></i>
                            <p>
                                Data Cuti
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>/admin/verif-mutasi/" class="nav-link <?php if ($page == 'mutasi') {
                                                                                            echo 'active';
                                                                                        } ?>">
                            <i class="nav-icon fas fa-id-card-alt"></i>
                            <p>
                                Data Mutasi Jabatan
                            </p>
                        </a>
                    </li>

                    <li class="nav-header">Laporan</li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-print"></i>
                            <p>
                                Laporan Cetak
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_personil">
                                    <p><i class="fa fa-file-alt mr-1"></i> Personil</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_cuti">
                                    <p><i class="fa fa-file-alt mr-1"></i> Cuti</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_mutasi">
                                    <p><i class="fa fa-file-alt mr-1"></i> Mutasi Jabatan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_tugas">
                                    <p><i class="fa fa-file-alt mr-1"></i> Perintah Tugas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#lap_kegiatan">
                                    <p><i class="fa fa-file-alt mr-1"></i> Kegiatan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </nav>

    </div>
    <!-- /.sidebar -->
</aside>

<?php include 'modal.php'; ?>