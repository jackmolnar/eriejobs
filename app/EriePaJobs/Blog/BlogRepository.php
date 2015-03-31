<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 3/28/15
 * Time: 10:38 AM
 */

namespace EriePaJobs\Blog;
use Post;

class BlogRepository {


    /**
     * Get all posts
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function allPosts()
    {
        return $allPosts = Post::all();
    }

    /**
     * Get post by id or by slug
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection|null|static
     */
    public function getPost($id)
    {
        if(is_numeric($id))
        {
            return $post = Post::find($id);
        } else {
            return $post = Post::where('slug', '=', $id)->first();
        }
    }
}