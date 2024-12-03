<?php

namespace App\Core;

class Messages
{
	public static function setMessage(string $message, string $type): void
	{
		$_SESSION['messages'][] = [
			'message' => $message,
			'type' => $type
		];
	}

	public static function getMessages(): array
	{
		if (!empty($_SESSION['messages'])) {
			$messages = $_SESSION['messages'];
			unset($_SESSION['messages']);
			return $messages;
		}
		return [];
	}
}
