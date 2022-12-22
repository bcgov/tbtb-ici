<?php

namespace App\Http\Requests\Twp;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationStoreRequest extends FormRequest
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
            'received_date.*' => 'Application Received Date field is not valid.',
            'application_status.*' => 'Application Status field is not valid.',
            'twp_status.*' => 'TWP Status field is not valid.',
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
            'twp_student_id' => 'required',
            'received_date' => 'present|date_format:Y-m-d|nullable',
            'application_status' => 'present|in:APPROVED,DENIED,IN PROGRESS,APPROVED ON APPEAL,WITHDRAWN|nullable',
            'twp_status' => 'present|in:Inactive,In Progress,Credential Completed|nullable',
            'denial_reason' => 'nullable',
            'exception_comments' => 'nullable',
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
