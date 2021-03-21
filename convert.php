<?php
/**
 * Temperature conversion script
 *
 * Converts a provided value from Celsius to Fahrenheit, or vice versa.
 */

// Collect user input and current default temperature scale (stored by Alfred)
$query = $argv[1];
$default_scale = getenv( 'default_scale' );

// Initialize items array
$items = array(
	'items' => array(),
);

// If no scale is provided, and a default is set, use the default
if ( ! preg_match( "/[f,c]{1}$/i", $query ) && false != $default_scale ) {
	if ( 'Fahrenheit' === $default_scale ) {
		$temp = $query . 'f';
	} elseif ( 'Celsius' === $default_scale ) {
		$temp = $query . 'c';
	}
// Otherwise, save user input as-is
} else {
	$temp = $query;
}

// Verify the temp is valid:
//		Regex pattern:
//		Optional `-` to support negative integers
//		Any number of numeric digits
//		A single 'f' or 'c' (case insensitive) to declare the current scale being entered
if ( ! preg_match( "/^-?[0-9]+[f,c]{1}$/i", $temp ) ) {
	// Prepare prompt for display when invalid temp is detected
	$title = "Enter a temperature to convert";
	$subtitle = "Be sure to use 'C' or 'F' (or set a default scale below)";
	$result = '';
	$validity = 'false';
} else {
	// Strip scale from string so the numeric value can be processed
	$input_temp = substr( $temp, 0, -1 );

	// Prep values if the input scale is Fahrenheit
	if ( preg_match( "/f/i", $temp ) ) {
		$output_temp = intval( ( 5 / 9 ) * ( $input_temp - 32 ) );
		$converted_scale = 'Celsius';
		$input_abbr = '°F';
		$output_abbr = '°C';
		// Prep values if the the input scale is Celsius
	} elseif ( preg_match( "/c/i", $temp ) ) {
		$output_temp = intval( ( 9 / 5 ) * $input_temp + 32 );
		$converted_scale = "Fahrenheit";
		$input_abbr = '°C';
		$output_abbr = '°F';
	}

	// Save the various values to the relevant strings
	$full_conversion = $input_temp . $input_abbr . "/" . $output_temp . $output_abbr;
	$converted_only = $output_temp . $output_abbr;
	$title = "Convert $input_temp" . "$input_abbr to $converted_scale";
	$subtitle = "Output full conversion: $full_conversion";
	$validity = 'true';
}

// Build the temperature conversion list item
$items['items'][] = array(
	'title'    => $title,
	'subtitle' => $subtitle,
	'arg'      => $full_conversion,
	'valid'    => $validity,
	'mods'     => array(
		'cmd' => array(
			'subtitle' => "Output $converted_scale only: $converted_only",
			'arg'      => $converted_only,
		),
	),
);

// Build the temp. scale setting list item
$items['items'][] = array(
	'title'    => 'Set default temperature scale',
	'subtitle' => 'CMD for Celsius or OPTION for Fahrenheit',
	'valid'    => 'false',
	'mods'     => array(
		'cmd'    => array(
			'subtitle'  => 'Set default temperature scale to Celsius',
			'arg'       => 'Celsius',
			'valid'     => 'true',
			'variables' => array(
				'set_default' => 'true',
			),
		),
		'option' => array(
			'subtitle'  => 'Set default temperature scale to Fahrenheit',
			'arg'       => 'Fahrenheit',
			'valid'     => 'true',
			'variables' => array(
				'set_default' => 'true',
			),
		),
	),
);

// Output script filter list items
echo json_encode( $items );
