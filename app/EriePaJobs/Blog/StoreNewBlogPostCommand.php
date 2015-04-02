<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 3/31/15
 * Time: 10:48 PM
 */

namespace EriePaJobs\Blog;

use EriePaJobs\BaseCommand;
use Post;

class StoreNewBlogPostCommand extends BaseCommand {

    /**
     * @var
     */
    private $input;

    function __construct($input)
    {
        $this->input = $input;
        $this->blogRepo = new BlogRepository;
    }

    public function execute()
    {
        $image = $this->blogRepo->processImage($this->input['image']);
        $thumb_image = $this->blogRepo->processThumbImage($this->input['image']);

        $path = $this->blogRepo->saveImage($image);
        $this->blogRepo->saveThumbImage($thumb_image);

        $blogPost = Post::create([
            'title' => $this->input['title'],
            'body' => $this->input['body'],
            'slug' => $this->input['slug'],
            'image' => $path
        ]);

        return $blogPost;
    }
}