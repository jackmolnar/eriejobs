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
		$all = ReaderDate::futureDates()->get();

		$date_array =  array();

		foreach($all as $date)
		{
			$date_array[$date->id] = $date->pub_date->toFormattedDateString();
		}

		return $date_array;
	}



}