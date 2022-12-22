<?php

namespace App\Http\Requests;

use App\Models\Grant;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class GrantStoreRequest extends FormRequest
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
            'student_id.*' => 'Some fields are missing!',
            'institution_id.*' => 'Institution field is required.',
            'application_receive_date.*' => 'Date Received field is required.',
            'program_code.*' => 'Program Type field is required.',
            'program_year_id.*' => 'Program Year field is required.',
            'study_start_date.*' => 'Study Start Date field is required.',
            'study_end_date.*' => 'Study End Date field is required.',
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
            'institution_id' => 'required',
            'application_receive_date' => 'required',
            'program_code' => 'required',
            'program_year_id' => 'required',
            'study_start_date' => 'required',
            'study_end_date' => 'required',

            'grant_id' => 'required',
            'creator_user_id' => 'required',
            'update_user_id' => 'required',

            'officer_user_id' => 'required',
            'last_evaluation_date' => 'required',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if (isset($this->application_receive_date)) {
            $this->merge(['application_receive_date' => date('Y-m-d', strtotime($this->application_receive_date))]);
        }
        if (isset($this->study_start_date)) {
            $this->merge(['study_start_date' => date('Y-m-d', strtotime($this->study_start_date))]);
        }
        if (isset($this->study_end_date)) {
            $this->merge(['study_end_date' => date('Y-m-d', strtotime($this->study_end_date))]);
        }
        if (isset($this->age)) {
            $this->merge(['age' => preg_replace('/\D/', '', $this->age)]);
        }
//        var_dump(isset($this->officer_user_id));
//        var_dump(is_null($this->officer_user_id));
//        var_dump($this->officer_user_id);
        if (! isset($this->officer_user_id) || is_null($this->officer_user_id)) {
//            echo('in');
            $this->merge(['officer_user_id' => \Illuminate\Support\Facades\Auth::user()->user_id]);
        }
//        dd($this->officer_user_id);
        $this->merge(['last_evaluation_date' => date('Y-m-d', strtotime('now'))]);

        $last_grant = Grant::select('grant_id')->orderBy('grant_id', 'desc')->first();
        $this->merge([
            'grant_id' => intval($last_grant->grant_id) + 1,
            'creator_user_id' => Str::upper(Auth::user()->user_id),
            'update_user_id' => Str::upper(Auth::user()->user_id),
        ]);

        //
//        $this->merge(['disabled' => $this->toBoolean($this->disabled)]);
    }

    /**
     * Convert to boolean
     *
     * @param $booleable
     * @return bool
     */
    private function toBoolean($booleable)
    {
        return filter_var($booleable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }
}
