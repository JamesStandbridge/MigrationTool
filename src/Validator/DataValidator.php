<?php

namespace MigrationTool\Validator;


class DataValidator {

	public static function isEmailValid(string $email) : bool
	{
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	public static function isPhoneNumberValid(string $phonenumber) : bool
	{
		$number_sanitized = self::sanitize($phonenumber);

		switch(strlen($number_sanitized)) {
			case 10:
				$prefix = substr($number_sanitized, 0, 2);
				return  $prefix === "06" || $prefix === "07";

			case 11;
				$prefix = substr($number_sanitized, 0, 3);
				return  $prefix === "336" || $prefix === "337";

			default:
				return false;
		}
	}

	private static function sanitize(string $string) : string
	{
		$string = str_replace(' ', '', $string);
		return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
	}

}