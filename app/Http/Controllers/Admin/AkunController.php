<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AkunController extends Controller
{
    public $user;

    public function __construct()
    {
        parent::__construct();
        // for detail user
        $this->user = User::find($this->session->id);
    }

    public function index()
    {
        $data = [
            'user' => $this->user,
        ];

        return Template::load('admin', 'Akun', 'akun', 'view', $data);
    }

    public function save_picture(Request $request)
    {
        try {
            // hapus foto
            del_picture($this->user->foto, 'akun/');

            // nama foto
            $nama_foto = add_picture($request->foto, 'akun/');

            $this->user->foto = $nama_foto;
            $this->user->save();

            $response = ['title' => 'Berhasil!', 'text' => 'Foto Profil Sukses di Ubah!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Foto Profil Gagal di Ubah!', 'type' => 'error', 'button' => 'Ok!', 'class' => 'danger'];
        }

        return Response::json($response);
    }

    public function save_account(Request $request)
    {
        $rules = [
            'name'     => 'required',
            'email'    => 'required',
            'username' => 'required',
        ];

        $messages = [
            'name.required'     => 'Nama harus diisi!',
            'email.required'    => 'Email harus diisi!',
            'username.required' => 'Username harus diisi!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $response = ['title'  => 'Gagal!', 'text'   => 'Data gagal diubah!', 'type'   => 'error', 'button' => 'Okay!', 'class'  => 'danger', 'errors' => $validator->errors()];

            return Response::json($response);
        }

        try {
            $this->user->name     = $request->name;
            $this->user->email    = $request->email;
            $this->user->username = $request->username;
            $this->user->save();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Ubah!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Ubah!', 'type' => 'error', 'button' => 'Ok!', 'class' => 'danger'];
        }

        return Response::json($response);
    }

    public function save_security(Request $request)
    {
        $rules = [
            'password_old'          => 'required',
            'password'              => 'required',
            'password_confirmation' => 'required|same:password',
        ];

        $messages = [
            'password_old.required'          => 'Password lama harus diisi!',
            'password.required'              => 'Password baru harus diisi!',
            'password_confirmation.required' => 'Konfirmasi password baru harus diisi!',
            'password_confirmation.same'     => 'Konfirmasi password baru tidak sama!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $response = ['title'  => 'Gagal!', 'text'   => 'Data gagal diubah!', 'type'   => 'error', 'button' => 'Okay!', 'class'  => 'danger', 'errors' => $validator->errors()];

            return Response::json($response);
        }

        if (Hash::check($request->password_old, $this->user->password)) {
            try {
                $this->user->password = Hash::make($request->password);
                $this->user->save();

                $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Ubah!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success'];
            } catch (\Exception $e) {
                $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Ubah!', 'type' => 'error', 'button' => 'Ok!', 'class' => 'danger'];
            }
        } else {
            $response = ['title' => 'Gagal!', 'text' => 'Password lama yang Anda masukkan tidak sama!', 'type' => 'warning', 'button' => 'Ok!', 'class' => 'warning'];
        }

        return Response::json($response);
    }
}
