<?php

namespace App\Http\Requests\Backend\Shipping;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\FilterStringRule;

class UpdateShippingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('update-shipping');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'region_en'=>['string', new FilterStringRule],
            'area_en'=>['string', new FilterStringRule],
            'shipping_company'=>['string', new FilterStringRule],
        ];
    }

    public function messages()
    {
        return [];
    }
}
