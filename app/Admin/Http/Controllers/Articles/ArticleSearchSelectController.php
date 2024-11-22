<?php

namespace App\Admin\Http\Controllers\Articles;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Http\Resources\Article\ArticleSearchSelectResource;
use App\Admin\Repositories\Articles\ArticlesRepositoryInterface;

class ArticleSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        ArticlesRepositoryInterface $repository
    ){
        $this->repository = $repository;
    }

    protected function selectResponse(){
        $this->instance = [
            'results' => ArticleSearchSelectResource::collection($this->instance)
        ];
    }
}
