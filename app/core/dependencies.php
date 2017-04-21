<?php

$container = $app->getContainer();

// TWIG
$container["view"] = function ($c) {
    $settings = $c->get("settings");
    $view = new \Slim\Views\Twig($settings["view"]["template_path"], $settings["view"]["twig"]);
    $view->addExtension(new Slim\Views\TwigExtension($c->get("router"), $c->get("request")->getUri()));
    $view->getEnvironment()->addGlobal("site", $c->get("site"));
    $view->getEnvironment()->addGlobal("debug", $settings["mode"]);

    return $view;
};

// FLASH MESSAGES
$container["flash"] = function ($c) {
    return new \Slim\Flash\Messages;
};

// MAILER
$container["mailer"] = function ($c) {
    $settings = $c->get("settings")["mail"];
    $mailer = new \App\Util\SwiftMailerService(
        $c->get("settings")["mode"],
        $settings["transport"],
        $settings["options"]
    );
    return $mailer;
};

// MONOLOG
$container["logger"] = function ($c) {
    $settings = $c->get("settings");
    $logger = new \Monolog\Logger($settings["logger"]["name"]);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings["logger"]["path"], \Monolog\Logger::DEBUG));
    return $logger;
};

// HASH
$container["hash"] = function ($c) {
    return new App\Helper\Hash($c->get("crypt"));
};

//SESSION
$container["session"] = function ($c) {
    return new App\Helper\Session;
};