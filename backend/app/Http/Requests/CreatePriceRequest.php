<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $starts_at
 * @property int|null $store_id
 */
class CreatePriceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'store_id' => 'nullable|exists:stores,id',
            'price' => 'required|numeric',
            'starts_at' => 'required|date_format:Y-m-d H:i:s',
        ];
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $starts_at = Carbon::createFromFormat('Y-m-d\TH:i:s', $this->starts_at);
        $this->merge([
            'starts_at' => $starts_at->format('Y-m-d H:i:s'),
            'store_id' => is_numeric($this->store_id) ? intval($this->store_id) : null,
        ]);
    }
}
