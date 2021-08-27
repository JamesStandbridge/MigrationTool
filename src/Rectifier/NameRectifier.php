<?php
namespace MigrationTool\Rectifier;

use MigrationTool\Rectifier\Configuration\Names;


class NameRectifier {

	public static function SEPARATE(string $value) : array
	{
		$exploded_value = explode(" ", $value);

		if(self::isOnePart($value)) {
			$result = self::handleOnePartValue($value);
		} else {
			$result = self::handleMultiPartValue($exploded_value);
		}


		return $result;
	}

	private static function handleMultiPartValue(array $value) : array
	{
		$firstnames = Names::TO_ARRAY();

		$mapping = [];
		foreach($value as $part) 
			$mapping[] = array('part' => $part, 'isFirstname' => false);

		$matches = [];
		foreach($firstnames as $firstname) {
			for($i = 0; $i < count($mapping); $i++) {
				if(strtolower($mapping[$i]['part']) == strtolower($firstname))	
					$mapping[$i]['isFirstname'] = true;
			}
		}

		$thereIsALastname = false;
		foreach($mapping as $map) {
			if($map['isFirstname'] === false) 
				$thereIsALastname = true;
		}

		$firstnames = "";
		$lastnames = "";
		$lastnameBarrier = false;
		$composedNameBarrier = false;

		if($thereIsALastname) {
			foreach($mapping as $map) {
				if($map['isFirstname'] && !$lastnameBarrier && !$composedNameBarrier) {
					$firstnames .= ucfirst(strtolower($map['part']))." ";
					$isComposed = strpos($map['part'], "-") !== false;
					if($isComposed)
						$composedNameBarrier = true;
				}
				else {
					$lastnames .= ucfirst(strtolower($map['part']))." ";
					$lastnameBarrier = true;
				}
			}
		} else {
			foreach($mapping as $key => $map) {
				if($key === 0 && count($mapping) > 1) 
					$lastnames .= ucfirst(strtolower($map['part']))." ";
				else
					$firstnames .= ucfirst(strtolower($map['part']))." ";
			}
		}

		return array(
			"firstname" => rtrim($firstnames),
			"lastname" => rtrim($lastnames)
		);
	}

	private static function handleOnePartValue(string $value) : array
	{
		$firstnames = Names::TO_ARRAY();

		$matches = [];
		foreach($firstnames as $firstname) {
			$pos = strpos(strtolower($value), strtolower($firstname));

			if($pos !== false) {
				$matches[] = array("pos" => $pos, "firstname" => $firstname);
			}
		}

		$best_matche = array("pos" => null, "firstname" => "");
		foreach($matches as $matche) {
			if(strlen($best_matche["firstname"]) < strlen($matche["firstname"])) 
				$best_matche = $matche;
		}

		$lastname = null;
		$lastname_is_before = $best_matche["pos"] > strlen($value) - ($best_matche["pos"] + strlen($best_matche["firstname"]));

		if($lastname_is_before)
			$lastname = substr($value, 0, $best_matche["pos"]);
		else 
			$lastname = substr($value, $best_matche["pos"] + strlen($best_matche["firstname"]), strlen($value) - 1);

		return array(
			"firstname" => ucfirst(strtolower($best_matche['firstname'])),
			"lastname" => ucfirst(strtolower($lastname))
		);
	}

	private static function isOnePart(string $value) : bool
	{
		$exploded_value = explode(" ", $value);
		return count($exploded_value) === 1;
	}
}