<?php

namespace Modules\Vehicles\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed registration
 * @property mixed make
 * @property mixed status
 * @property mixed vehicle_type_id
 */
class CreateVehicleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "registration" => ['required','unique:vehicles,registration'],
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
