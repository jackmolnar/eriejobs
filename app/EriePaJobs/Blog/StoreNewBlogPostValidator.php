<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 3/31/15
 * Time: 10:50 PM
 */

namespace EriePaJobs\Blog;

use EriePaJobs\BaseValidator;

class StoreNewBlogPostValidator extends BaseValidator{

    public static $post_validation_rules = [
        'title' => 'required',
        'body' => 'required',
        'image' => 'max:3000, image',
        'slug' => 'required'
    ];

    protected $input;

    function __construct(Array $input)
    {
        $this->input = $input;
    }

    public function execute()
    {
        $result = parent::validate($this->input, static::$post_validation_rules);
        return $result;
    }
}