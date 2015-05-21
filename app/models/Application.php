<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Application extends \Eloquent {
	protected $fillable = ['user_id', 'job_id', 'cover_letter', 'resume_id'];

	/**
	 * trait to enable soft deleting jobs
	 */
	use SoftDeletingTrait;

	/**
	 * Role Relationship
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

	/**
	 * Role Relationship
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function job()
	{
		return $this->belongsTo('Job');
	}

	/**
	 * Role Relationship
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
	public function resume()
	{
		return $this->belongsTo('Resume');
	}

}