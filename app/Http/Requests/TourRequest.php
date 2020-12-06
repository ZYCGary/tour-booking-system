<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourRequest extends Request
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
                    'name' => 'required|max:256',
                    'itinerary' => 'required',
                    'dates' => 'required'
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
}
