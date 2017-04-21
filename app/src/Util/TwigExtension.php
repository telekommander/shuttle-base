<?php

namespace App\Util;

/**
 * Class TwigExtension
 * @package App\Util
 */
class TwigExtension extends \Twig_Extension {
    
    private $router;
    private $uri;

    /**
     * TWIGEXTENSION CONSTRUCTOR.
     * @param $router
     * @param $uri
     * @param $debugger
     */
    public function __construct($router, $uri, $debugger)
    {
        $this->router   = $router;
        $this->uri      = $uri;
    }

    /**
     * @return array
     * SOME ADDITIONAL GLOBAL TWIG TAGS
     */
    public function getFunctions()
    {
        return [
            "asset"         => new \Twig_Function_Method($this, "assetFunction"),
            "path"          => new \Twig_Function_Method($this, "pathFunction"),
            "base_url"      => new \Twig_Function_Method($this, "baseUrlFunction"),
        ];
    }
    
    /**
     * @return array
     * HERE WE DECLARE SOME CUSTOM FILTER WITH THEIR RESPECTIVE PHP FUNCTION
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter("print_r", [$this, "print_r"]),
            new \Twig_SimpleFilter("addslashes", [$this, "addslashes"]),
            new \Twig_SimpleFilter("utf8_decode", [$this, "utf8_decode"]),
            new \Twig_SimpleFilter("json_decode", [$this, "json_decode"]),
            new \Twig_SimpleFilter("urldecode", [$this, "urldecode"]),
        ];
    }

    /**
     * ADD STRING PRINT_R
     * @param $string
     * @return string
     */
    public function print_r($string) {
        return utf8_decode($string);
    }

    /**
     * ADD SLASH ON STRING
     * @param $string
     * @return string
     */
    public function addslashes($string)
    {
        return addslashes($string);
    }

    /**
     * UTF8 DECODE STRING
     * @param $string
     * @return string
     */
    public function utf8_decode($string) {
        return utf8_decode($string);
    }

    /**
     * JSON DECODE STRING
     * @param $string
     * @return string
     */
    public function json_decode($string) {
        return json_decode($string);
    }

    /**
     * URLDECODE STRING
     * @param $string
     * @return string
     */
    public function urldecode($string) {
        return urldecode($string);
    }

	/**
	 * @param $name
	 * @return string
	 */
    public function assetFunction($name)
    {
        return $this->baseUrlFunction() . "/assets/" . $name;
    }

	/**
	 * @param $route
	 * @param array $params
	 * @param array $query
	 * @return mixed
	 */
    public function pathFunction($route, $params = [], $query = [])
    {
        return $this->router->pathFor($route, $params, $query);
    }

	/**
	 * @return string
	 */
    public function baseUrlFunction()
    {
        if (is_string($this->uri)) {
            return $this->uri;
        }
        if (method_exists($this->uri, "getBaseUrl")) {
            return $this->uri->getBaseUrl();
        }
    }

	/**
	 * @return string
	 */
    public function getName()
    {
        return "app";
    }
    
}
