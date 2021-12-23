<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="card text-dark bg-light center position-absolute top-50 start-50 translate-middle" style="width: 50rem;">
        <div class=" card-body">
            <h2 class="my-3 text-center">Reset Password</h2>
            <?php if (session()->getFlashdata('success')) { ?>
                <div class="alert alert-success">
                    <?php echo session()->getFlashdata('success'); ?>
                </div>
            <?php } ?>

            <?php if (session()->getFlashdata('error')) { ?>
                <div class="alert alert-danger">
                    <?php echo session()->getFlashdata('error'); ?>
                </div>
            <?php } ?>
            <form action="/auth/updatepassword/<?= $akun['id']; ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <div class=" form-group row my-3">
                    <label class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" placeholder="Enter your new password">
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>