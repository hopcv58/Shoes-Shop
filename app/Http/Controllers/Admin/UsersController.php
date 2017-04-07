<?php

namespace App\Http\Controllers\Admin;

use App\Responsitory\Business;
use App\Responsitory\Customers;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    private $users;
    private $business;

    function __construct()
    {
        $this->users = new User();
        $this->business = new Business();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentUser = Auth::user();
        $query = $request->input('search');
        if($query==null){
            $users = User::paginate(5);
            return view('admin.pages.users.list',compact('users','currentUser'));
        }else{
            $users = User::where('name','like',"%$query%")->orWhere('email','like',"%$query%")->paginate(5);
            return view('admin.pages.users.list',compact('users','query','currentUser'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $validator = Validator::make($data, $this->users->rule());
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $this->users->create($data);
            return redirect()->route('users.index')->with('success','Create new user successfully');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $current_user_id = Auth::user()->id;
        $user = $this->users->findOrFail($current_user_id);
        return view('admin.pages.users.edit',compact('user'));
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
        $user = User::findOrFail($id);
        $path = 'upload/img_profile';
        $rule = [
            'name' => 'max:191',
            'email' => 'email',
            'img' => 'max:191',
            'phone' => 'max:30',
            'address' => 'max:191'
        ];
        $data = $request->all();

/*        if(key_exists('password',$data)) {
            $new_password = md5($request->input('newpassword'));
            $old_password = md5($request->input('password'));
            if ($old_password != $user->password) {
                return redirect()->back()->with('err_password', 'Incorrect password please reenter password');
            }else{
                $data['password'] = $new_password;
            }
        }else{
            unset($data['password']);
            unset($rule['newpassword']);
        }*/
        if($request->hasFile('img')){
            $img = $request->file('img');
            $data['img'] = $this->business->saveImg($img, $path);
            if($user->img != null && file_exists($path.'/'.$user->img)) {
                unlink($path . '/' . $user->img);
            }
        }
        $validator = Validator::make($data,$rule);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $user->update($data);
            return redirect()->route('admin.users.profile')->with('success',"Update profile $user->name succesfully");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('user_id');
        if($user_id = $this->users->findOrFail($id))
        {
            if(($user_id->img != null) && (file_exists("upload/img_product/$user_id->img"))){
                unlink("upload/img_product/$user_id->img");
            }
            $user_id->delete();
            return redirect()->route('users.index')->with('success', "Deleted $user_id->name");
        }else{
            return redirect()->route('users.index')->with('fail', 'User ko tồn tại');
        }
    }
}
