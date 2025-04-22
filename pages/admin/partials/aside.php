<?php
$auth = \App\Class\Session::auth();
$currentUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$currentUri = explode('/', $currentUri)[1] ?? 'home';
?>

<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h4 class="text-white m-0">Admin Panel</h4>
    </div>

    <div class="flex-grow-1 d-flex flex-column mt-2">
        <div class="text-center mb-3">
            <div class="avatar mx-auto" style="width: 80px; height: 80px; font-size: 24px; margin-top: 12px;">
                <?= strtoupper(substr($auth['name'], 0, 1)) ?>
            </div>
            <h6 class="text-white mt-2 mb-0"><?= $auth['name'] ?></h6>
        </div>

        <hr class="border-secondary mx-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/dashboard" class="nav-link <?= $currentUri === 'dashboard' ? 'active' : '' ?>">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/projects" class="nav-link <?= $currentUri === 'projects' ? 'active' : '' ?>">
                    <i class="fas fa-building"></i> Projects
                </a>
            </li>

            <li class="nav-item">
                <a href="<?= BASE_URL ?>/inquiries" class="nav-link <?= $currentUri === 'inquiries' ? 'active' : '' ?>">
                    <i class="fas fa-message"></i> Inquiries
                </a>
            </li>

        </ul>
        <hr class="border-secondary mx-3">

        <div class="mt-auto px-4 pb-3">
            <form action="logout" method="POST" onsubmit="return confirm('Are you sure you want to logout?');">
                <button type="submit" class="btn btn-danger w-100">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </div>

    </div>
</div>