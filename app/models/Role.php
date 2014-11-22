<?php

class Role extends \Eloquent {
	protected $fillable = ['title', 'value'];

    public function user()
    {
        return $this->hasMany('User', 'role', 'id');
    }
}