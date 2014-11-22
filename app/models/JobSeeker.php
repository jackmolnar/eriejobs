<?php

class JobSeeker extends User {

	protected $fillable = ['email', 'first_name', 'last_name'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'jobSeekers';



}