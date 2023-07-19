<div class="nk-header nk-header-fixed is-light">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger d-xl-none ms-n1">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em
                        class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand d-xl-none">
                <a href="html/index.html" class="logo-link">
                    <img class="logo-light logo-img" src="{{ asset('images/nifandatama.png') }}" alt="logo">
                </a>
            </div>
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar sm">
                                    <span>
                                        {{ substr(auth()->user()->employee?->name,0,2) }}
                                        {{ substr(auth()->user()->customer?->company_name,0,2) }}
                                    </span>
                                </div>
                                <div class="user-info d-none d-md-block">
                                    <div class="user-status">{{ ucfirst(auth()->user()->role) }}</div>
                                    <div class="user-name dropdown-indicator">
                                        {{ auth()->user()->employee?->name }}
                                        {{ auth()->user()->customer?->company_name }}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar">
                                        <span>
                                            {{ substr(auth()->user()->employee?->name,0,2) }}
                                            {{ substr(auth()->user()->customer?->company_name,0,2) }}
                                        </span>
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">
                                            {{ auth()->user()->employee?->name }}
                                            {{ auth()->user()->customer?->company_name }}
                                        </span>
                                        <span class="sub-text">{{ auth()->user()->email }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <form action="/logout" method="post">
                                        @csrf 
                                        @method('POST')
                                            <button type="submit" class="border-0 bg-white"><em class="icon ni ni-signout"></em><span>Sign out</span></button>
                                        </form>
                                    </li>                                    
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
