<?php

class ReaderDate extends \Eloquent {
	protected $fillable = ['pub_date'];

	protected $table = 'reader_dates';

	/**
	 * Declare carbon dates
	 * @return array
     */
	public function getDates()
	{
		return array('created_at', 'updated_at', 'pub_date');
	}

	/**
	 * Get future possible publish dates
	 * @param $query
	 * @return mixed
     */
	public function scopeFutureDates($query)
	{
		$cutDay = \Carbon\Carbon::today()->addDays(5);
		return $query->where('pub_date', '>', $cutDay);
	}

	/**
	 * Jobs relationship
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function jobs()
	{
		return $this->hasMany('ReaderJob');
	}

	/**
	 * Get dates in array suitable for select box
	 *
	 * @return array
	 */
	public static function dropdownarray($length = null)
	{
		// get all
		$all = ReaderDate::futureDates()->get();

		// get dates if length is set
		if($length != null)
		{
			$all = ReaderDate::futureDates()->take($length)->get();
		}

		$date_array =  array();

		foreach($all as $date)
		{
			$date_array[$date->id] = $date->pub_date->toFormattedDateString();
		}

		return $date_array;
	}



}