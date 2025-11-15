<?php
$label = $data[0] ?? $data['label'];
$name = $data[1] ?? $data['name'];
$persist = $data['persist'] ?? true;
$required = $data['required'] ?? true;

$checked = (Request::is_post() && $persist)? Request::param($name) : null;
$checked = is_null($checked)? null : parse_bool($checked);

$id = input_id();
$required = $required? ' required' : '';
$yesc = ($checked === true)? ' checked' : '';
$noc = ($checked === false)? ' checked' : '';

echo <<<TEXT
	<div class="flex input-yesno">
		<label for="$id">$label</label>
		<input id="$id" class="fill" type="radio" name="$name" value="true"$yesc$required>
		<input class="fill" type="radio" name="$name" value="false"$noc>
	</div>
TEXT;
