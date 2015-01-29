<?php 

$entity = [
	"table" => "user",
	"col" 	=> [
		"ID"=>[
			"type"=>"int",
			"null"=>"",
			"default"=>"null",
			"extra"=>"AUTO_INCREMENT"
		],

		"User"=>[
			"type"=>"varchar(55)",
			"null"=>"",
			"default"=>"null",
			"extra"=>""
		],

		"UserLastname"=>[
			"type"=>"varchar(55)",
			"null"=>"",
			"default"=>"null",
			"extra"=>""
		],

		"UserFirstname"=>[
			"type"=>"varchar(55)",
			"null"=>"",
			"default"=>"null",
			"extra"=>""
		],

		"UserPassword"=>[
			"type"=>"varchar(55)",
			"null"=>"",
			"default"=>"null",
			"extra"=>""
		],

		"UserPassword_confirm"=>[
			"type"=>"varchar(55)",
			"null"=>"",
			"default"=>"null",
			"extra"=>""
		],

		"UserMail"=>[
			"type"=>"varchar(55)",
			"null"=>"",
			"default"=>"null",
			"extra"=>""
		],

		"role"=>[
			"type"=>"",
			"null"=>"",
			"default"=>"null",
			"extra"=>""
		],

		"datecrea"=>[
			"type"=>"datetime",
			"null"=>"",
			"default"=>"null",
			"extra"=>""
		],

		"dateupd"=>[
			"type"=>"datetime",
			"null"=>"",
			"default"=>"null",
			"extra"=>""
		]
	]
];
$jsonStringPretty = json_encode($entity,JSON_PRETTY_PRINT);
echo"<pre>";
print_r($jsonStringPretty);
echo"</pre>";


 ?>