<?php

namespace App\Http\Services;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Validator;

class UserService
{
    public function getUserByID(Request $request)
    {

    }
    public function getUser()
    {
        return response()->json(auth()->user());
    }
    public function getAllUser()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function getUsersByRole(string $role = 'User')
    {
        try {
            $users = User::fetchByRole($role)->withCount('userEnrollDetails')->paginate(10);

            return $users;
        } catch (\Exception $e) {
            error_log("[User Service Err]: " . $e->getMessage());
        }
    }

    public function updateUser(Request $request, User $user)
    {
        try {
            if ($request['password'])
            {
                $request['password'] = Hash::make($request['password']);
            }

            $user->fill($request->toArray())->save();

        } catch (\Exception $e) {
            error_log("[User Service Err]: " . $e->getMessage());
            throw $e;
        }
    }

    public function editUser(Request $request)
    {
        // Dapatkan ID pengguna dari token yang saat ini terotentikasi

        $userId = auth()->user()->id;

        // Validasi inputan
        $validator = Validator::make($request->toArray(),[
            'fullname' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'sometimes|required|string|min:8', // Karena password opsional
        ]);
        if ($validator->passes()) {
            $existingUser = User::where('email', request('email'))->first();
            if ($existingUser && $existingUser->id != $userId) {
                $validator->errors()->add('email', 'The email has already been taken.');
            }
        }

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        // Temukan pengguna berdasarkan ID
        if(!User::findOrFail($userId)){
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }
        $user = User::findOrFail($userId);

        // Ubah data pengguna
        $user->fullname = request('fullname');
        $user->email = request('email');

        // Jika password disertakan, ubah password
        if (request(filled('password'))) {
            $user->password = Hash::make(request('password'));
        }

        // Simpan perubahan
        $user->save();

        return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
    }

}
