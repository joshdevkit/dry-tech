<?php

use App\Class\Database;

$title = "Admin Dashboard";
$pagetitle = "Dashboard";
include('partials/header.php');

$db = Database::getInstance();

$stmt = $db->conn()->prepare('SELECT COUNT(*) AS total_projects FROM projects ');
$stmt->execute();
$total_projects = $stmt->fetchColumn();


$stmt = $db->conn()->prepare('SELECT COUNT(*) AS total_inquiries FROM contact_messages ');
$stmt->execute();
$total_inquiries = $stmt->fetchColumn();


$stmt = $db->conn()->prepare('SELECT COUNT(*) AS total_ongoing FROM projects WHERE status = "On-Going" ');
$stmt->execute();
$total_ongoing = $stmt->fetchColumn();


$stmt = $db->conn()->prepare('SELECT COUNT(*) AS total_completed FROM projects WHERE status = "Completed" ');
$stmt->execute();
$total_completed = $stmt->fetchColumn();

?>

<?php include('partials/topbar.php'); ?>

<div class="tab-content">
    <div class="tab-pane fade show active" id="dashboard">
        <div class="row">
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title text-muted">Total Projects</h6>
                                <h3 class="mb-0"><?= $total_projects ?></h3>
                            </div>
                            <div class="icon text-primary">
                                <i class="fas fa-city fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title text-muted">Client Inquiries</h6>
                                <h3 class="mb-0"><?= $total_inquiries ?></h3>
                            </div>
                            <div class="icon text-warning">
                                <i class="fas fa-question-circle fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title text-muted">Ongoing Projects</h6>
                                <h3 class="mb-0"><?= $total_ongoing ?></h3>
                            </div>
                            <div class="icon text-info">
                                <i class="fas fa-hard-hat fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title text-muted">Completed Projects</h6>
                                <h3 class="mb-0"><?= $total_completed ?></h3>
                            </div>
                            <div class="icon text-success">
                                <i class="fas fa-check-circle fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php include('partials/footer.php'); ?>