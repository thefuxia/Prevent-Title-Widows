<?php
/*
Plugin Name: Prevent Title Widows
Description: Adds a no break space between the last two words of the title.
Version:     1.0
Required:    3.1
Author:      Thomas Scholz
Author URI:  http://toscho.de
License:     GPL v2
*/
// Don't call this file per HTTP.
! defined( 'ABSPATH' ) and exit;

if ( ! function_exists( 'prevent_widows' ) )
{
	/**
	 * Replaces the last white space in $str with a no break space.
	 *
	 * @param  string $str
	 * @return $str
	 */
	function prevent_widows( $str, $last_words_max_length = 11 )
	{
		$pos = strrpos( $str, ' ' );

		if ( $pos === FALSE || strlen( $str ) - $pos > $last_words_max_length )
		{ // Nothing to do.
			return $str;
		}
		// U+00A0 NO-BREAK SPACE == C2 A0 in UTF-8
		// @see http://www.fileformat.info/info/unicode/char/00a0/index.htm
		return substr_replace( $str, "\xC2\xA0", $pos, 1 );
	}
}
add_filter( 'the_title', 'prevent_widows' );