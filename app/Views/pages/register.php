<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="card text-dark bg-light center position-absolute top-50 start-50 translate-middle" style="width: 50rem;">
        <div class=" card-body">
            <h2 class="my-3 text-center">Register</h2>
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
            <form action="/auth/save" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group row my-3">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control
                        <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" id="name">
                        <div class="invalid-feedback">
                            <?= $validation->getError('name'); ?>
                        </div>
                    </div>
                </div>
                <div class=" form-group row my-3">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control
                        <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email">
                        <div class="invalid-feedback">
                            <?= $validation->getError('email'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row my-3">
                    <label class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control
                        <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password">
                        <div class="invalid-feedback">
                            <?= $validation->getError('password'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row my-3">
                    <label class="col-sm-2 col-form-label">Picture</label>
                    <div class="col-sm-10">
                        <input type="file" name="photo" class="form-control  
                        <?= ($validation->hasError('photo')) ? 'is-invalid' : ''; ?>" id="photo">
                        <div class="invalid-feedback">
                            <?= $validation->getError('photo'); ?>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
                <div class="text-center mb-3 mt-3">
                    <a href="/auth/">Back to login</a>
                </div>
            </form>
        </div>
    </div>

</div>
</div>

<?= $this->endSection(); ?>