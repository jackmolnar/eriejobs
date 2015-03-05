<?php

use Elasticquent\ElasticquentTrait;
use EriePaJobs\Jobs\JobsRepository;
use Fadion\Bouncy\BouncyTrait;

class Job extends \Eloquent {

    /*
     * fillable fields
     */
	protected $fillable = [
        'title',
        'description',
        'company_name',
        'company_address',
        'company_city',
        'state_id',
        'salary',
        'career_level_id',
        'type_id',
        'user_id',
        'email',
        'link',
        'active',
        'expire',
        'confidential'
    ];

    /**
     * trait to enable elastic search methods
     */
    use BouncyTrait;

    /**
     * Category relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('Category');
    }

    /**
     * Author Relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function author()
    {
        return $this->belongsTo('User');
    }

    /**
     * Career Level Relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function careerlevel()
    {
        return $this->belongsTo('CareerLevel', 'career_level_id');
    }

    /**
     * Type Relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type()
    {
        return $this->belongsTo('Type');
    }

    /**
     * State Relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function state()
    {
        return $this->belongsTo('State');
    }

    /**
     * Declare dates to be returned as Carbon instance
     * @return array
     */
    public function getDates()
    {
        return array('created_at', 'updated_at', 'expire');
    }

    /**
     * Build the payment dropdown array
     * @return array
     */
    public static function paymentDropDownArray()
    {
        $dropDownArray = array();

        $listing_array = Config::get('billing.listings');

        if(Config::get('billing.free'))
        {
            foreach($listing_array as $length => $cost)
            {
                $dropDownArray[$length] = $length.' Days';
            }
            return $dropDownArray;
        }

        foreach($listing_array as $length => $cost)
        {
            $formatted_cost = number_format(($cost/100), 2);
            $dropDownArray[$length] = $length.' Days ($'.$formatted_cost.')';
        }
        return $dropDownArray;
    }


    /**
     * Mapping properties for elasticsearch
     * @var array
     */
    protected $mappingProperties = [
        'title' => [
            'type' => 'string',
            'store' => true,
            'analyzer' => 'standard',
            'boost' => 3.0
        ],
        'description' => [
            'type' => 'string',
            'store' => true,
            'analyzer' => 'standard',
            'boost' => 2.0
        ],
        'company_name' => [
            'type' => 'string',
            'store' => true,
            'analyzer' => 'standard',
            'boost' => 2.0
        ],
        'company_address' => [
            'type' => 'string',
            'store' => false,
            'analyzer' => 'standard',
        ],
        'company_city' => [
            'type' => 'string',
            'store' => true,
            'analyzer' => 'standard',
        ],
        'state_id' => [
            'type' => 'integer',
            'store' => false,
            'analyzer' => 'standard',
        ],
        'salary' => [
            'type' => 'string',
            'store' => true,
            'analyzer' => 'standard',
        ],
        'active' => [
            'type' => 'boolean',
            'store' => true,
            'analyzer' => 'standard',
        ],
        'created_at' => [
            'type' => 'date',
            'format' => 'YYYY-MM-dd HH:mm:ss',
            'store' => false,
            'index' => 'no',
            'analyzer' => 'standard',
        ],
        'updated_at' => [
            'type' => 'date',
            'format' => 'YYYY-MM-dd HH:mm:ss',
            'store' => false,
            'index' => 'no',
            'analyzer' => 'standard',
        ],
        'expire' => [
            'type' => 'date',
            'format' => 'YYYY-MM-dd HH:mm:ss',
            'store' => false,
            'index' => 'no',
            'analyzer' => 'standard',
        ],
        'confidential' => [
            'type' => 'boolean',
            'store' => false,
            'index' => 'no',
            'analyzer' => 'standard',
        ],
    ];


}