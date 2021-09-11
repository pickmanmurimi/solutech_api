<?php

namespace Modules\Orders\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;
use Modules\Orders\Entities\Order;
use Modules\Orders\Transformers\OrderResource;

class OrdersController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $orders = Order::search('status', $request->input('status'))
            ->search('name', $request->input('name'))
            ->search('address', $request->input('address'))
            ->searchRelationship('depot', 'name', $request->input('depot'))
            ->searchRelationship('depot','depot_address', $request->input('depot_address'))
            ->with(['depot','vehicle', 'vehicle.vehicleType'])
            ->orderBy('created_at', 'DESC')->paginate($request->input('paginate', 10));

        return OrderResource::collection($orders);
    }
}
