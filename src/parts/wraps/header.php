<?php
$main_routes = [
	'/' => 'Home',
	'/jobs' => 'Listings',
	'/apply' => 'Application',
	'/about' => 'About',
];
if (Session::has_user()) {
	$session_routes['/user'] = 'Profile';
	$session_routes['/user/logout'] = 'Log out';
} else {
	$session_routes['/user/login'] = 'Log in';
	$session_routes['/user/signup'] = 'Sign up';
} ?>
<header class="flex">
	<nav id="global-navigation" class="fill flex">
		<ul class="fill flex flex-o">
			<?php render('links', $main_routes) ?>
			<li class="fill"></li>
			<?php render('links', $session_routes) ?>
		</ul>
	</nav>
</header>
