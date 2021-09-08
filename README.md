
# MigrationTool

## Name Rectifier strategy

#### Case one part name

##### Strategy

-   The given character string is compared to each first name contained in the configuration file. Each time a first name is contained within the character string, then it is saved in a table of "matches"
 ```php
	 $matches = [];
		foreach($firstnames as $firstname) {
			$pos = strpos(strtolower($value), strtolower($firstname));

			if($pos !== false) {
				$matches[] = array("pos" => $pos, "firstname" => $firstname);
			}
		}
```
- We then loop on this table, and we consider that the first name that will be used will be the match found with the most character
```php
	$best_matche = array("pos" => null, "firstname" => "");
	foreach($matches as $matche) {
		if(strlen($best_matche["firstname"]) < strlen($matche["firstname"])) 
			$best_matche = $matche;
	}
```
- Now it remains to recover the last name. We first check which side of the chosen first name has the most character left. Then associate this character string with the last name
```php
	$lastname = null;
	$lastname_is_before = $best_matche["pos"] > strlen($value) - ($best_matche["pos"] + strlen($best_matche["firstname"]));

	if($lastname_is_before)
		$lastname = substr($value, 0, $best_matche["pos"]);
	else 
		$lastname = substr($value, $best_matche["pos"] + strlen($best_matche["firstname"]), strlen($value) - 1);
```

##### Examples

```php
$name = "JAMESSTANDBRIDGE";
var_dump(NameRectifier::SEPARATE($name));
```
return
```bash
array(2) {
  ["firstname"]=>
  string(5) "James"
  ["lastname"]=>
  string(11) "Standbridge"
}
```
---
```php
$name = "STANDBRIDGEJames";
var_dump(NameRectifier::SEPARATE($name));
```
return
```bash
array(2) {
  ["firstname"]=>
  string(5) "James"
  ["lastname"]=>
  string(11) "Standbridge"
}
```
---
```php
$name = "STANDBRIDGEJamesDEEGYZ";
var_dump(NameRectifier::SEPARATE($name));
```
return
```bash
array(2) {
  ["firstname"]=>
  string(5) "James"
  ["lastname"]=>
  string(11) "Standbridge"
}
```
---

#### Case multi-parts name

##### Strategy

-   The given character string is separated by spaces in an array. Each part of the table is then compared to each first name contained in the configuration file in order to determine whether some are first names.
```php
	$matches = [];
	foreach($firstnames as $firstname) {
		for($i = 0; $i < count($mapping); $i++) {
			if(strtolower($mapping[$i]['part']) == strtolower($firstname))	
				$mapping[$i]['isFirstname'] = true;
		}
	}
```
-   Then, we want to separate the different parts into two strings: the string in which we concatenate the last name and the other string the first names.
-  If there is no first name in the array, then the last index of the array is considered to be a first name.
```php
	$thereIsALastname = false;
	$thereIsAFirstname = false;
	foreach($mapping as $map) {
		if($map['isFirstname'] === false) 
			$thereIsALastname = true;
		else
			$thereIsAFirstname = true;
	}

	//if no firstname, we set last slug to firstname
	if(!$thereIsAFirstname)
		$mapping[count($mapping) - 1]['isFirstname'] = true;
```
- If there are only first names, then the first index of the array is considered to be a family name and the others are first names.
```php
	if($thereIsALastname) {
		//...
	} else {
		foreach($mapping as $key => $map) {
			if($key === 0 && count($mapping) > 1) 
				$lastnames .= ucfirst(strtolower($map['part']))." ";
			else
				$firstnames .= ucfirst(strtolower($map['part']))." ";
		}
	}
```
- Otherwise, we separate in this way: we increment the array by separating the first and last names.
If a family name is crossed, and a first name has already been concatenated then all subsequent parts are considered to be family names. Same thing if a compound first name is concatenated.
```php
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
				if(strlen($firstnames) > 0)
					$lastnameBarrier = true;
			}
		}
	}
```

##### Examples

```php
$name = "STANDBRIDGE James";
var_dump(NameRectifier::SEPARATE($name));
```
return
```bash
array(2) {
  ["firstname"]=>
  string(5) "James"
  ["lastname"]=>
  string(11) "Standbridge"
}
```
---
```php
$name = "Jean-baptiste lucas francois";
var_dump(NameRectifier::SEPARATE($name));
```
return
```bash
array(2) {
  ["firstname"]=>
  string(13) "Jean-baptiste"
  ["lastname"]=>
  string(14) "Lucas Francois"
}
```
---
```php
$name = "Standbridge Ciron";
var_dump(NameRectifier::SEPARATE($name));
```
return
```bash
array(2) {
  ["firstname"]=>
  string(5) "Ciron"
  ["lastname"]=>
  string(11) "Standbridge"
}
```