<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 11/19/14
 * Time: 8:28 PM
 */

namespace EriePaJobs\Categories;

use Category;
use Cache;

class CategoryRepository {

    /**
     * Get all categories
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllCategories()
    {
        $categories = Category::all();
        return $categories;
    }

    /**
     * Get all categories, include active job count
     * @return \Illuminate\Database\Eloquent\Collection|mixed|static[]
     */
    public function getAllCategoriesWithJobCount()
    {
        if (Cache::has('categories.jobs'))
        {
            $allCategories = Cache::get('categories.jobs');
            return $allCategories;
        }

        $allCategories = $this->getAllCategories();

        foreach($allCategories as $key => $category)
        {
            $jobCount = $category->jobs()->where('active', '=', 1)->count();
            $allCategories[$key]['job_count'] = $jobCount;
        }

        Cache::add('categories.jobs', $allCategories, 15);

        return $allCategories;
    }

}