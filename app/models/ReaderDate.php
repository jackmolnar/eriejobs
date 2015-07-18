<?php

class ReaderDate extends \Eloquent {
	protected $fillable = ['pub_date'];

	protected $table = 'reader_dates';

	public function getDates()
	{
		return array('created_at', 'updated_at', 'pub_date');
	}

	public function scopeFutureDates($query)
	{
		$cutDay = \Carbon\Carbon::today()->addDays(5);
		return $query->where('pub_date', '>', $cutDay);
	}


	/**
	 * Get states in array suitable for select box
	 *
	 * @return array
	 */
	public static function dropdownarray ()
	{
//		if (Cache::has('job.states'))
//		{
//			$state_array = Cache::get('job.states');
//			return $state_array;
//		}

		$all = ReaderDate::futureDates()->get();

		$date_array =  array();

		foreach($all as $date)
		{
			$date_array[$date->id] = $date->pub_date->toFormattedDateString();
		}

//		Cache::add('job.type', $state_array, 60);

		return $date_array;
	}



}