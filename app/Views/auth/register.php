<?= $this->extend("layouts/layout") ?>

<?= $this->section("content") ?>


<div class="container mt-5 mb-5">
    <div class="row align-items-center">

        <div class="col-md-7">

            <?= form_open(base_url('register'), ['method' => 'post']) ?>
            <div class="container-form" id="login">
                <h1 className="text-center">Registration</h1>
                <div class="mb-3">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control" value="<?= set_value('name') ?>">
                </div>
                <div class="mb-3">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" value="<?= set_value('email') ?>">
                </div>
                <div class="mb-3">
                    <label for="passwword">Password:</label>
                    <input type="password" name="password" class="form-control" value="<?= set_value('password') ?>">
                </div>
                <div class="mb-3">
                    <label for="cpassword">Confirm Password:</label>
                    <input type="password" name="cpassword" class="form-control" value="<?= set_value('cpassword') ?>">
                </div>
                <br>
                <br>

                <button type="submit" class="btn btn-success">Submit</button>
            </div>
            <?= form_close() ?>
        </div>


        <div class="col-md-5 text-right">
            <img class="img-fluid" src="<?= base_url('assets/images/r.svg') ?>" alt="">
        </div>
    </div>
</div>






<?= $this->endSection() ?>