<?php

namespace App\Core;

class AuthMiddleware
{
	/**
	 * The method to check if a user is logged in
	 * @return false
	 */
	public static function isLogged(): bool
	{
		if (!isset($_SESSION['user'])) {
			return false;
		}
		return true;
	}

	public static function requireLogin(): void
	{
		if (!self::isLogged()) {
			header("Location: /login");
			exit;
		}
	}
}
