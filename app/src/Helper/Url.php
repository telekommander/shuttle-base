<?php

namespace App\Helper;

/**
 * Class Url
 * @package App\Helper
 */
class Url
{
	/**
	 * @param null $location
	 */
	public static function redirect($location = null)
	{
		if ($location) {
			if (!headers_sent()) {
				header("Location: ". $location);
				exit;
			} else {
				echo '<script type="text/javascript">';
				echo 'window.location.href="' . $location . '";';
				echo '</script>';
				echo '<noscript>';
				echo '<meta http-equiv="refresh" content="0;url=' . $location . '" />';
				echo '</noscript>';
				exit;
			}
		}
	}

	/**
	 *
	 */
	public static function redirectBack()
	{
		header("Location: javascript://history.go(-1)");
		exit;
	}

	/**
	 * @return mixed
	 */
	public static function getPrevious(){
		return $_SERVER["HTTP_REFERER"];
	}

	/**
	 * @param string $exclude_path
	 * @return string
	 */
	public static function getRoot($exclude_path = '')
	{
		return self::getTransferProtocol() . self::getHost() . str_replace($exclude_path, '', dirname($_SERVER["SCRIPT_NAME"]));
	}

	/**
	 * @return string
	 */
	public static function get()
	{
		return self::getTransferProtocol() . self::getHost() . self::getUri();
	}

	/**
	 * @return int
	 */
	public static function getError()
	{
		return http_response_code();
	}

	/**
	 * @param $code
	 * @return int
	 */
	public static function setError($code)
	{
		return http_response_code($code);
	}

	/**
	 * @param $error
	 * @param $phrase
	 */
	public static function setHeader($error, $phrase)
	{
		return header(self::getServerProtocol() . " $error $phrase");
	}

	/**
	 * @return mixed
	 */
	public static function getUri()
	{
		return $_SERVER["REQUEST_URI"];
	}

	/**
	 * @return mixed
	 */
	public static function getHost()
	{
		return $_SERVER["HTTP_HOST"];
	}

	/**
	 * @return mixed
	 */
	public static function getServerProtocol()
	{
		return $_SERVER['SERVER_PROTOCOL'];
	}

	/**
	 * @return string
	 */
	public static function getTransferProtocol()
	{
		$isSecure = false;
		if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
			$isSecure = true;
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] ==
			'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] ==
			'on') {
			$isSecure = true;
		}
		return $isSecure ? 'https://' : 'http://';
	}
}
