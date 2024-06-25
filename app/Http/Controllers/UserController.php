<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\CourseService;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Request as FacadesRequest;


class UserController extends Controller
{
    private $UserService;
    public function __construct()
    {
        $this->UserService = new UserService;
    }

    public function editUser(Request $request){
        return $this->UserService->editUser($request);
    }

    public function getUser()
    {
        return $this->UserService->getUser();
    }
    public function getAllUser()
    {
        return $this->UserService->getAllUser();
    }

    public function profile()
    {
        return view('pages.client.user.profile');
    }

    public function update(Request $request, User $user)
    {
        $request->validate($this->rules(), $this->messages());

        try {
            $this->UserService->updateUser($request, $user);

            return redirect()->route('user.profile')->with('success', "Successfully update your profile");
        } catch(\Exception $e) {
            error_log("EXCEPTION: " . $e->getMessage());
            return redirect()->route('user.profile')->with('failed', "Failed to update your profile");
        }
    }

    private function rules()
    {
        return [
            'fullname' => 'required|min:4|max:40',
            'email' => 'required|email',
            'password' => 'min:6',
            'photo_profile' => 'mime:.jpg,png,jpeg|file'
        ];
    }

    private function messages()
    {
        return [
            'fullname.required' => 'Full name is required.',
            'fullname.min' => 'Full name must be at least 4 characters.',
            'fullname.max' => 'Full name may not be greater than 40 characters.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'password.min' => 'Password must be at least 6 characters.',
            'photo_profile.mimes' => 'Profile photo must be a file of type: jpg, png, jpeg.',
            'photo_profile.file' => 'Profile photo must be a valid file.'
        ];
    }
}
