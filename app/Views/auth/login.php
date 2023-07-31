<?= $this->extend("layouts/layout") ?>

<?= $this->section("content") ?>


<div class="container mt-5 mb-5">
    <div class="row align-items-center">
        <div class="col-md-5">

            <?= form_open('form') ?>
            <div class="container-form" id="login">
                <h1 className="text-center">Login</h1>

                <div class="mb-3">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" value="<?= set_value('name') ?>">
                </div>
                <div class="mb-3">
                    <label for="name">Password:</label>
                    <input type="password" name="password" class="form-control" value="<?= set_value('password') ?>">
                </div>
                <br>
                <br>

                <button type="submit" class="btn btn-success">Submit</button>
            </div>
            <?= form_close() ?>

        </div>


        <div class="col-md-5 offset-md-2">
            <img class="img-fluid" src="<?= base_url('assets/images/l.svg') ?>" alt="">
        </div>
    </div>
</div>










<?= $this->endSection() ?>