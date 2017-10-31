<?php

// Application middleware
// e.g: $app->add(new \Slim\Csrf\Guard);

$app->add(new SIGA\Core\Middleware\CsrfViewMiddleware($container));
$app->add(new SIGA\Core\Middleware\BaseUrlMiddleware($container));
$app->add(new SIGA\Core\Middleware\MethodsMiddleware($container));

//In Slim v3
//$app->add(new \SIGA\Authentication\Acl\AclRepository(["guest"], 
////This should be in a nice php file by itself for easy inclusion... include '/path/to/acl/definition.php'
//[
//    "resources" => ["/", "/no", "/yes", "/admin"],
//    "roles" => ["guest", "user1", "user2"],
//    "assignments" => [
//        "allow" => [
//            "guest" => ["/", "/admin"],
//            "user1" => ["/", "/no"],
//            "user2" => ["/", "/yes"]
//        ],
//        "deny" => [
//            "guest" => ["/no", "/yes"],
//            "user1" => ["/yes"],
//            "user2" => ["/no"]
//        ]
//    ]
//]));
//$app->add($container->csrf);
