<?php

namespace App\Api\V1\Repositories\Articles;

use App\Admin\Repositories\Articles\ArticlesRepository as AdminArticlesRepository;
use App\Api\V1\Repositories\Articles\ArticlesRepositoryInterface;
use App\Models\Articles;

class ArticlesRepository extends AdminArticlesRepository implements ArticlesRepositoryInterface
{
    public function getModel()
    {
        return Articles::class;
    }

    public function findByID($id)
    {
        $this->instance = $this->model->where('id', $id)
            ->firstOrFail();

        if ($this->instance && $this->instance->exists()) {
            return $this->instance;
        }

        return null;
    }
    public function paginate($page = 1, $limit = 10)
    {
        $page = is_numeric($page) && $page > 0 ? (int) $page - 1 : 0;
        $limit = is_numeric($limit) && $limit > 0 ? (int) $limit : 10;

        $total = $this->model->published()->count();

        $totalPages = (int) ceil($total / $limit);

        $query = $this->instance = $this->model->published()
            ->offset($page * $limit)
            ->limit($limit)
            ->orderBy('status', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return [
            'data' => $query,
            'total' => $total,
            'totalPages' => $totalPages,
            'currentPage' => $page + 1,
            'hasPrev' => $page > 0,
            'hasNext' => $page < $totalPages - 1,
        ];
    }
    public function delete($id)
    {
        try {
            Articles::findOrFail($id)->delete();
            return 1;
        } catch (\Exception $e) {
            return 0;
        }
    }
    public function findAndSearchWithRelation($id = null, array $criteria = [], $page = 1, $limit = 10)
    {
        $query = $this->model::with(['articleArea']);
        if ($id) {
            return $query->findOrFail($id);
        }
        $filters = ['title', 'area_id', 'type'];
        foreach ($filters as $filter) {
            if (isset($criteria[$filter])) {
                $query->where($filter, 'LIKE', '%' . $criteria[$filter] . '%');
            }
        }

        $page = is_numeric($page) && $page > 0 ? (int) $page - 1 : 0;
        $limit = is_numeric($limit) && $limit > 0 ? (int) $limit : 10;
        $total = $query->published()->count();
        $totalPages = (int) ceil($total / $limit);

        $results = $query
            ->published()
            ->orderBy('status', 'desc')
            ->orderBy('id', 'desc')
            ->limit($limit)
            ->offset($page * $limit)
            ->get();

        if ($results->isEmpty()) {
            throw new \Exception('Dữ liệu không tồn tại!');
        }

        return [
            'data' => $results,
            'total' => $total,
            'totalPages' => $totalPages,
            'currentPage' => $page + 1,
            'hasPrev' => $page > 0,
            'hasNext' => $page < $totalPages - 1,
        ];
    }

    public function findAndSearchForUser($id = null, array $criteria = [], $page = 1, $limit = 10, $user_id)
    {
        $query = $this->model->where('user_id', $user_id);

        $filters = ['title', 'active_status'];
        foreach ($filters as $filter) {
            if (isset($criteria[$filter])) {
                $query->where($filter, 'LIKE', '%' . $criteria[$filter] . '%');
            }
        }

        $page = is_numeric($page) && $page > 0 ? (int) $page - 1 : 0;
        $limit = is_numeric($limit) && $limit > 0 ? (int) $limit : 10;
        $total = $query->count();
        $totalPages = (int) ceil($total / $limit);

        $results = $query
            ->orderBy('id', 'desc')
            ->limit($limit)
            ->offset($page * $limit)
            ->get();

        if ($results->isEmpty()) {
            throw new \Exception('Dữ liệu không tồn tại!');
        }

        return [
            'data' => $results,
            'total' => $total,
            'totalPages' => $totalPages,
            'currentPage' => $page + 1,
            'hasPrev' => $page > 0,
            'hasNext' => $page < $totalPages - 1,
        ];
    }
}
