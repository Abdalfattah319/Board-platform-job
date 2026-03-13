<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            // 'requirements' => 'required|string|min:10',
            'type' => 'required|string|in:full_time,part_time,remote,contract',
            'location' => 'required|string|max:255',
            'salary_min' => 'nullable|integer|min:0',
            'salary_max' => 'nullable|integer|min:0|gte:salary_min',
            // company_id تمت إزالته - يتم تحديده تلقائياً
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'string' => 'هذا الحقل يجب أن يكون نصاً',
            'max' => 'هذا الحقل يجب أن يكون أقل من :max حرف',
            'min' => 'هذا الحقل يجب أن يكون أكثر من :min حرف',
            'in' => 'هذا الحقل يجب أن يكون من بين القيم المسموح بها',
            'exists' => 'الشركة المحددة غير موجودة',
        ];
    }
}
