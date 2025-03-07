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

            if (empty($errors)) {
                // Authenticate user
                // ...
                return redirect('/');
            }

            $errors = getFlash('error');
            return view('auth.login', compact('errors'));
        }
        $errors = getFlash('error');
        return view('auth.login', compact('errors'));
    }

    public function forgotPassword()
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

            // Store errors in session and redirect
            if (!empty($errors)) {
                flashError($errors);
            }

            if (empty($errors)) {
                // Send email to user
                // ...
                flashSuccess(['success' => 'Please, check your inbox for a password reset link.']);
                // return redirect('/forgot-password');
            }

            $success = getFlash('success');
            $errors = getFlash('error');
            return view('auth.forgot-password', compact('errors', 'success'));
        }
        $errors = getFlash('error');
        return view('auth.forgot-password');
    }

    public function resetPassword($token)
    {
        // If POST request
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate the form data
            if (empty($_POST['password'])) {
                $errors['password'] = 'Password is required';
            }
            if (empty($_POST['confirm_password'])) {
                $errors['confirm_password'] = 'Confirm password is required';
            }
            if ($_POST['password'] !== $_POST['confirm_password']) {
                $errors['confirm_password'] = 'Password and confirm password must match';
            }

            // Store errors in session and redirect
            if (!empty($errors)) {
                flashError($errors);
            }

            if (empty($errors)) {
                // Reset password
                // ...
                flashSuccess(['success' => 'Password has been reset successfully.']);
                // return redirect('/login');
            }

            $success = getFlash('success');
            $errors = getFlash('error');
            return view('auth.reset-password', compact('errors', 'success'));
        }
        $errors = getFlash('error');
        return view('auth.reset-password');
    }
}
