<?php

class Resume extends \Eloquent {

	protected $fillable = ['user_id', 'path'];

	protected $table = 'resumes';

	/**
	 * User Relationship
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

}