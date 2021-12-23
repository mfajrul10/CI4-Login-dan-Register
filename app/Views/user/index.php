<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<?php
$session = session();
?>

<body class="text-center">
    <div class="container mt-3">
        <div class="p-5 mb-4 bg-info rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Welcome to the dashboard </h1>
                <h3><?= $session->get('name'); ?></h3>
            </div>
        </div>
    </div>
</body>


<?= $this->endSection(); ?>