<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Session;
use App\Models\User;
use Hash;
  
class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        if(Auth::check()){
            $users = User::all();
            return view('dashboard', ["users" => $users]);
        }
        return view('Auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('Auth.registration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:6',
        ]);
   
        $credentials["name"] = base64_encode($request->input("name"));
        $credentials["password"] = $request->input("password");

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }
  
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'mobile' => 'required|unique:users',
            'password' => 'required|min:6',
            'birthDate' => 'required',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            $users = User::all();
            return view('dashboard', ["users" => $users]);
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => base64_encode($data['name']),
        'mobile' => base64_encode($data['mobile']),
        'password' => Hash::make($data['password']),
        'birthday' => base64_encode($data['birthDate']),
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }

    public function fetch_user(Request $request)
    {
        $id = $request->input("name");
        $user = User::where("name", $id)->get();

        $user[0]["name"] = base64_decode($user[0]["name"]);
        $user[0]["mobile"] = base64_decode($user[0]["mobile"]);
        $user[0]["birthday"] = base64_decode($user[0]["birthday"]);
        
        return view('fetch_user', ["users" => $user]);
    }
}