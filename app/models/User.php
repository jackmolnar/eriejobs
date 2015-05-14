<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Mmanos\Social\SocialTrait;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SocialTrait;

    /**
     * trait to enable soft deleting jobs
     */
    use SoftDeletingTrait;

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

    protected $fillable = array('email', 'first_name', 'last_name', 'role', 'email_notifications', 'sms_notifications', 'phone_number');

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
     * Applicant Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function applications()
    {
        return $this->hasMany('Application');
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
     * Users who approved Email Notifications
     * @param $query
     * @return mixed
     */
    public function scopeEmailNotifications($query)
    {
        return $query->where('email_notifications', '=', 1);
    }

    /**
     * Users who approved SMS Notifications
     * @param $query
     * @return mixed
     */
    public function scopeSmsNotifications($query)
    {
        return $query->where('sms_notifications', '=', 1);
    }

    /**
     * Administrator
     * @param $query
     * @return mixed
     */
    public function scopeAdministrator($query)
    {
        return $query->where('role_id', '=', 1)->first();
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
