<?php
	define("DIR_RAIZ", "/php-ecommerce");

	define("FRONT_END_PATH", $_SERVER["DOCUMENT_ROOT"] . DIR_RAIZ);
	define("FRONT_END_URL", $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] . DIR_RAIZ);

	define("BACK_END_PATH", FRONT_END_PATH . "/admin");
	define("BACK_END_URL", FRONT_END_URL . "/admin");

	define("UPLOADS", FRONT_END_PATH . "/themes/images/products/upload");
	define("UPLOADS_URL", FRONT_END_URL . "/themes/images/products/upload");

?>