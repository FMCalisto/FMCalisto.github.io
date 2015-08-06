<?php

/** 
 * This file holds all logic for creating excerpts from post content
 */

function wp_cards_the_excerpt( $params = array() ) {
	//global $allowedposttags;
	//foreach ( $allowedposttags as $tag => $spec )
	//	$allowed_tags[] = $tag;

	$allowed_tags = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'img', 'a',
										'br', 'b', 'i', 'u', 'em', 'sub', 'sup',
										'table', 'tr', 'td', 'th', 'dl', 'dt', 'dd', 'code',
										'pre', 'center', 'div', 'span', 'p', 'font', 'ol',
										'ul', 'li', 'q', 's', 'strong', 'cite', 'embed', 
										'object', 'param', 'style', 'script');

	$defaults = array(
		'post_id'        => null,
		'text'           => '',
		'link'           => '#',
		'charset'        => get_bloginfo('charset'),
		'length'         => 40,
		'use_words'      => true,
		'ellipsis'       => '&hellip;',
		'allowed_tags'   => $allowed_tags,
		'exclude_tags'   => array()
	);

	$params = array_merge($defaults, $params);
	extract($params, EXTR_SKIP);

	if ( is_array( $allowed_tags ) ) {
		if ( !empty( $exclude_tags ) && is_array( $exclude_tags ) )
			$allowed_tags = array_diff( $allowed_tags, $exclude_tags );

		$allowed_tags = '<' . implode('><', $allowed_tags) . '>';
	}

	// Precaution against malformed CDATA in RSS feeds I suppose
	$text = str_replace(']]>', ']]&gt;', $text);
	$text = trim($text);

	// Check if there is a <!--more--> tag
	$more_position = stripos($text, '<!--more-->');
	if ( $more_position !== false ) {
		$text = substr($text, 0, $more_position);
	}

	// Strip tags now, otherwise the <!--more--> tag is also stripped
	$text = strip_tags($text, $allowed_tags);
	$text = trim($text);

	// Skip the triming and more link if length = 0
	if ( $length ) {
		// Count length as words, not characters
		if ( $use_words ) {
			// Check if the text is already short, count words, not HTML tags
			if ( $length < count(preg_split('/[\s]+/', strip_tags($text), -1)) ) {
				// Now we start counting
				$text_bits = preg_split('/([\s]+)/', $text, -1, PREG_SPLIT_DELIM_CAPTURE);
				$in_tag = false;
				$n_words = 0;
				$text = '';

				foreach ( $text_bits as $chunk ) {
					// Determine whether a tag is opened (and not immediately closed) in this chunk
					if ( 0 < preg_match('/<[^>]*$/s', $chunk) )
						$in_tag = true;
					elseif ( 0 < preg_match('/>[^<]*$/s', $chunk) )
						$in_tag = false;

					// Is there a word?
					if ( ! $in_tag && ! empty($chunk) && wp_cards_substr($chunk, -1, 1) != '>' )
						$n_words++;

					$text .= $chunk;

					if ( $n_words >= $length && ! $in_tag )
						break;
				}

				if ( strrpos($text, '.') !== 0 && strrpos($text, $ellipsis) !== 0 )
					$text .= $ellipsis;
			}
		} else {
			// Check if the text is already short, count characters, not whitespace, not those belonging to HTML tags
			if ( $length < wp_cards_strlen(strip_tags($text), 'UTF-8') ) {
				$in_tag = false;
				$n_chars = 0;

				for ( $i=0; $n_chars<$length || $in_tag; $i++ ) {
					// Is the character worth counting (ie. not part of an HTML tag)
					if ( wp_cards_substr($text, $i, 1) == '<' )
						$in_tag = true;
					elseif ( wp_cards_substr($text, $i, 1) == '>' )
						$in_tag = false;
					elseif ( ! $in_tag && '' != trim(wp_cards_substr($text, $i, 1)) )
						$n_chars++;

					// Prevent eternal loops (this could happen with incomplete HTML tags)
					if ( $i >= wp_cards_strlen($text) - 1 )
						break;
				}
				$text = wp_cards_substr($text, 0, $i, 'utf-8');
				$text .= $ellipsis;
			}
		}
		$text = force_balance_tags($text);
	}

	return $text;
}

function wp_cards_substr( $text, $start, $length = null, $charset = "UTF-8" ) {
	$length = (is_null($length))?wp_cards_strlen($text):$length;
	if ( function_exists('mb_substr') )
		 return mb_substr($text, $start, $length, $charset);
	else
		 return substr($text, $start, $length);
}

function wp_cards_strlen( $text, $charset = "UTF-8" ) {
	if ( function_exists('mb_strlen') )
		 return mb_strlen($text, $charset);
	else
		 return strlen($text);
}

?>