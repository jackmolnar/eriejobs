<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 10/17/14
 * Time: 11:24 PM
 */

namespace EriePaJobs;

abstract class BaseCommand implements JBCommandInterface {

    public function attributes_to_array()
    {
        return (array) $this;
    }

} 