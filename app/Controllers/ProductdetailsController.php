<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProductdetailsController extends BaseController
{
    public function productdetails()
    {
        return view('client/productdetails');
    }
}
