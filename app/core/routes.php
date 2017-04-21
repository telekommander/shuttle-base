<?php

$app->group("", function () use ($app) {
    $app->get("/", "App\\Controller\\HomeController:dispatch");
    $app->get("/dashboard", "App\\Controller\\HomeController:dashboard");
    $app->get("/json/[{option}]", "App\\Controller\\HomeController:json");
});