<?php

namespace App\Controllers\Blog;

use System\Controller;

class RegisterController extends Controller
{
     /**
     * Display Registration Page
     *
     * @return mixed
     */
    public function index()
    {
        $this->blogLayout->title('Create New Account');
        $view = $this->view->render('blog/users/register');
        $this->blogLayout->disable('sidebar');

        return $this->blogLayout->render($view);
    }
}