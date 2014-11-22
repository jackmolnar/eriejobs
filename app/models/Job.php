<?php

use Elasticquent\ElasticquentTrait;

class Job extends \Eloquent {
	protected $fillable = ['title', 'description', 'company_name', 'company_address', 'company_city', 'state_id', 'salary', 'career_level', 'type_id', 'user_id', 'email', 'link', 'active', 'expire'];

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
     * Model Events
     */
    public static function boot()
    {
        parent::boot();

        static::saved(function($job){
            $job->addToIndex();
        });

        static::deleted(function($job){
            $job->removeFromIndex();
        });
    }

    protected $mappingProperties = array(
        'title' => [
            'type' => 'string',
            'store' => true,
            'analyzer' => 'standard'
        ],
        'description' => [
            'type' => 'string',
            'store' => true,
            'analyzer' => 'standard'
        ],
        'company_name' => [
            'type' => 'string',
            'store' => true,
            'analyzer' => 'standard',
            'boost' => '.7'
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
            'boost' => '.2'
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
            'boost' => '.2'
        ],
        'active' => [
            'type' => 'boolean',
            'store' => true,
            'analyzer' => 'standard',
        ],
    );


}