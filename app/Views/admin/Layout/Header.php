<header class="app-header fixed-top bg-white shadow-sm">
    <div class="app-header-inner">
        <div class="container-fluid py-2">
            <div class="app-header-content">
                <div class="d-flex justify-content-between align-items-center">

                    <!-- Sidepanel Toggler -->
                    <div class="col-auto">
                        <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img">
                                <title>Menu</title>
                                <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                            </svg>
                        </a>
                    </div>

                    <!-- Welcome Message -->
                    

                    <!-- User Profile and Dropdown -->
                    <div class="col-auto d-flex align-items-center">
                        <div class="dropdown">
                            <a class="dropdown-toggle profile-pic d-flex align-items-center" 
                               data-bs-toggle="dropdown" href="#" aria-expanded="false">
                               <p class="mb-0" style="font-size: larger;">
                            Selamat datang, <?= session()->get('username'); ?>
                        </p>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <li class="dropdown-user-scroll scrollbar-outer">
                                    
                                    <a class="dropdown-item" href="<?= base_url('logout'); ?>">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div> <!-- End of Flex Container -->
            </div>
        </div>
    </div>

    <?= $this->include('admin/layout/navbar'); ?>
</header>
<br>
<br>
<br>
<br>