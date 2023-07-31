<?= $this->extend('layouts/layout.php') ?>

<?= $this->section('content'); ?>

<div id="carouselExample" class="carousel slide">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= base_url('assets/images/b1.jpg') ?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="<?= base_url('assets/images/b2.jpg') ?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="<?= base_url('assets/images/b3.jpg') ?>" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<br>
<br>





<h1>Products</h1>
<hr>
<br>
<br>

<div class="container">
    <div class="row">
        <div class="col-lg-3 d-flex justify-content-strech">
            <div class="single-products shadow-lg border text-center">
                <div class="card">
                    <div class="card-img-box">
                        <img src="<?= base_url('assets/images/p1.webp') ?>" class="card-img-top" alt="...">
                        <div class="card-icon">
                        <i class="fa-regular fa-eye"></i>
                        <i class="fa-solid fa-cart-plus"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="p-title">Q. s product</h5>
                        <p class="p-price">$39.00</p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>