<?php

namespace App\Api\V1\Services\Articles;

use Illuminate\Http\Request;

interface ArticlesServiceInterface
{
    /**
     * Tạo mới
     *
     * @var Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function add(Request $request);

    /**
     * Sửa
     *
     * @var Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function edit(Request $request);

    /**
     * Thêm hình ảnh thanh toán
     *
     * @var Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function payment(Request $request);
}
