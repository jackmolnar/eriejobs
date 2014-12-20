<?php

class Type extends \Eloquent {
	protected $fillable = ['type'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'types';


    /**
     * Get types in array suitable for select box
     *
     * @return array
     */
    public static function dropdownarray ()
    {
        if (Cache::has('job.type'))
        {
            $type_array = Cache::get('job.type');
//            return $type_array;
        }

        $all = Type::get();
        $type_array =  array();

        foreach($all as $type)
        {
            $type_array[$type->id] = $type->type;
        }

        Cache::add('job.type', $type_array, 60);

        return $type_array;
    }
}