<?php

class Reader_Heading extends \Eloquent {
	protected $fillable = ['heading'];

	protected $table = 'reader_headings';

	/**
	 * Jobs relationship
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function jobs()
	{
		return $this->hasMany('ReaderJob');
	}

	/**
	 * Get headings in array suitable for select box
	 *
	 * @return array
     */
	public static function dropdownarray()
	{
		$all = Reader_Heading::all();

		$heading_array =  array();

		foreach($all as $heading)
		{
			$heading_array[$heading->id] = $heading->heading;
		}

		return $heading_array;
	}

}