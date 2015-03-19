<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 3/14/15
 * Time: 5:49 PM
 */

class VerificationCodes extends \Eloquent{

    protected $fillable = ['user_id', 'verification_code', 'phone_number'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sms_verification_codes';

    /**
     * Code belongs to user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('User');
    }


}