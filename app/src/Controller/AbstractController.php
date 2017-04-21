<?php

namespace App\Controller;

/**
 * Class AbstractController
 * @package App\Controller
 */
abstract class AbstractController
{
    private $container;

	/**
	 * AbstractController constructor.
	 * @param $container
	 */
    public function __construct($container)
    {
        $this->container = $container;
    }

	/**
	 * @param $name
	 * @return mixed
	 */
    public function __get($name)
    {
        return $this->container->get($name);
    }
}
