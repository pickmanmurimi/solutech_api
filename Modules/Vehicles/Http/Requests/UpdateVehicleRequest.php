<?php

namespace Modules\Vehicles\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property mixed registration
 * @property mixed make
 * @property mixed status
 * @property mixed vehicle_type_id
 */
class UpdateVehicleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $vehicle_uuid = $this->route('vehicle_uuid');
        return [
            //
            "registration" => ['required', Rule::unique('vehicles','registration')->ignore($vehicle_uuid, 'uuid' )],
            "make" => ['required'],
            "vehicle_type_id" => ['required', 'exists:vehicle_types,id'],
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
