<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Vehicles\Entities\Vehicle;
use Modules\Vehicles\Entities\VehicleType;
use Modules\Vehicles\Http\Requests\CreateVehicleRequest;
use Modules\Vehicles\Http\Requests\UpdateVehicleRequest;
use Modules\Vehicles\Transformers\VehicleResource;

class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $paginate = $request->get('paginate', 10);

        $vehicles = Vehicle::with('vehicleType')->paginate($paginate);

        return VehicleResource::collection($vehicles);
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateVehicleRequest $request
     * @return VehicleResource
     */
    public function store(CreateVehicleRequest $request): VehicleResource
    {
        $vehicle_type = VehicleType::findOrFail($request->vehicle_type_id);

        /** @var Vehicle $vehicle */
        $vehicle = $vehicle_type->vehicles()->create([
            "name" => $request->name,
            "make" => $request->make,
            "status" => $request->status,
        ]);

        return new VehicleResource($vehicle);
    }

    /**
     * Show the specified resource.
     * @param $vehicle_uuid
     * @return VehicleResource
     */
    public function show($vehicle_uuid): VehicleResource
    {
        $vehicle = Vehicle::findUuid($vehicle_uuid);
        return new VehicleResource($vehicle);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateVehicleRequest $request
     * @param $vehicle_uuid
     */
    public function update(UpdateVehicleRequest $request, $vehicle_uuid)
    {
        $vehicle = Vehicle::findUuid( $vehicle_uuid );
        $vehicle_type = VehicleType::findOrFail($request->vehicle_type_id);

        /** @var Vehicle $vehicle */
        $vehicle->update([
            "name" => $request->name,
            "make" => $request->make,
            "vehicle_type_id" => $vehicle_type->id,
        ]);

        return new VehicleResource( $vehicle );
    }

    /**
     * Remove the specified resource from storage.
     * @param $vehicle_uuid
     * @return JsonResponse
     */
    public function destroy($vehicle_uuid): JsonResponse
    {
        //
        $vehicle = Vehicle::findUuid($vehicle_uuid);
        $vehicle->delete();

        return $this->sendSuccess('Vehicle deleted', 200);
    }
}
