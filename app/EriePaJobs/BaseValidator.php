<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 10/21/14
 * Time: 10:01 PM
 */

namespace EriePaJobs;

use Illuminate\Support\Facades\Validator;

abstract class BaseValidator implements JBValidatorInterface {

    /**
     * Base validate function
     *
     * @param $input
     * @param $rules
     * @param array $messages
     * @return array
     */
    public function validate($input, $rules, $messages = [])
    {
        $validator = Validator::make($input, $rules, $messages);

        $response = array();

        if($validator->fails()){
            $response['status'] = false;
            $response['errors'] = $validator->messages();
            return $response;
        } else {
            $response['status'] = true;
            return $response;
        }
    }
}