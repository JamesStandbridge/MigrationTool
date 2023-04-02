<?php

namespace MigrationTool\Validator;


class DataValidator {

	public static function isEmailValid(string $email) : bool
	{
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	public static function isPhoneNumberValid(string $phonenumber) : bool
	{
		//check if phonenumber is a valid cell phone number
        return preg_match('/^\+33[0-9]{9}$/', $phonenumber);
	}

	private static function sanitize(string $string) : string
	{
		$string = str_replace(' ', '', $string);
		return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
	}

}