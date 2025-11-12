<?php
$email = null;
$on_post = function() use (&$email): array {
	$email = Request::param('email');
	$pass1 = Request::param('pass1');
	$pass2 = Request::param('pass2');

	return [];
};
$errors = Request::is_post()? $on_post() : [];

render_page(['forms/signup'], [
	'title' => 'Sign up',
	'email' => $email,
]);
