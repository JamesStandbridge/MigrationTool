<?php

namespace MigrationTool\Rectifier;

use MigrationTool\Rectifier\Configuration\EmailDomains;
use MigrationTool\Validator\DataValidator;
use MigrationTool\Validator\Exception\InvalidEmail;

class EmailRectifier {

	public static function emailRectifier(string $email) : string
	{
		if(DataValidator::isEmailValid($email)) {
			$domains = EmailDomains::TO_ARRAY();
			$emailDomain = self::getEmailDomainInfo($email);

			foreach($domains as $domain) {
				$exploded = EmailDomains::EXPLODE($domain);
				if($emailDomain["domain"] === $exploded["domain"]) {
					if($emailDomain["extension"] !== $exploded["extension"])
						$email = self::setEmailExtension($email, $exploded["extension"]);
				}
			}

			return $email;
		} else {
			throw new InvalidEmail(sprintf("Invalid email format for <%s>", $email));
		}
	}

	private static function setEmailExtension(string $email, string $extension) : string
	{
		$exploded = explode('.', $email);
		$newEmail = "";
		for($i = 0; $i < count($exploded) - 1; $i++)
			$newEmail .= $exploded[$i];

		if(!strlen(explode('.', $extension)[0]) === 0)
			$newEmail .= ".";
		
		return $newEmail.$extension;
	}

	private static function getEmailDomainInfo(string $email) : array
	{
		$part_exploded = explode('@', $email);
		$part = $part_exploded[count($part_exploded) - 1];
		$exploded = explode('.', $part);

		$domain = $exploded[0];
		$extension = "";
		for($i = 1; $i < count($exploded); $i++)
			$extension .= '.'.$exploded[$i];

		return array(
			"domain" => $domain,
			"extension" => $extension
		);
	}
}