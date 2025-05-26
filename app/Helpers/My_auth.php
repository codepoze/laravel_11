<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

if (!function_exists('is_valid_user')) {
    function is_valid_user($id_users, $password)
    {
        $check = User::find($id_users);
        if ($check) {
            $check_pass = is_valid_password($password, $check->password);
            if ($check_pass) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

if (!function_exists('is_valid_password')) {
    function is_valid_password($pass_input, $pass_get)
    {
        if (Hash::check($pass_input, $pass_get)) {
            return true;
        } else {
            return false;
        }
    }
}
