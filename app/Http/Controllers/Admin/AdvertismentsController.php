<?php

namespace App\Http\Controllers\Admin;

use App\Responsitory\Advertisments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AdvertismentsController extends Controller
{
    private $adv;

    function __construct()
    {
        $this->adv = new Advertisments();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->input('search');
        if ($query == null) {
            $advs = $this->adv->latest()->paginate(5);
            return view('admin.pages.advertisments.list', compact('advs'));
        } else {
            $advs = $this->advs->search($query, 'name', 'discount', 5);
            return view('admin.pages.advertisments.list', compact('advs', 'query'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.pages.advertisments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->adv->rule());
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $this->adv->store($request->all());
        return redirect()->route('advertisments.index')->with('success', 'Tạo quảng cáo thành công');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adv = $this->adv->show($id);
        return view('admin.pages.advertisments.edit', compact('adv'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rule = [
            'name' => 'max:191',
            'detail' => 'max:191',
            'discount' => 'numeric',
        ];

        $validator = Validator::make($request->all(), $rule);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $this->adv->show($id)->update($request->all());
        return redirect()->route('advertisments.index')->with('success',"Cập nhật sự kiện quảng cáo thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $adv = $this->adv->show($request->input('idCate'));
        $adv->delete();
        return redirect()->route('advertisments.index')->with('success', "Xóa thành công $adv->name");
    }
}
