<?= $this->extend('layouts/layout.php'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <h1>Product Details</h1>

    <div class="single-products shadow-lg border p-3 rounded text-center">
        <div class="single-img-box">
            <img src="" alt="" />
        </div>
        <div class="product-content">
            <h3>Product Title</h3>
            <p>Price</p>
        </div>
        <button>Add to Cart</button>
    </div>

    <hr />
</div>



<?= $this->endSection() ?>