<div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-menu-trigger">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em
                    class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em
                    class="icon ni ni-menu"></em></a>
        </div>
        <div class="nk-sidebar-brand">
            <a href="/" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{ asset('images/nifandatama.png') }}" alt="logo">
            </a>
        </div>
    </div>
    <div class="nk-sidebar-element nk-sidebar-body">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    @if(auth()->user()->role == 'admin')
                    <li class="nk-menu-item">
                        <a href="/user" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                            <span class="nk-menu-text">User</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="/customer" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-user-list-fill"></em></span>
                            <span class="nk-menu-text">Pelanggan</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="/supplier" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-user-fill-c"></em></span>
                            <span class="nk-menu-text">Pemasok</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="/material" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-box"></em></span>
                            <span class="nk-menu-text">Bahan Baku</span>
                        </a>
                    </li>
                    <li class="nk-menu-item {{ (Request::is('type') or Request::is('type/*')) ? 'active current-page' : '' }}">
                        <a href="{{ route('type.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-layers"></em></span>
                            <span class="nk-menu-text">Jenis Bahan Baku</span>
                        </a>
                    </li>
                    @endif
                    @if(auth()->user()->role != 'customer')
                    <li class="nk-menu-item {{ (Request::is('product') or Request::is('product/*')) ? 'active current-page' : '' }}">
                        <a href="{{ route('product.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-package"></em></span>
                            <span class="nk-menu-text">Produk</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="/supply" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-bag"></em></span>
                            <span class="nk-menu-text">Suplai</span>
                        </a>
                    </li>
                    @endif
                    <li class="nk-menu-item">
                        <a href="/preorder" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-coins"></em></span>
                            <span class="nk-menu-text">Preorder</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
