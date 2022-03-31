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


}