<?php

use Cviebrock\EloquentSluggable\SluggableTrait;

class Post extends \Eloquent {

	protected $fillable = ['title', 'body', 'slug', 'publish_date', 'image'];

	use SluggableTrait;

	protected $sluggable = array(
		'build_from' => 'title',
		'save_to'    => 'slug',
	);


}