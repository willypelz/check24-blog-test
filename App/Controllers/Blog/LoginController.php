<?php

namespace App\Controllers\Blog;

use System\Controller;

class LoginController extends Controller
{
    /**
    * Show Login Form Method
    *
    * @return mixed
    */
    public function index()
    {
        $this->blogLayout->title('Login');

        $loginModel = $this->load->model('Login');
        $this->blogLayout->disable('sidebar');
        if ($loginModel->isLogged()) {
            return $this->url->redirectTo('/');
        }
        $data['errors'] = $this->errors;
        $view = $this->view->render('blog/users/login', $data);
        return $this->blogLayout->render($view);
    }

    /**
    * Submit Login form
    *
    * @return mixed
    */
    public function submit()
    {
        if ($this->isValid()) {
            $loginModel = $this->load->model('Login');

            $loggedInUser = $loginModel->user();
            if ($this->request->post('remember')) {
                $this->cookie->set('login', $loggedInUser->code);
            } else {
                $this->session->set('login', $loggedInUser->code);
            }

            $json = [];
            $json['success']  = 'Welcome ' . $loggedInUser->first_name;
            $json['redirectTo'] = $this->url->link('/');
            return $this->json($json);
        } else {
            $json = [];
            $json['errors'] = implode('<br>', $this->errors);
            return $this->json($json);
        }
    }

    /**
    * Validate Login Form
    *
    * @return bool
    */
    private function isValid()
    {
        $email = $this->request->post('email');
        $password = $this->request->post('password');
        if (! $email) {
            $this->errors[] = 'Email cannot be empty';
        } elseif (! filter_var($email , FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'Email is not valid';
        }
        if (! $password) {
            $this->errors[] = 'Password field cannot be empty';
        }
        if (! $this->errors) {
            $loginModel = $this->load->model('Login');
            if (! $loginModel->isValidLogin($email, $password)) {
                $this->errors[] = 'Invalid Login Credentials';
            }
        }
        return empty($this->errors);
    }
}