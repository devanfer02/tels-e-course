<?php

namespace App\Http\Services;
use App\Models\User;
use App\Models\Role;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{

    public function login(Request $request, string $mode = "api")
    {
        $validator = Validator::make(request()->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $validator->setCustomMessages([
            'email.required' => 'Email address is required',
            'email.email' => 'Email must be a valid email address',
            'password.required' => 'Passowrd is required'
        ]);

        if ($validator->fails()){
            if ($mode == "api") {
                return response()->json([
                    'message' => 'Email atau password invalid'
                ]);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }



        if ($mode != "api") {
            $credentials = $request->only('email', 'password');

            if (Auth::guard('web')->attempt($credentials)) {
                return redirect()->route('home');
            } else {
                return redirect()->back()->with('failed', 'Invalid email or password');
            }

        }

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email atau password salah'
            ]);
        }

        $token = $user->createToken('auth-token')->plainTextToken;
        return response()->json(['token' => $token]);
    }

    public function register(Request $request, string $mode)
    {
        $validator = Validator::make($request->toArray(),[
            'fullname'  => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required',
        ]);

        $validator->setCustomMessages([
            'email.email'     => 'Email must be a valid email address',
            'email.unique:users'     => 'Email is already in use',
        ]);

        if ($validator->fails()) {
            if ($mode == "api") {
                return response()->json($validator->messages());
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }
        $roleId = Role::where('role_name', '=', 'User')->get()[0]['id'];
        $user = User::create([
            'id'        => Uuid::uuid7(),
            'fullname'  => request('fullname'),
            'email'     => request('email'),
            'password'  => Hash::make(request('password')),
            'role_id'   => $roleId
        ]);

        if ($mode == "api") {
            if ($user) {
                return response()->json(['message'=> 'Pendaftaran berhasil']);
            }else{
                return response()->json(['message'=> 'Pendaftaran gagal']);
            }
        }

        return redirect()->route('guest.login');
    }

    public function adminLogin(Request $request)
    {
        Validator::make(request()->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::guard('web')->attempt($credentials)) {
            return redirect('dashboard');
        } else {
            return redirect('/auth/login')->with('failed', 'Email atau password salah');
        }
    }

    public function adminLogout()
    {
        Auth::guard('web')->logout();

        return redirect('/auth/login');
    }

    public function webLogout(Request $request)
    {
        Auth::guard('web')->logout();

        return redirect('/');
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout successful'], 200);
    }

}
