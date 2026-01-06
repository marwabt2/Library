<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $bookId = $this->route('book')->id;

        return [
            'ISBN' => 'sometimes|string|size:13|unique:books,ISBN,' . $bookId,
            'title' => 'sometimes|string|max:70',
            'price' => 'sometimes|numeric|min:0',
            'mortgage' => 'sometimes|numeric|min:0',
            'authorship_date' => 'nullable|date',
            'category_id' => 'sometimes|exists:categories,id',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ];
    }

    public function messages(): array
    {
        return [
            'ISBN.size' => 'رقم ISBN يجب أن يكون 13 خانة',
            'ISBN.unique' => 'رقم ISBN موجود مسبقاً',

            'title.max' => 'عنوان الكتاب لا يجب أن يتجاوز 70 حرفاً',

            'price.numeric' => 'سعر الكتاب يجب أن يكون رقم',
            'mortgage.numeric' => 'قيمة الرهن يجب أن تكون رقم',

            'authorship_date.date' => 'تاريخ التأليف غير صحيح',

            'category_id.exists' => 'التصنيف غير موجود',

            'cover.image' => 'الملف يجب أن يكون صورة',
            'cover.mimes' => 'الصورة يجب أن تكون بصيغة jpg أو jpeg أو png أو webp',
        ];
    }
}
