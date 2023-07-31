<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;

class SubCategoryController extends BaseController
{
  public $categoryModel;
  public $subcategoryModel;

  
  public function __construct()
  {
    helper('form');
    $this->categoryModel = new CategoryModel();
    $this->subcategoryModel = new SubCategoryModel();
  }
  public function index()
  {
    $categories = $this->categoryModel->findAll();

    return view('admin/subcategory/subcategories', ["categories" => $categories]);
  }

  public function createsubCategories()
  {
    $subcatid = $this->request->getVar('subcatid');
    $name = $this->request->getVar('name');
    $catid = $this->request->getVar('catid');
    $data = [
      'name' => $name,
      'category_id' => $catid
    ];
    if ($subcatid != '') {
      if ($this->subcategoryModel->update($subcatid, $data)) {

        return $this->response->setJSON(['status' => true, 'message' => "Subcategory update Successfully"]);
      }
    } else {
      if ($this->subcategoryModel->insert($data)) {

        return $this->response->setJSON(['status' => true, 'message' => "Subcategory insert Successfully"]);
      }
    }
  }

  public function getSubCategories()
  {

    $page = $this->request->getVar('page') ?? 1;

    $all = [
      "total" => $this->subcategoryModel->countAll(),
      "subcategories" => $this->subcategoryModel->orderBy('id', 'desc')->paginate(10, 'default', $page),
      "pager" => $this->subcategoryModel->pager->links()
    ];

    return $this->response->setJSON($all);
  }

  public function deletesubCategories()
  {

    $id = $this->request->getVar('id');

    if ($this->subcategoryModel->where('id', $id)->delete()) {

      return $this->response->setJSON(['status' => true, "message" => "Delete  Successfull"]);
    }
  }
}
