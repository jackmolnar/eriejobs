<?php

class ReaderJob extends \Eloquent {
	protected $fillable = ['title', 'description'];

	protected $table = 'reader_jobs';

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function heading()
	{
		return $this->belongsTo('Reader_Heading', 'reader_heading_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function pubDate()
	{
		return $this->belongsTo('ReaderDate', 'reader_date_id');
	}
}