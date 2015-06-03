<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 3/28/15
 * Time: 10:38 AM
 */

namespace EriePaJobs\Blog;
use Intervention\Image\Facades\Image;
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

    public function recentBlogPosts($number = 3)
    {
        return $recentPosts = Post::orderBy('created_at', 'desc')->take($number)->get();
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

    /**
     * Process uploaded image
     * @param $image
     * @return mixed
     */
    public function processImage( $image, $resize = true )
    {
        $image = \Image::make($image);

        // if not resize, return image
        if($resize == false) return $image;

        if($image->height() > $image->width())
        {
            $image->resize(null, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        } else {
            $image->resize(650, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        return $image;
    }

    /**
     * Process uploaded image for thumbnail
     * @param $image
     * @return mixed
     */
    public function processThumbImage($image)
    {
        $image = \Image::make($image);

        if($image->height() > $image->width())
        {
            $image->resize(null, 190, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            $image->resize(275, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        return $image;
    }

    /**
     * Save image, return image name
     * @param $image
     * @return string
     */
    public function saveImage($image)
    {
        $imagePath = \Config::get('images.path');
        $image->save($imagePath.$image->filename.'.jpg');
        return $image->filename.'.jpg';
    }

    /**
     * Save image, return image name
     * @param $image
     * @return string
     */
    public function saveThumbImage($image)
    {
        $imagePath = \Config::get('images.path');
        $image->save($imagePath.'thumb_'.$image->filename.'.jpg');
        return 'thumb_'.$image->filename.'.jpg';
    }

    /**
     * Delete main image
     * @param $image
     */
    public function deleteImage($image)
    {
        $imagePath = \Config::get('images.path');
        \File::delete($imagePath.'/'.$image);
    }

    /**
     * Delete thumbnail image
     * @param $image
     */
    public function deleteThumbImage($image)
    {
        $imagePath = \Config::get('images.path');
        $thumbImage = 'thumb_'.$image;
        \File::delete($imagePath.'/'.$thumbImage);
    }

}