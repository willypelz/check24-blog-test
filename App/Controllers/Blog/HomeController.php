<?php

namespace App\Controllers\Blog;

use System\Controller;

class HomeController extends Controller
{
     /**
     * Display Home Page
     *
     * @return mixed
     */
    public function index()
    {
        $data['posts'] = $this->load->model('Posts')->latest();

        $this->html->setTitle($this->settings->get('site_name'));

        $postController = $this->load->controller('Blog/Post');

        $data['post_box'] = function ($post) use ($postController) {
            return $postController->box($post);
        };

        $view = $this->view->render('blog/home', $data);

        return $this->blogLayout->render($view);
    }
}