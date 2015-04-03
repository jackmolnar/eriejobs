<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 4/3/15
 * Time: 10:06 AM
 */

namespace EriePaJobs\Blog;

use EriePaJobs\BaseCommand;

class EditBlogPostCommand extends BaseCommand {

    /**
     * @var
     */
    private $input;

    function __construct($input, $id)
    {
        $this->input = $input;
        $this->id = $id;
        $this->blogRepo = new BlogRepository;
    }

    public function execute()
    {
        $post = $this->blogRepo->getPost($this->id);
        $post->title = $this->input['title'];
        $post->body = $this->input['body'];
        $post->slug = $this->input['slug'];

        if(isset($this->input['image']))
        {
            $this->blogRepo->deleteImage($post->image);
            $this->blogRepo->deleteThumbImage($post->image);

            $image = $this->blogRepo->processImage($this->input['image']);
            $thumb_image = $this->blogRepo->processThumbImage($this->input['image']);

            $path = $this->blogRepo->saveImage($image);
            $this->blogRepo->saveThumbImage($thumb_image);

            $post->image = $path;
        }

        $post->save();

        return $post;
    }
}