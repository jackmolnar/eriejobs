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
     * @var array
     */
    private $input;
    /**
     * @var array
     */
    private $rules;



    public function validate($input, $rules){

        $validator = Validator::make($input, $rules);

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