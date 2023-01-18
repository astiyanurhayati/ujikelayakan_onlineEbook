<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Exports\UserExport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function dashboard(){

        $categories = Category::all();
        $books = Book::all();

        $booktop = Book::orderBy('download', 'DESC')->get();
        if (Auth::user()->role == 'admin') { // Role Guru
            return view('dashboard.index', compact('categories', 'books'));
        } elseif (Auth::user()->role == 'user') { // Role Murid
            return view('page.userdashboard.index', compact('categories', 'booktop'));
        } 
    }

    public function userindex(Request $request){

        // dd($request->keyword);
        $keyword = $request->keyword;

        $users = User::where('name', 'LIKE', '%'.$keyword.'%')
                        ->orWhere('email', 'LIKE', '%'.$keyword.'%' )
                        ->orWhere('phone', 'LIKE', '%'.$keyword.'%')
                        ->orWhere('address', 'LIKE', '%'.$keyword.'%')
                    ->paginate(4);

        return view('dashboard.user.index', compact('users'));
    }
   
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'address' => 'required',
            'phone' => 'required',
            'password' => 'required'

        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'password' =>  Hash::make($request->password),
            'date' => Carbon::now()
        ]);

        return redirect('/login')->with('success', 'Register successfully, please login');
    }

    public function destroy($id){
        $user = User::where('id', $id)->first();
        $user->delete();
        return back()->with('successdelete', 'successfully deleted the user');
    }

    public function login(){
        return view('auth.login');
    }

    public function loginAuth(Request $request){
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ]
     );

     $user = $request->only('email', 'password');

        if(Auth::attempt($user)){
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->with('error', "gagal login, silahkan cek dan coba lagi!");
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    public function userexport(){
        return Excel::download(new UserExport, 'users.xlsx');
    }

    public function cetakpdf(){
        $users = User::all();
        return view('dashboard.user.cetakpdf', compact('users'));
    }


}
