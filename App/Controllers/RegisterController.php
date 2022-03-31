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

   /**
    * Submit Data for creating new user
    *
    * @return string | json
    */
    public function submit()
    {
        $json = [];
        if ($this->isValid()) {
            $this->load->model('Users')->create();
            $json['success'] = 'User Has Been Created Successfully';
            $json['redirectTo'] = $this->url->link('/');
        } else {
            $json['errors'] = $this->validator->flattenMessages();
        }

        return $this->json($json);
    }
}