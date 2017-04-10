<?php

namespace App\Http\Controllers\Admin;

use App\Responsitory\Business;
use App\Responsitory\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    private $news;
    private $business;
    function __construct()
    {
        $this->business = new Business();
        $this->news     = new News();
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
            $news = News::latest()->paginate(5);
            return view('admin.pages.news.list', compact('news'));
        } else {
            $news = $this->news->search($query,'title','summary',5);
            return view('admin.pages.news.list', compact('news','query'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),$this->news->rule());
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->all();
        $img = $this->business->saveImg($request->file('img'), 'upload/img_news');
        $data['img'] = $img;
        $is_public = $request->has('is_public') ? 1 : 0;
        $data['is_public'] = $is_public;
        $this->news->create($data);
        return redirect()->route('news.index')->with('success', 'Thêm bài post thành công');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = $this->news->show($id);
        return view('admin.pages.news.edit', compact('news'));
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
            'title' => 'max:191',
            'img' => 'max:191',
        ];
        $path = 'upload/img_news';
        $validator = Validator::make($request->all(),$rule);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $new_id             = News::find($id);
        $new_id->title      = $request->input('title');
        $new_id->summary    = $request->input('summary');
        $new_id->content    = $request->input('content');
        if($request->img != null) {
            $imgs = $this->business->saveImg($request->file('img'), $path);
            if($new_id->img != null && file_exists($path.'/'.$new_id->img)) {
                unlink($path . '/' . $new_id->img);
            }
            $new_id->img = $imgs;
        }
        $new_id->is_public = $request->has('is_public') ? 1 : 0;
        $new_id->save();
        return redirect()->route('news.index')->with('success', 'Cập nhật bài post thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $path   = 'upload/img_news';
        $new_id = News::find($id);
        if($new_id->img != null && file_exists($path.'/'.$new_id->img)) {
            unlink($path . '/' . $new_id->img);
        }
        $new_id->delete();
        return redirect()->route('news.index')->with('success', 'Xóa bài post thành công');
    }
}
