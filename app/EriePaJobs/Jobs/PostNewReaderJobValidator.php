<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 7/21/15
 * Time: 8:28 PM
 */

namespace EriePaJobs\Jobs;

use EriePaJobs\BaseValidator;

class PostNewReaderJobValidator extends BaseValidator {

    public static $post_validation_rules = [
        'title' => 'required|min:5|max:50',
        'description' => 'required',
    ];

    function __construct(array $input)
    {
        $this->input = $input;
    }

    public function execute()
    {
        $result = parent::validate($this->input, static::$post_validation_rules);
        return $result;
    }

}