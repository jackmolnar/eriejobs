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
    public function getAllCategoriesWithJobCount($cache = true)
    {
        if (Cache::has('categories.jobs') && $cache == true)
        {
            $allCategories = Cache::get('categories.jobs');
            return $allCategories;
        }

        // update cache and return categories with count
        return $this->updateCategoryJobCountCache();
    }

    /**
     * Get category title from slug
     * @param $slug
     * @return mixed
     */
    public function getCategoryTitle($slug)
    {
        $category = Category::where('slug', '=', $slug)->first();
        return $category->category;
    }

    /**
     * Update Category Job Count Cache
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function updateCategoryJobCountCache()
    {
        Cache::forget('categories.jobs');

        $allCategories = $this->getAllCategories();

        foreach($allCategories as $key => $category)
        {
            $jobCount = $category->jobs()->active()->count();
            $allCategories[$key]['job_count'] = $jobCount;
        }

        Cache::add('categories.jobs', $allCategories, 15);

        return $allCategories;
    }
}