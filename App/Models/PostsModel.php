<?php

namespace App\Models;

use System\Model;

class PostsModel extends Model
{
     /**
     * Table name
     *
     * @var string
     */
    protected $table = 'posts';

    /**
    * Get All Posts
    *
    * @return array
    */
    public function all()
    {
        return $this->select('p.*',  'u.first_name', 'u.last_name')
                    ->from('posts p')
                    ->join('LEFT JOIN users u ON p.user_id=u.id')
                    ->fetchAll();
    }

     /**
     * Get Post With its comments
     *
     * @param int $id
     * @return mixed
     */
    public function getPostWithComments($id)
    {
        $post = $this->select('p.*','u.first_name', 'u.last_name', 'u.image AS userImage')
                     ->from('posts p')
                     ->join('LEFT JOIN users u ON p.user_id=u.id')
                     ->where('p.id=? AND p.status=?', $id, 'enabled')
                     ->fetch();

        if (! $post) return null;
        $post->comments = $this->select('c.*', 'u.first_name', 'u.last_name', 'u.image AS userImage')
                               ->from('comments c')
                               ->join('LEFT JOIN users u ON c.user_id=u.id')
                               ->where('c.post_id=?', $id)
                               ->fetchAll();

        return $post;
    }

     /**
     * Get Latest Posts
     *
     * @return array
     */
    public function latest()
    {
        return $this->select('p.*', 'u.first_name', 'u.last_name')
                    ->select('(SELECT COUNT(co.id) FROM comments co WHERE co.post_id=p.id) AS total_comments')
                    ->from('posts p')
                    ->join('LEFT JOIN users u ON p.user_id=u.id')
                    ->where('p.status=?', 'enabled')
                    ->orderBy('p.id', 'DESC')
                    ->fetchAll();
    }

     /**
     * Create New Post
     *
     * @return void
     */
    public function create()
    {
        $image = $this->uploadImage();

        if ($image) {
            $this->data('image', $image);
        }

        $user = $this->load->model('Login')->user();

        $this->data('title', $this->request->post('title'))
             ->data('details', $this->request->post('details'))
             ->data('user_id', $user->id)
             ->data('tags', $this->request->post('tags'))
             ->data('status', $this->request->post('status'))
             ->data('created', $now = time())
             ->insert('posts');
    }

     /**
     * Upload Post Image
     *
     * @return string
     */
     private function uploadImage()
     {
         $image = $this->request->file('image');

         if (! $image->exists()) {
             return '';
         }

         return $image->moveTo($this->app->file->toPublic('images'));
     }

     /**
     * Update Posts Record By Id
     *
     * @param int $id
     * @return void
     */
    public function update($id)
    {
        $image = $this->uploadImage();

        if ($image) {
            $this->data('image', $image);
        }

        $this->data('title', $this->request->post('title'))
             ->data('details', $this->request->post('details'))
             ->data('tags', $this->request->post('tags'))
             ->data('status', $this->request->post('status'))
             ->where('id=?' , $id)
             ->update('posts');
    }

     /**
     * Add New Comment to the given post
     *
     * @param int $postId
     * @param string $comment
     * @param int $userId
     * @return void
     */
    public function addNewComment($id, $comment, $userId)
    {
        $this->data('post_id', $id)
             ->data('comment', $comment)
             ->data('status', 'enabled')
             ->data('created', time())
             ->data('user_id', $userId)
             ->insert('comments');
    }
}