<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
      <img src="{{asset('sahl.jpeg')}}" alt="" style="width: 90%;">
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item {{ active_class(['/']) }}">
        <a href="{{ url('/') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Beranda</span>
        </a>
      </li>
      <li class="nav-item nav-category">Menu</li>
      <li class="nav-item {{ active_class(['input/*']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#input" role="button" aria-expanded="{{ is_active_route(['asset', 'utang', 'modal', 'transaksi']) }}" aria-controls="input">
          <i class="link-icon" data-feather="plus-square"></i>
          <span class="link-title">Input</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['input/*']) }}" id="input">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/asset') }}" class="nav-link {{ active_class(['asset']) }}">Asset</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/utang') }}" class="nav-link {{ active_class(['utang']) }}">Utang</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/modal') }}" class="nav-link {{ active_class(['modal']) }}">Modal</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/transaksi') }}" class="nav-link {{ active_class(['transaksi']) }}">Transaksi</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ active_class(['jurnal-umum*']) }}">
        <a href="{{ url('/jurnal-umum') }}" class="nav-link">
          <i class="link-icon" data-feather="file-text"></i>
          <span class="link-title">Jurnal Umum</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['buku-besar*']) }}">
        <a href="{{ url('buku-besar') }}" class="nav-link">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Buku Besar</span>
        </a>
        <li class="nav-item {{ active_class(['neraca-saldo*']) }}">
          <a href="{{ url('/neraca_saldo') }}" class="nav-link">
            <i class="link-icon" data-feather="dollar-sign"></i>
            <span class="link-title">Neraca Saldo</span>
          </a>
        </li>
      </li>
      <li class="nav-item {{ active_class(['neraca-saldo*']) }}">
        <a href="{{ url('/neraca_awal') }}" class="nav-link">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Laporan Neraca</span>
        </a>
      </li>
    </ul>
  </div>
</nav>