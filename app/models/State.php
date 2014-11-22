<?php

class State extends \Eloquent {
	protected $fillable = ['title', 'abbreviation'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'states';

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
     * Get states in array suitable for select box
     *
     * @return array
     */
    public static function dropdownarray ()
    {
        if (Cache::has('job.states'))
        {
            $state_array = Cache::get('job.states');
            return $state_array;
        }

        $all = State::get();
        $state_array =  array();

        foreach($all as $state)
        {
            $state_array[$state->id] = $state->title;
        }

        Cache::add('job.type', $state_array, 60);

        return $state_array;
    }
}