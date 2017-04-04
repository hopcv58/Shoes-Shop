<?php

namespace App\Http\Controllers\Admin;

use App\Responsitory\Categories;
use App\Responsitory\productcate;
use App\Responsitory\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    private $cate;

    function __construct()
    {
        $this->cate = new Categories();
    }


    public function listCategories(Request $request)
    {
        $query = $request->input('search');
        if ($query == null) {
            $listcates = $this->cate->latest()->paginate(5);
            return view('admin.pages.categories.list', compact('listcates'));
        } else {
            $listcates = $this->cate->where('name', 'like', "%$query%")->orWhere('alias', 'like',
                "%$query%")->latest()->paginate(5);
            return view('admin.pages.categories.list', compact('listcates','query'));
        }
    }

    /**
     * Hien thi form nhap moi loai san pham
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCreateCateForm()
    {
        return view('admin.pages.categories.create');
    }

    /**
     * luu moi san pham
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function storeCategory(Request $request)
    {
        $validator = Validator::make($request->all(), $this->cate->rule());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $this->cate->store($request->all());
            return redirect()->route('admin.categories.list')->with(['success' => 'Create category successfully']);
        }
    }

    /**
     * hien thi form de cap nhat san pham
     * @param $id
     */
    public function showUpdateCategoryForm($id)
    {
        $cateid = $this->cate->show($id);
        return view('admin.pages.categories.edit', compact('cateid'));
    }

    /**
     * cap nhat moi san pham
     * @param Request $request
     * @param $id
     */
    public function updateCategory(Request $request, $id)
    {
        //update ca trong bang con
        $cateId = Categories::findOrFail($id);
        $name = $cateId->name;
        $data = $request->all();
        $ruleUpdate = [
            'name' => 'required|min:3|max:191',
            'alias' => 'max:191',
        ];
        //kiem tra neu check vao is_public thi them value cua is_public vao mang
        if (!$request->has('is_public')) {
            $data = array_merge($data, ['is_public' => 0]);
        }
        $validator = Validator::make($request->all(), $ruleUpdate);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $this->cate->updateId($id, $data);
            return redirect()->route('admin.categories.list')->with('success', "update $name successfully");
        }
    }

    /**
     * delete 1 categories
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    //Muốn xóa danh mục thì phải xóa sản phẩm trước
    public function deleteCategory(Request $request)
    {
        //kiem tra xem trong danh muc nay khong co san pham moi dc xoa
        $id = $request->input('idCate');
        $idCate = Categories::find($id);
        $name = $idCate->name;
        //Nếu trong danh mục có sản phẩm thì phải xóa các sản phẩm trước
        if ($idCate->productCate()->count() > 0) {
            $products = $idCate->productCate()->get();
            return redirect()->route('admin.categories.list')
                ->with(['fail' => "Need to delete all products of $name", 'products' => $products, 'id' => $id]);
        }
        if ($this->cate->destroyId($idCate)) {
            return redirect()->route('admin.categories.list')->with('success', "delete $name successfully");
        }
    }

}
