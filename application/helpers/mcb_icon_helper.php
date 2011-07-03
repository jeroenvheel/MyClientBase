<?php

function icon($icon_name, $alt='', $ext='png') {

	return '<img src="' . base_url() . 'assets/style/img/icons/' . $icon_name . '.' . $ext . '" alt="' . $alt . '" />';

}

?>
