<?php

namespace App\Helper;

/**
 * Class Hash
 * @package App\Helper
 */
class Hash 
{
	protected $config;

	/**
	 * Hash constructor.
	 * @param $config
	 */
    public function __construct($config)
    {
        $this->config = $config;
    }

	/**
	 * @param $password
	 * @return bool|string
	 */
    public function password($password)
    {
        $config = $this->config;
        return password_hash(
            $password,
            constant($config["hash"]["algo"]),
            ["cost" => $config["hash"]["cost"]]
        );
    }

	/**
	 * @param $password
	 * @param $hash
	 * @return bool
	 */
    public function passwordCheck($password, $hash)
    {
        return password_verify($password, $hash);
    }
}