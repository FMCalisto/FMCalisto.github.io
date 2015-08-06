<?php

// This function is activated for [academic-people-list] and then act accordingly
function wpapl_shortcode_academic_people_list( $atts ) {

	
	// For a detailed information of an idividual
	if( isset( $_GET['wpapl_id'] ) ) {
		return wpapl_showAcademicDetail( $_GET['wpapl_id'] );
	}
	// For people list
	else {
		return wpapl_showPeople( $atts );
	}

}


// Show academic detail of a praticular individual
function wpapl_showAcademicDetail( $userID ) {
	$user = wpapl_get_academic_user_info( $userID );
	$siteurl = get_option('siteurl');
	
	// Get photo URI
	$photo = wpapl_get_user_photo_uri( $userID );
	
	$top_uri = wpapl_get_uri();
	$category_uri = wpapl_get_people_category_uri( $user->categoryID );
	
	$html = '
		<div class="wpapl-person">
			<div class="wpapl-category-heading"><p><a href="' . $category_uri . '">' . $user->category_name . '</a> &gt;&gt; </p></div>
			<div class="wpapl-image"><img src="' . $photo->uri . '" width="' . $photo->width . '" height="' . $photo->height . '" /></div>
			<div class="wpapl-mininum-information">
			  <h4><span class="wpapl-person-name">' . $user->full_name . '</span></h4>';
	$html .= '<p>';
	
	if( ! ( empty( $user->current_job ) ) ) {
		$html .=  '<span class="wpapl-people-detail-tag">Job:</span> ' . $user->current_job . '<br />';
	}
	if( ! ( empty( $user->url ) ) ) {
		$html .=  '<span class="wpapl-people-detail-tag">Website:</span> ' . makeClickableLinks( $user->url ) . '<br />';
	}
	if( ! ( empty( $user->academic_email ) ) ) {
		$html .=  '<span class="wpapl-people-detail-tag">Email:</span> ' . makeClickableLinks( $user->academic_email ) . '<br /><br />';
	}	
				
	$html .= '</p>';
	
	if( ! ( empty( $user->phone_number ) ) ) {
		$html .=  '<span class="wpapl-people-detail-tag">Phone Number:</span> ' . $user->phone_number . '<br /><br />';
	}	
				
	if( ! ( empty( $user->BS_field ) && empty( $user->BS_institution ) && empty( $user->BS_year ) ) ) {
		$html .= '<span class="wpapl-people-detail-tag">B.S. Degree:</span> ' . $user->BS_field . ', ' . $user->BS_institution . ', ' . $user->BS_year . '.<br /><br />';
	}
	if( ! ( empty( $user->MS_field ) && empty( $user->MS_institution ) && empty( $user->MS_year ) ) ) {
		$html .= '<span class="wpapl-people-detail-tag">M.S. Degree:</span> ' . $user->MS_field . ', ' . $user->MS_institution . ', ' . $user->MS_year . '.<br /><br />';
	}
	if( ! ( empty( $user->PhD_field ) && empty( $user->PhD_institution ) && empty( $user->PhD_year ) ) ) {
		$html .= '<span class="wpapl-people-detail-tag">PhD Degree:</span> ' . $user->PhD_field . ', ' . $user->PhD_institution . ', ' . $user->PhD_year . '.<br /><br />';
	}
				
	if( ! ( empty( $user->address ) ) ) {
		$html .=  '<span class="wpapl-people-detail-tag">Address:</span> ' . $user->address . '<br /><br />';
	}
	if( ! ( empty( $user->bio ) ) ) {
		$html .=  '<span class="wpapl-people-detail-tag">Bio:</span> ' . $user->bio . '<br /><br />';
	}	
		
	
	$html .= '
			</div>
		</div><br/>
	';	
	
	return $html;
}


// Get all users under a certain category ID
// if $categoryID = -1 then return all, otherwise return the specified categoryID
function wpapl_usersID_category( $categoryID ) {
	global $wpapl_people_table_name, $wpdb, $wpapl_category_table_name;
	
	// Fetch all people under a category
	if($categoryID == -1) {
		$all_people = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_people_table_name ORDER BY %s ASC", "userID" ) );
	}
	else if( !is_numeric( $categoryID ) ) {
		$temp_res = $wpdb->get_var( $wpdb->prepare( "SELECT categoryID FROM $wpapl_category_table_name WHERE category_name = %s", $categoryID ) );
		$all_people = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_people_table_name WHERE categoryID = %d ORDER BY %s ASC", $temp_res, "userID" ) );
	}
	else {
		$all_people = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_people_table_name WHERE categoryID = %d ORDER BY %s ASC", $categoryID, "userID" ) ); 
	} 
	$users;
	$i = 0;
	
	foreach( $all_people as $people ) {
		$users[$i] = $people->userID;
		$i ++;
	}
	
	return $users;
}

