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
        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                    'tour_id' => ['required'],
                    'tour_date' => ['required'],
                    'given_name.*' => ['required'],
                    'surname.*' => ['required'],
                    'email.*' => ['required'],
                    'mobile.*' => ['required'],
                    'dob.*' => ['required'],
                    'passport.*' => ['required'],
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    // UPDATE ROLES
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
