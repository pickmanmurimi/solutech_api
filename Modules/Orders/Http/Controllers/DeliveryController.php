<?php

namespace Modules\Orders\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Orders\Entities\Delivery;
use Modules\Orders\Entities\Order;
use Modules\Orders\Http\Requests\LoadDeliveryRequest;
use Modules\Orders\Transformers\DeliveryResource;
use Modules\Vehicles\Entities\Vehicle;
use Str;

class DeliveryController extends Controller
{
    /**
     * Assign the order to a vehicle.
     * @param LoadDeliveryRequest $request
     * @return DeliveryResource
     */
    public function load(LoadDeliveryRequest $request): DeliveryResource
    {
        // get the vehicle
        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::findUuid($request->vehicle_uuid);

        // get the order
        /** @var Order $order */
        $order = Order::findUuid($request->order_uuid);

        //assign the vehicle to order
        $delivery_uuid = Str::uuid();
        $order->vehicle()->attach($vehicle, ['uuid' => $delivery_uuid, 'created_at' => now(), 'updated_at' =>now() ]);

        //change status of vehicle and order
        $order->update(['loading_at' => now(), 'status' => Order::LOADING]);
        $vehicle->update(['status' => Vehicle::LOADING]);

        return new DeliveryResource( Delivery::findUuid( $delivery_uuid) );
    }
}
