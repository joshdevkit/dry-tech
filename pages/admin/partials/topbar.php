<div class="topbar">
    <div>
        <button class="btn d-md-none" id="showSidebar">
            <i class="fas fa-bars"></i>
        </button>
        <span class="h4 ms-2 mb-0 d-none d-sm-inline"><?= $pagetitle ?></span>
    </div>
    <div class="d-flex align-items-center">
        <div class="dropdown">
            <button class="btn d-flex align-items-center dropdown-profile" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="avatar me-2"> <?= strtoupper(substr($auth['name'], 0, 1)) ?></div>
                <span class="d-none d-md-block"><?= $auth['name'] ?></span>
                <i class="fas fa-chevron-down ms-1"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
            </ul>
        </div>
    </div>
</div>