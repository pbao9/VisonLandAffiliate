<?php

namespace App\Api\V1\Services\CustomerRegistrations;

use Illuminate\Http\Request;

interface CustomerRegistrationsServiceInterface
{
    /**
     * Tạo mới
     *
     * @var Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function add(Request $request);
    public function addHasToken(Request $request);
}
