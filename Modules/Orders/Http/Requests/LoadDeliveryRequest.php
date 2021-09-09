<?php

namespace Modules\Orders\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Orders\Entities\Order;
use Modules\Vehicles\Entities\Vehicle;

/**
 * @property mixed vehicle_uuid
 * @property mixed order_uuid
 */
class LoadDeliveryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'vehicle_uuid' => ['required', Rule::exists('vehicles','uuid')
                ->where('status', Vehicle::AVAILABLE )],
            'order_uuid' => ['required', Rule::exists('orders','uuid')
                ->where('status',Order::PENDING )],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
