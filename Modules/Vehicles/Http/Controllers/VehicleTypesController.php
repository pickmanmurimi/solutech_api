<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Vehicles\Entities\VehicleType;
use Modules\Vehicles\Transformers\VehicleTypeResource;

class VehicleTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $vehicle_types = VehicleType::orderBy('created_at', 'DESC')->get();

        return VehicleTypeResource::collection($vehicle_types);
    }
}
