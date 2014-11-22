<?php

class CareerLevel extends \Eloquent {
	protected $fillable = ['Level'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'career_level';

    /**
     * Jobs Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function jobs()
    {
        return $this->hasMany('Job');
    }

    /**
     * Get Career Levels in array suitable for select box
     *
     * @return array
     */
    public static function dropdownarray ()
    {
        if (Cache::has('job.careerLevel'))
        {
            $career_level_array = Cache::get('job.careerLevel');
            return $career_level_array;
        }

        $all = CareerLevel::get();
        $career_level_array =  array();

        foreach($all as $level)
        {
            $career_level_array[$level->id] = $level->level;
        }

        Cache::add('job.careerLevel', $career_level_array, 60);

        return $career_level_array;
    }

}