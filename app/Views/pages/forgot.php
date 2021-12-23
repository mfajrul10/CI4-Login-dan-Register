<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="card text-dark bg-light center position-absolute top-50 start-50 translate-middle" style="width: 50rem;">
        <div class=" card-body">
            <h2 class="my-3 text-center">Forgot Password</h2>
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
            <form action="/auth/sendMail" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <div class=" form-group row my-3">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control">
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Send Email</button>
                </div>
                <div class="text-center mb-3 mt-3">
                    <a href="/auth/register/">Dont have account?</a>
                    <br>
                    <a href="/auth/">Back to login</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>