<?php

namespace App\Admin\Services\Commission;

use App\Admin\Services\Commission\CommissionServiceInterface;
use App\Admin\Repositories\Commission\CommissionRepositoryInterface;
use Illuminate\Http\Request;

class CommissionService implements CommissionServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    public function __construct(CommissionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $this->data = $request->validated();

        if (
            $this->data['indirect_commission'] + $this->data['direct_commission'] > 100
        ) {
            return
                [
                    'success' => false,
                    'message' => __('Vui lòng nhập mức hoa hồng tối đa 100% cho tất cả phân loại hoa hồng')
                ];
        }

        $result = $this->repository->create($this->data);

        if ($result) {
            return [
                'id' => $result->id,
                'success' => true,
                'message' => __('Đã thêm thành công!')
            ];
        }
        return $result;
    }

    public function update(Request $request)
    {

        $this->data = $request->validated();

        return $this->repository->update($this->data['id'], $this->data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
