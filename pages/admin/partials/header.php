<?php

use App\Class\Session;

if (!Session::has('user_id')) {
    header('location: login');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="<?= asset('assets/css/bootstrap.css') ?>" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('assets/css/admin.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/dataTables.bootstrap4.css') ?>">
    <script src="<?= asset('assets/js/jquery.js') ?>"></script>
    <script src="<?= asset('assets/js/dataTables.js') ?>"></script>
    <script src="<?= asset('assets/js/dataTables.bootstrap4.js') ?>"></script>

</head>

<body>

    <?php include('aside.php'); ?>

    <div class="main-content" id="mainContent">