// Return an HTML string for people list of all users
function wpapl_people_list_html( $users ) {
	if( !$users ) return '<div class="wpapl-person">Empty... </div><br />';
	
	$html = "";
	foreach( $users as $user ) {
		$html .= wpapl_people_list_single_user_html( $user );
	}
	return $html;
}

// Return an HTML string of the design of people list for each user
function wpapl_people_list_single_user_html( $userID ) {
	$user = wpapl_get_academic_user_info( $userID );
	$siteurl = get_option('siteurl');
	$photo = wpapl_get_user_photo_uri( $userID );
	
	
	
	$html = '
		<div class="wpapl-person">
			<div class="wpapl-image"><img src="' . $photo->uri . '" width="' . $photo->width . '" height="' . $photo->height . '" /></div>
			<div class="wpapl-mininum-information">
			  <h4><span class="wpapl-person-name">' . $user->full_name . '</span></h4>
			  <p><span class="wpapl-people-individual-tag">Job:</span> ' . $user->current_job . '<br />
				<span class="wpapl-people-individual-tag">Website:</span> ' . makeClickableLinks( $user->url ) . '<br />
				<span class="wpapl-people-individual-tag">Email:</span> ' . makeClickableLinks( $user->academic_email ) . '</p>
				<a href="' . wpapl_get_user_profile_uri( $user->userID ) . '">Details...</a>
			</div>
		</div><br/>
	';
	
	return $html;
}

// Return HTML string of academic people category list
function wpapl_people_category_list( $current_categoryID = -1 ) {
	global $wpapl_category_table_name, $wpdb;
	
	$all_categories = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_category_table_name ORDER BY %s ASC", "category_name" ) ); 
	$html = '<div id="wpapl-category-list-navmenu"><ul>';
	
	
	foreach( $all_categories as $category) {
		$html .= '<li><a href="' . wpapl_get_people_category_uri( $category->categoryID ) . '">' . $category->category_name . '</a></li>'; 
	}
	
	$html .= '</ul></div>';
	
	return $html;
}


function wpapl_get_people_category_name( $category ) {
	global $wpdb, $wpapl_category_table_name;
	if($category == -1) {
		return;
	}
	else if( !is_numeric( $category ) ) {
		return $category;
	}
	else if( is_numeric( $category ) ){
		return $wpdb->get_var( $wpdb->prepare( "SELECT category_name FROM $wpapl_category_table_name WHERE categoryID = %d", $category ) ); 
	} 
	
}

// Show people list on the page
function wpapl_showPeople( $atts ) {
	global $wpdb;
	extract( shortcode_atts( array(
		'category' => 'all',
		'show_cat' => 'true',
	), $atts ) );
	
	// If category has not been specified
	if( $category == 'all' ) {
		$cat = -1;
	}
	// If category has been specified
	else {
		$cat = $category;
	}
	
	// If category specified by URL
	if( isset( $_GET['cat'] ) ) {
		$cat = $_GET['cat'];
	}

	// Get all users under that category
	$users = wpapl_usersID_category( $cat );

	
	$title_html = '<h3>' . wpapl_get_people_category_name( $cat ) . '</h3>';
	
	$html = '<div id="wpapl-people-list-top">';
	$html .= wpapl_people_category_list( $cat ) . $title_html . wpapl_people_list_html( $users );
	$html .= "</div>";
	
	return  $html;	
}

// Makes a text into clickable link. Source: http://www.totallyphp.co.uk/code/convert_links_into_clickable_hyperlinks.htm
function makeClickableLinks($text) {    
	$text = eregi_replace('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)',     '<a href="\\1">\\1</a>', $text);   
	$text = eregi_replace('([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)',     '\\1<a href="http://\\2">\\2</a>', $text);   
	$text = eregi_replace('([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})',     '<a href="mailto:\\1">\\1</a>', $text);    
	return $text;  }  

?>