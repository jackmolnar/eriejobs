<?php

class Reader_Heading extends \Eloquent {
	protected $fillable = ['heading'];

	protected $table = 'reader_headings';

	public function jobs()
	{
		return $this->hasMany('Reader_Job');
	}

}