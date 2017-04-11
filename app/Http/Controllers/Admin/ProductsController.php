<?php

namespace App\Http\Controllers\Admin;

use App\Responsitory\Advertisments;
use App\Responsitory\Business;
use App\Responsitory\Categories;
use App\Responsitory\productcate;
use App\Responsitory\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    private $_products;
    private $business;

    function __construct()
    {
        $this->_products = new Products();
        $this->business = new Business();
    }

    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $soluong = $this->business->adminGetProductQuantity();
        $query = $request->input('search');
        if ($query == null) {
            $products = $this->_products->latest()->paginate(5);
            return view('admin.pages.products.list', compact('products', 'soluong'));
        } else {
            $products = $this->_products->search($query, 'name', 'code', 5);
            return view('admin.pages.products.list', compact('products', 'query', 'soluong'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cates = Categories::select('id', 'name')->get();
        $advers = Advertisments::select('id', 'name')->get();
        return view('admin.pages.products.create', compact('cates', 'advers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $path = 'upload/img_product';
        $img_profile = $request->file('img_profile');
        if ($img_profile == null) {
            return redirect()->back()->with('not_img', 'Phải chọn ảnh đại diện')->withInput();
        }
        $img_pro = $this->business->saveImg($img_profile, $path);
//        $this->_products->img_profile = $img_pro;
        //bien anh mo ta
        $attributes = [
            'size' => $request->input('size'),
            'color' => $request->input('color'),
            'qty' => $request->input('qty'),
        ];
        $is_public = $request->input('is_public') ? 1 : 0;
        $json_att = json_encode($attributes);
        $rule_att = [
            'color' => 'max:191',
            'qty' => 'max:191',
        ];

        $data = [
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'height' => $request->input('height'),
            'material' => $request->input('material'),
            'alias' => $request->input('alias'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'phoi_do' => $request->input('phoi_do'),
            'ad_id' => $request->input('ad_id'),
            'img_profile' => $img_pro,
            'attribute' => $json_att,
            'is_public' => $is_public,
        ];

        //validate
        $validator = Validator::make($data, $this->_products->rule());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $att_validator = Validator::make($attributes, $rule_att);
        if ($att_validator->fails()) {
            return redirect()->back()->withErrors($att_validator)->withInput();
        }
        $cates = $request->input('cate_id');
        if ($cates == null) {
            return redirect()->back()->with('cate_err', 'Phải chọn loại sản phẩm')->withInput();
        }

        $names = $this->business->saveManyImg($request->file('img'), $path);
        $imgs = json_encode($names);

        $data = array_merge($data, ['img' => $imgs]);
        if ($this->business->adminCreateProduct($data, $cates)) {
            return redirect()->route('products.index')->with('success', "Thêm thành công sản phẩm {$data['name']}");
        } else {
            return redirect()->route('products.index')->with('fail', "Thêm thất bại");
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.pages.products.edit', $this->business->adminGetProductAttribute($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $path = 'upload/img_product';
        //bien anh mo ta
        $attributes = [
            'size' => $request->input('size'),
            'color' => $request->input('color'),
            'qty' => $request->input('qty'),
        ];
        $is_public = $request->input('is_public') ? 1 : 0;
        $json_att = json_encode($attributes);
        $rule_att = [
            'color' => 'max:191',
            'qty' => 'max:191',
        ];

        $data = [
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'alias' => $request->input('alias'),
            'description' => $request->input('description'),
            'height' => $request->input('height'),
            'material' => $request->input('material'),
            'price' => $request->input('price'),
            'phoi_do' => $request->input('phoi_do'),
            'ad_id' => $request->input('ad_id'),
            'attribute' => $json_att,
            'is_public' => $is_public,
        ];

        $img_profile = $request->file('img_profile');
        if ($img_profile != null) {
            $img_pro = $this->business->saveImg($img_profile, $path);
            $data = array_merge($data,['img_profile' => $img_pro]);
        }

        //validate
        $validator = Validator::make($data, $this->_products->ruleUpdate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $att_validator = Validator::make($attributes, $rule_att);
        if ($att_validator->fails()) {
            return redirect()->back()->withErrors($att_validator)->withInput();
        }
        $cates = $request->input('cate_id');
        if ($cates == null) {
            return redirect()->back()->with('cate_err', 'Phải chọn loại sản phẩm')->withInput();
        }
        productcate::where('product_id',$id)->delete();
        $products = Products::findOrFail($id);
        $products->name                 = $data['name'];
        $products->code                 = $data['code'];
        $products->alias                = $data['alias'];
        $products->description          = $data['description'];
        $products->height               = $data['height'];
        $products->material             = $data['material'];
        $products->phoi_do              = $data['phoi_do'];
        $products->ad_id                = $data['ad_id'];
        $products->price                = $data['price'];
        $products->attribute            = $data['attribute'];
        if(key_exists('img_profile',$data)) {
            if(($products->img_profile != null) && file_exists($path . "/$products->img_profile")){
                unlink($path . "/$products->img_profile");
            }
            $products->img_profile = $data['img_profile'];
        }
        $products->is_public = $data['is_public'];
        foreach ($cates as $cate){
            $products->productCate()->create(["cate_id" => $cate]);
        }

        if($request->hasFile('img')) {
            $names = $this->business->saveManyImg($request->file('img'), $path);
            $imgs = json_encode($names);
            $data = array_merge($data, ['img' => $imgs]);
            $products->img = $data['img'];
            if ($this->business->adminGetProductAttribute($id)['arr_img'] != null) {
                $imgs_old = $this->business->adminGetProductAttribute($id)['arr_img'];
                foreach ($imgs_old as $img){
                    if (($img != null) && (file_exists("upload/img_product/$img"))) {
                        unlink("upload/img_product/$img");
                    }
                }
            }
        }
        if ($products->save()) {
            return redirect()->route('products.index')->with('success', "Đã chỉnh sửa sản phẩm {$data['name']}");
        } else {
            return redirect()->route('products.index')->with('fail', "Chỉnh sửa thất bại");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('product_id');
        $product = $this->_products->findOrFail($id);
        if (($product->img_profile != null) && (file_exists("upload/img_product/$product->img_profile"))) {
            unlink("upload/img_product/$product->img_profile");
        }

        if ($this->business->adminGetProductAttribute($id)['arr_img'] != null) {
            $imgs = $this->business->adminGetProductAttribute($id)['arr_img'];
            foreach ($imgs as $img){
                if (($img != null) && (file_exists("upload/img_product/$img"))) {
                    unlink("upload/img_product/$img");
                }
            }
        }
        $product->delete();
        return redirect()->back()->with('success', "Delete $product->name successfully");
    }
}
