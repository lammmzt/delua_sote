<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item <?= ($main_menu_active == 'dashboard') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= base_url('/'); ?>">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li
            class="nav-item <?= ($main_menu_active === 'data_produk' || $main_menu_active == 'data_bahan') ? 'active' : ''; ?>">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Master Data</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse <?= ($main_menu_active === 'data_produk' || $main_menu_active == 'data_bahan' || $main_menu_active == 'supplier') ? 'show' : ''; ?>"
                id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a
                            class="nav-link <?= ($main_menu_active === 'data_produk') ? 'active' : ''; ?>"
                            href="<?= base_url('Produk'); ?>">Data Produk</a></li>
                    <li class="nav-item"> <a
                            class="nav-link <?= ($main_menu_active == 'data_bahan') ? 'active' : ''; ?>"
                            href="<?= base_url('Bahan'); ?>">Data Bahan</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link <?= ($main_menu_active == 'supplier') ? 'active' : ''; ?>"
                            href="<?= base_url('Supplier'); ?>">Data Supplier </a>
                    </li>
                </ul>
            </div>

        </li>
        <li
            class="nav-item <?= ($main_menu_active == 'transaksi_masuk' || $main_menu_active == 'transaksi_keluar') ? 'active' : ''; ?>">
            <a class="nav-link" data-toggle="collapse" href="#master_trx" aria-expanded="false"
                aria-controls="master_trx">
                <!-- menu troli transaki -->
                <i class="icon-bucket menu-icon"></i>
                <span class="menu-title">Transaksi</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse <?= ($main_menu_active == 'transaksi_masuk' || $main_menu_active == 'transaksi_keluar') ? 'show' : ''; ?>"
                id="master_trx">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link <?= ($main_menu_active == 'transaksi_masuk') ? 'active' : ''; ?>"
                            href="<?= base_url('TransaksiMasuk'); ?>">Transaksi Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($main_menu_active == 'transaksi_keluar') ? 'active' : ''; ?>"
                            href="<?= base_url('TransaksiKeluar'); ?>">Transaksi Keluar</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item <?= ($main_menu_active === 'Permintaan') ? 'active' : ''; ?>">
            <a class="nav-link" data-toggle="collapse" href="#menu_produksi" aria-expanded="false"
                aria-controls="menu_produksi">
                <i class="icon-check menu-icon"></i>
                <span class="menu-title">Produksi</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse <?= ($main_menu_active === 'Permintaan') ? 'show' : ''; ?>" id="menu_produksi">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link <?= ($main_menu_active === 'Permintaan') ? 'active' : ''; ?>"
                            href="<?= base_url('Produksi/Permintaan'); ?>">Permintaan</a>
                    </li>

                </ul>
            </div>
        </li>
        <li class="nav-item <?= ($main_menu_active == 'users') ? 'active' : ''; ?>">
            <a class="nav-link <?= ($main_menu_active == 'users') ? 'active' : ''; ?>" href="<?= base_url('Users'); ?>">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Users</span>
            </a>
        </li>
    </ul>
</nav>