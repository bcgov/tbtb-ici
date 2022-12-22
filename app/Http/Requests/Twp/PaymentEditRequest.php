<?php

namespace App\Http\Requests\Twp;

use Illuminate\Foundation\Http\FormRequest;

class PaymentEditRequest extends FormRequest
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
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'id.*' => 'Payment ID field is not valid.',
            'twp_student_id.*' => 'Student ID field is not valid.',
            'twp_program_id.*' => 'Program ID field is not valid.',
            'payment_date.*' => 'Payment Date field is not valid.',
            'payment_amount.*' => 'Payment Amount field is not valid.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'twp_student_id' => 'required',
            'twp_program_id' => 'nullable',
            'payment_date' => 'present|date_format:Y-m-d|nullable',
            'payment_amount' => 'present|numeric|nullable',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
    }
}
