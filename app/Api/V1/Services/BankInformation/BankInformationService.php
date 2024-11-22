<?php

namespace App\Api\V1\Services\BankInformation;

use App\Api\V1\Repositories\BankInformation\BankInformationRepositoryInterface;
use Illuminate\Http\Request;
use App\Api\V1\Support\AuthSupport;

class BankInformationService implements BankInformationServiceInterface
{
    use AuthSupport;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    public function __construct(
        BankInformationRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }

    public function add(Request $request)
    {
        $user = $request->user()->id;
        $data = $request->validated();

        $data['id_user'] = $user;
        $this->repository->create($data);
        return [
            'status' => 200,
            'message' => __('Đã thêm thanh công')
        ];
    }

    public function update(Request $request)
    {
        $this->data = $request->validated();
        $this->repository->update($this->data['id'], $this->data);
        return [
            'status' => 200,
            'message' => __('Đã chỉnh sửa thành công!')
        ];
    }

    public function delete($id)
    {
        $this->repository->delete($id);
        return [
            'status' => 200,
            'message' => __('Đã xóa thành công')
        ];
    }
}
