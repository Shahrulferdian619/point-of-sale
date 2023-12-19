<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{ (request()->is('/')) ? 'active':'' }}">
              <i class="fas fa-tachometer-alt"></i>
              <p style="margin-left: 5%" >Dashboard</p>
            </a>
          </li>

          <li class="nav-header">MASTER</li>

          <li class="nav-item">
            <a href="{{ route('master.kategori-index') }}" class="nav-link {{ (request()->is('master/kategori*')) ? 'active':'' }}">
              <i class="fas fa-box"></i>
              <p style="margin-left: 5%" >Kategori</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('master.produk-index') }}" class="nav-link {{ (request()->is('master/produk*')) ? 'active':'' }}">
              <i class="fas fa-boxes"></i>
              <p style="margin-left: 5%" >Produk</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('master.supplier-index') }}" class="nav-link {{ (request()->is('master/supplier*')) ? 'active':'' }}">
              <i class="fas fa-user-tag"></i>
              <p style="margin-left: 5%" >Supplier</p>
            </a>
          </li>

          <li class="nav-header">TRANSAKSI</li>

          <li class="nav-item">
            <a href="{{ route('transaksi.pengeluaran-index') }}" class="nav-link {{ (request()->is('transaksi/pengeluaran*')) ? 'active':'' }}">
              <i class="fas fa-money-bill-alt"></i>
              <p style="margin-left: 5%" >Pengeluaran</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('transaksi.pembelian-index') }}" class="nav-link {{ (request()->is('transaksi/pembelian*')) ? 'active':'' }}">
              <i class="fas fa-truck"></i>
              <p style="margin-left: 5%" >Pembelian</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('transaksi.penjualan-create') }}" class="nav-link {{ (request()->is('transaksi/penjualan*')) ? 'active':'' }}">
              <i class="fas fa-desktop"></i>
              <p style="margin-left: 5%" >Penjualan</p>
            </a>
          </li>

          <li class="nav-header">REPORT</li>

          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="fas fa-file-pdf"></i>
              <p style="margin-left: 5%" >Laporan</p>
            </a>
          </li>

          <li class="nav-header">SYSTEM</li>

          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="fas fa-users"></i>
              <p style="margin-left: 5%" >User</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="fas fa-users-cog"></i>
              <p style="margin-left: 5%" >Pengaturan</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>