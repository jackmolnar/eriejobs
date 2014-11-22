<?php

class Category extends \Eloquent {
	protected $fillable = ['category', 'active'];

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'categories';

    /**
     * Job relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function jobs()
    {
        return $this->belongsToMany('Job');
    }

    /**
     * Get categories in array suitable for select box
     * @return array
     */
    public static function dropdownarray ()
    {
        if (Cache::has('job.category'))
        {
            $category_array = Cache::get('job.category');
            return $category_array;
        }

        $all = Category::get();
        $category_array =  array();

        foreach($all as $category)
        {
            $category_array[$category->id] = $category->category;
        }

        Cache::add('job.category', $category_array, 60);

        return $category_array;
    }
}