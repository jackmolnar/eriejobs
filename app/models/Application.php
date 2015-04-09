<?php

class Application extends \Eloquent {
	protected $fillable = ['user_id', 'job_id'];

	/**
	 * Role Relationship
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

	/**
	 * Role Relationship
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function job()
	{
		return $this->belongsTo('Job');
	}

}