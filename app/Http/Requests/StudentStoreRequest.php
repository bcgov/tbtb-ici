<?php

namespace App\Http\Requests;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StudentStoreRequest extends FormRequest
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
            'sin.required' => 'The SIN field is required.',
            'sin.digits' => 'The SIN length must be exactly 9 with no spaces.',
            'sin.unique' => 'The SIN provided is already in use.',
            'student_id.*' => 'Student ID is missing.',
            'tele.*' => 'Telephone number field is not valid.',
            'pen.*' => 'PEN field is not valid.',
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
            'student_id' => 'required',
            'sin' => 'required|digits:9|unique:students,sin',
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',

            'birth_date' => 'required|date_format:Y-m-d',

            'country' => 'size:3|nullable|exists:countries,country_code',
            'province' => 'size:2|nullable|exists:provinces,province_code',

            'postal_code' => 'string|max:9|nullable',
            'tele' => 'max:15|string|nullable',
            'email' => 'email|nullable',
            'gender' => 'size:1|nullable',
            'pen' => 'max:9|nullable',
            'institution_student_number' => 'nullable',

        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if (isset($this->birth_date)) {
            $this->merge(['birth_date' => date('Y-m-d', strtotime($this->birth_date))]);
        }

        if (isset($this->first_name)) {
            $this->merge(['first_name' => Str::title($this->first_name)]);
        }
        if (isset($this->last_name)) {
            $this->merge(['last_name' => Str::title($this->last_name)]);
        }
        if (isset($this->postal_code)) {
            $this->merge(['postal_code' => Str::upper($this->postal_code)]);
        }

        if (isset($this->sin)) {
            //\D means "anything that isn't a digit":
            $this->merge(['sin' => preg_replace('/\D/', '', $this->sin)]);
        }
        if (isset($this->tele)) {
            $this->merge(['tele' => preg_replace('/\D/', '', $this->tele)]);
        }

        $last_student = Student::orderByDesc('student_id')->first();
        $this->merge(['student_id' => $last_student->student_id + 1]);
    }
}
