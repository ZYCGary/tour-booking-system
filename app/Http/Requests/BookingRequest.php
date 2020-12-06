<?php

namespace App\Http\Requests;


class BookingRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            // CREATE
            case 'PATCH':
            // UPDATE
            case 'PUT':
            case 'POST':
            {
                return [
                    'tour_id' => 'required',
                    'tour_date' => 'required|date_format:Y-m-d',
                    'given_name.*' => 'required|max:128|string',
                    'surname.*' => 'required|max:64|string',
                    'email.*' => 'required|email|max:128',
                    'mobile.*' => 'required|max:16|regex:/^([0-9\s\-\+\(\)]*)$/',
                    'dob.*' => 'required|date_format:Y-m-d|before:today',
                    'passport.*' => 'required|max:16',
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            }
        }
    }

    public function messages()
    {
        return [
            // Validation messages
        ];
    }
}
