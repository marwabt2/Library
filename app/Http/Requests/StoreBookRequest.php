<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
        return [
            'ISBN' => 'required|string|size:13|unique:books,ISBN',
            'title' => 'required|string|max:70',
            'price' => 'required|numeric|min:0',
            'mortgage' => 'required|numeric|min:0',
            'authorship_date' => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ];
    }

    public function messages(): array
    {
        return [
            'ISBN.required' => 'رقم ISBN مطلوب',
            'ISBN.size' => 'رقم ISBN يجب أن يكون 13 خانة',
            'ISBN.unique' => 'رقم ISBN موجود مسبقاً',

            'title.required' => 'عنوان الكتاب مطلوب',
            'title.max' => 'عنوان الكتاب لا يجب أن يتجاوز 70 حرفاً',

            'price.required' => 'سعر الكتاب مطلوب',
            'price.numeric' => 'سعر الكتاب يجب أن يكون رقم',

            'mortgage.required' => 'قيمة الرهن مطلوبة',
            'mortgage.numeric' => 'قيمة الرهن يجب أن تكون رقم',

            'authorship_date.date' => 'تاريخ التأليف غير صحيح',

            'category_id.required' => 'التصنيف مطلوب',
            'category_id.exists' => 'التصنيف غير موجود',

            'cover.image' => 'الملف يجب أن يكون صورة',
            'cover.mimes' => 'الصورة يجب أن تكون بصيغة jpg أو jpeg أو png أو webp',
        ];
    }
}
