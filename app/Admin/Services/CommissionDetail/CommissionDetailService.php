<?php

namespace App\Admin\Services\CommissionDetail;

use App\Admin\Services\CommissionDetail\CommissionDetailServiceInterface;
use App\Admin\Repositories\CommissionDetail\CommissionDetailRepositoryInterface;
use Illuminate\Http\Request;

class CommissionDetailService implements CommissionDetailServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    public function __construct(CommissionDetailRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {

        $this->data = $request->validated();
        return $this->repository->create($this->data);
    }

    public function update(Request $request)
    {
        $com = $this->repository->find($request->id);
        if ($request->paid_amount > $com->remaining_amount) {
            return false;
        }
        $com->paid_amount += $request->paid_amount;
        $com->remaining_amount = $com->total_amount - $com->paid_amount;
        $com->save();
        return $com;
    }

    public function delete($id)
    {
        return $this->repository->delete($id);

    }

}