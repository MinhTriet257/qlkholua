<?php

namespace App\Http\Requests\Employes;

use App\Models\Employee;
use App\Models\Warehouse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => [
                'required',
                'string',
                'min:2',
                'max:255',
            ],
            'gender' => [
                'required',
                'boolean',
            ],
            'birthdate' => [
                'required',
                'date',
                'before:today',
            ],
            'phone_number' => [
                'required',
                'digits:10',  // Đảm bảo số điện thoại có 10 chữ số
                // Hoặc bạn có thể dùng regex nếu bạn cần định dạng phức tạp hơn
                // 'regex:/^[0-9]{10}$/'  // Chỉ cho phép 10 chữ số
            ],
            'avata' => [
                'nullable',
                'file',
                'max:3000',
                'mimes:webp,png,jpg',
            ],
            'warehouse_id' => [
                'required',
                Rule::exists(Warehouse::class, 'id'),
            ],
        ];
    }
}
