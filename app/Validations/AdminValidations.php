<?php

namespace App\Validations;

use Illuminate\Support\Facades\Validator;

class AdminValidations
{
    public static function propertyregister($request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'no_of_flats' => 'required',
                'flat_type' => 'required'
            ],
            [
                'no_of_flats.required' => 'Enter no of flats',
                'flat_type.required' => 'select flat type',
            ]
        );
        if ($validator->fails()) {
            return $validator;
        }
    }
    public static function flatregister($request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Flat Name is required'
            ]
        );
        if ($validator->fails()) {
            return $validator;
        }
    }
    public static function roomregister($request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'property_id' => 'required',
                'flat_type' => 'required',
                'room_no' => 'required'
            ],
            [
                'property_id.required' => 'Select Building',
                'flat_type.required' => 'Select Flat',
                'room_no.required' => 'Enter Room no',
            ]
        );
        if ($validator->fails()) {
            return $validator;
        }
    }
}
