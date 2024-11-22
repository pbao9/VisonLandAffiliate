<?php

namespace App\Api\V1\Services\Customers;

use Illuminate\Http\Request;

interface CustomersServiceInterface
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
    public function contact(Request $request);
}
