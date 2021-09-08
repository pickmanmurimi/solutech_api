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
        $paginate = $request->get('paginate', 10);

        $orders = Order::with('depot')->orderBy('created_at', 'DESC')->paginate();
        return OrderResource::collection($orders);
    }
}
