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
}