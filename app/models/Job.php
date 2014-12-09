<?php

use Elasticquent\ElasticquentTrait;
use EriePaJobs\Jobs\JobsRepository;

class Job extends \Eloquent {

    /*
     * fillable fields
     */
	protected $fillable = ['title', 'description', 'company_name', 'company_address', 'company_city', 'state_id', 'salary', 'career_level', 'type_id', 'user_id', 'email', 'link', 'active', 'expire'];

    /**
     * trait to enable elastic search methods
     */
    use ElasticquentTrait;

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
        return $this->belongsTo('CareerLevel', 'career_level');
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

    public static function paymentDropDownArray()
    {
        if(Config::get('billing')['free'])
        {
            return 'free';
        }

        $listing_array = Config::get('billing')['listings'];

        $dropDownArray = array();

        foreach($listing_array as $length => $cost)
        {
            $formatted_cost = number_format(($cost/100), 2);
            $dropDownArray[$length] = $length.' Days ($'.$formatted_cost.')';
        }

        return $dropDownArray;
    }

    /**
     * Model Events
     */
    public static function boot()
    {
        parent::boot();

        static::saved(function($job){
            $job->addToIndex();
            $jobRepo = new JobsRepository;
            $jobRepo->updateAllJobsCache();
        });

        static::deleted(function($job){
            $job->removeFromIndex();
            $jobRepo = new JobsRepository;
            $jobRepo->updateAllJobsCache();
        });

        static::updated(function($job){
            if($job->active == 0){
                $job->removeFromIndex();
            } elseif ($job->active == 1){
                $job->reindex();
            }
            $jobRepo = new JobsRepository;
            $jobRepo->updateAllJobsCache();
        });
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
            'type' => 'integer',
            'store' => true,
            'analyzer' => 'standard',
        ],
        'active' => [
            'type' => 'boolean',
            'store' => true,
            'analyzer' => 'standard',
        ],
        'expire' => [
            'type' => 'boolean',
            'store' => false,
            'index' => 'no',
            'analyzer' => 'standard',
        ],
    ];


}