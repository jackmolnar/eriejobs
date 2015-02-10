<?php

class Notification extends \Eloquent {
	protected $fillable = ['user_id', 'term', 'category_id'];

    /**
     * User relationship
     */
    public function user()
    {
        $this->belongsTo('User');
    }

    /**
     * Category relationship
     */
    public function category()
    {
        $this->belongsTo('Category');
    }
}