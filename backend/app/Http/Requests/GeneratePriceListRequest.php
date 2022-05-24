<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int|null $store_id
 * @property string $starts_at
 */
class GeneratePriceListRequest extends FormRequest
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
            'store_id' => 'nullable|exists:stores,id',
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
            'store_id' => $this->store_id == 'null' ? null : $this->store_id,
            'starts_at' => $starts_at->format('Y-m-d H:i:s'),
        ]);
    }
}
