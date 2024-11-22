<?php

namespace App\Admin\Http\Controllers;

use App\Admin\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\District;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    // lấy quận huyện theo tỉnh thành
    public function districtOfProvince(Request $request)
    {
        return optional(Province::where('id', $request->id)->first(), function ($response) {
            return $response->district()->select('id', 'name')->get();
        });
    }
    // lấy phường xã theo quận huyện
    public function wardOfDistrict(Request $request)
    {
        return optional(District::where('id', $request->id)->first(), function ($response) {
            return $response->ward()->select('id', 'name')->get();
        });
    }
}
