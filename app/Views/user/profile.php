<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="card" style="width: 35rem;">
        <img src="/img/<?= session()->get('photo') ?>" class="card-img-top" alt="..." width="300" height="300">
        <div class="card-body">
            <h5 class="card-title">About me</h5>
            <div class="row g-0">
                <div class="col-sm-6 col-md-4">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Name</li>
                        <li class="list-group-item">Email</li>
                    </ul>
                </div>
                <div class="col-6 col-md-8">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><?= $name ?></li>
                        <li class="list-group-item"><?= $email ?></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection(); ?>