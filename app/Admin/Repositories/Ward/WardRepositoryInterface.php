<?php

namespace App\Admin\Repositories\Ward;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface WardRepositoryInterface extends EloquentRepositoryInterface
{
    public function getWard();
}