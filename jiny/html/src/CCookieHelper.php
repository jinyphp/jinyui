<?php declare(strict_types = 1);
namespace Jiny\Html;


/**
 * Cookie helper.
 */
class CCookieHelper {

	/**
	 * Check cookie exists.
	 *
	 * @static
	 *
	 * @param string $name
	 *
	 * @return boolean
	 */
	public static function has(string $name): bool {
		return array_key_exists($name, $_COOKIE);
	}

	/**
	 * Get cookie value.
	 *
	 * @static
	 *
	 * @param string $name
	 *
	 * @return mixed
	 */
	public static function get(string $name) {
		return self::has($name) ? $_COOKIE[$name] : null;
	}

	/**
	 * Add cookie.
	 *
	 * @static
	 *
	 * @param string  $name
	 * @param string  $value
	 * @param integer $time
	 *
	 * @return boolean
	 *
	 * @throws Exception
	 */
	public static function set(string $name, string $value, int $time = 0): bool {
		if (headers_sent()) {
			throw new \Exception(_('Headers already sent.'));
		}

		$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$path = rtrim(substr($path, 0, strrpos($path, '/')), '/');

		if (mb_strlen($value) === 0) {
			throw new \Exception(_('Value cannot be empty.'));
		}

		if (!setcookie($name, $value, $time, $path, '', HTTPS, true)) {
			return false;
		}

		$_COOKIE[$name] = $value;

		return true;
	}

	/**
	 * Delete cookie.
	 *
	 * @static
	 *
	 * @param string $name
	 *
	 * @return boolean
	 */
	public static function unset(string $name): bool {
		if (!self::has($name)) {
			return false;
		}

		if (headers_sent()) {
			throw new \Exception(_('Headers already sent.'));
		}

		unset($_COOKIE[$name]);

		return setcookie($name, '', 0);
	}

	/**
	 * Get all cookies.
	 *
	 * @static
	 *
	 * @return array
	 */
	public static function getAll(): array {
		return $_COOKIE;
	}
}
