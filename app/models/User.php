<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Mmanos\Social\SocialTrait;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SocialTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';


    protected $fillable = array('email', 'first_name', 'last_name', 'role', 'notifications');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


    /**
     * Role Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role()
    {
        return $this->belongsTo('Role');
    }

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
     * Notification Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jobNotifications()
    {
        return $this->hasMany('Notification');
    }

    /**
     * Resume Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function resume()
    {
        return $this->hasOne('Resume');
    }

    /**
     * Declare dates to be returned as Carbon instance
     * @return array
     */
    public function getDates()
    {
        return array('created_at', 'updated_at', 'last_login');
    }




}
