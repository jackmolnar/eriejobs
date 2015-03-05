<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 2/26/15
 * Time: 11:54 PM
 */

namespace EriePaJobs\Traits;


trait PaginateTrait {
    /**
     * Paginates the Elasticsearch results.
     *
     * @param int $perPage
     * @return mixed
     */
    public function paginate($perPage = 15)
    {
        $paginator = \Paginator::make($this->items, count($this->items), $perPage);

        $start = ($paginator->getCurrentPage() - 1) * $perPage;
        $sliced = array_slice($this->items, $start, $perPage);

        return \Paginator::make($sliced, count($this->items), $perPage);
    }

}