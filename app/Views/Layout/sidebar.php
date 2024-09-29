<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item <?= ($main_menu_active == 'dashboard') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= base_url('/'); ?>">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li
            class="nav-item <?= ($main_menu_active == 'data_produk' || $main_menu_active == 'data_bahan') ? 'active' : ''; ?>">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Master Data</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse <?= ($main_menu_active == 'data_produk' || $main_menu_active == 'data_bahan' || $main_menu_active == 'supplier') ? 'show' : ''; ?>"
                id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a
                            class="nav-link <?= ($main_menu_active == 'data_produk') ? 'active' : ''; ?>"
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
        <li class="nav-item <?= ($main_menu_active == 'users') ? 'active' : ''; ?>">
            <a class="nav-link <?= ($main_menu_active == 'users') ? 'active' : ''; ?>" href="<?= base_url('Users'); ?>">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Users</span>
            </a>
        </li>
    </ul>
</nav>