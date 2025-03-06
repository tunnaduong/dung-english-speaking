<?php

namespace App\Controllers;

class AuthController extends Controller
{
    public function login()
    {
        // If POST request
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate the form data
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email is invalid';
            }
            if (empty($_POST['email'])) {
                $errors['email'] = 'Email is required';
            }
            if (empty($_POST['password'])) {
                $errors['password'] = 'Password is required';
            }

            // Store errors in session and redirect
            if (!empty($errors)) {
                flashError($errors);
                // return back();
            }

            $errors = getFlash('error');
            // app_log("haha" . json_encode($errors));
            return view('auth.login', compact('errors'));
            // return back();
            // return view('auth.login', compact('errors'));
        }
        $errors = getFlash('error');
        // app_log("haha" . json_encode($errors));
        return view('auth.login', compact('errors'));
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }
}
