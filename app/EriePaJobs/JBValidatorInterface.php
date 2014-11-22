<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 10/21/14
 * Time: 9:43 PM
 */

namespace EriePaJobs;


interface JBValidatorInterface {

    function __construct( array $input);

    function validate( $input, $rules );

    function execute();

} 