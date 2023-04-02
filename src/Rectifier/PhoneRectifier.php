<?php

namespace MigrationTool\Rectifier;

use MigrationTool\Validator\DataValidator;
use MigrationTool\Validator\Exception\InvalidPhoneNumber;

class PhoneRectifier 
{

    public static function normalizePhoneNumber(string $rawNumber): string
    {
        //declar variable which take raw number and remove all spaces and special characters
        $number = preg_replace('/[^0-9]/', '', $rawNumber);
        //replace 0 by +33
        $number = preg_replace('/^0/', '+33', $number);
        //make sure the new number is a valid cellphone number
        if(DataValidator::isPhoneNumberValid($number)) {
            throw new InvalidPhoneNumber('Invalid phone number');
        }

        return $number;
    }
}