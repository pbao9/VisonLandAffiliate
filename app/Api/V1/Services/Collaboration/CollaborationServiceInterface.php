<?php

namespace App\Api\V1\Services\Collaboration;

use Illuminate\Http\Request;

interface CollaborationServiceInterface
{
    /**
     * Tạo mới
     *
     * @var Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function add(Request $request);
}
