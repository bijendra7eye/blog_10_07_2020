<?php


namespace App\Http\Controllers;

use App\Blog;
use App\BlogToCategory;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator, Redirect, Response;
Use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthController extends Controller
{

    public function index()
    {
        return view('login');
    }

    public function registration()
    {
        return view('registration');
    }

    public function postLogin(Request $request)
    {
        request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }
        return Redirect::to("login")->withErrors('Oops! You have entered invalid credentials');
    }

    public function postRegistration(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();

        $check = $this->create($data);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }
        return Redirect::to("login");
    }

    public function dashboard()
    {

        if (Auth::check()) {
            return view('user.dashboard');
        }
        return Redirect::to("login")->withErrors('Oops! You do not have access');
    }

    public function blog()
    {

        if (Auth::check()) {
            $blogs = Blog::where(['is_active' => 1])->with('creator')->orderBy('id', 'desc')->take(10)->get();
            $categories = Category::get();
            return view('user.blog', compact('blogs', 'categories'));
        }
        return Redirect::to("login")->withErrors('Oops! You do not have access');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }

    public function get_blogs()
    {
        $start_date = Carbon::parse(\request('start_date'))->format('Y-m-d 00:00:00');
        $end_date = Carbon::parse(\request('end_date'))->format('Y-m-d 23:59:59');
        $blogs = Blog::whereBetween('created_at', [$start_date, $end_date])->orderBy('id', 'desc')->get();
        return view('user.blog_list', compact('blogs'));

    }

    public function create_blog()
    {
        $user = Auth::user();
        $categories = Category::get();
        return view('user.create_new_blog', compact('user', 'categories'));
    }

    public function save_blogs()
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('assets/images'), $imageName);
        $blog = new Blog();
        $blog->image = "assets/images/$imageName";
        $blog->title = request('title');
        $blog->description = request('description');
        $blog->created_by = Auth::id();
        $blog->save();

        foreach (\request('categories') as $cid) {
            $BlogToCategory = new BlogToCategory();
            $BlogToCategory->blog_id = $blog->id;
            $BlogToCategory->category_id = $cid;
            $BlogToCategory->save();
        }

        return Redirect::to("blog")->withSuccess('Great! Blog has been uploaded');
    }
}
