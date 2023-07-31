<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class CategoryController extends BaseController
{
    public $model;
    
    public function __construct()
    {
        helper('form');
        $this->model = new CategoryModel();
    }
    public function index()
    {
        return view('admin/category/categories');
    }

    public function getCategories(){

        $page = $this->request->getVar('page') ?? 1;

        $all = [
            "total" => $this->model->countAll(),
            "categories" => $this->model->orderBy('id', 'desc')->paginate(10, 'default', $page),
            "pager" => $this->model->pager->links()
        ];

        return $this->response->setJSON($all);
    }

    public function createCategories(){
        $name = $this->request->getPost("catname");
        $image = $this->request->getFile("image");

        if ( $image->isValid() && !$image->hasMoved()) {
            $newName =   $image->getRandomName();
            $image->move('assets/images/categories/', $newName);

        } 
        $data = [
            "name" => $name,
            'image' => base_url('assets/images/categories/' . $newName)
        ];
        if($this->model->insert($data)){
            return $this->response->setJSON(['status' => true,"message" => "Category Insert Successfull"]);
          }
      
    }

    public function deleteCategories(){

        $id = $this->request->getVar('id');
        if ($this->model->where('id', $id)->delete()) {
            
            return $this->response->setJSON(['status' => true,"message" => "Delete  Successfull"]);
        }
    }
        
}
