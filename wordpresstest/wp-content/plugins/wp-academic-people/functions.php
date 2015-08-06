<?php

// Get academic information about this user
function wpapl_get_academic_user_info( $userID ) {
	global $wpapl_people_table_name, $wpdb, $wpapl_category_table_name;
	
	// Get WPAPL user data
	$user_academic_information = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpapl_people_table_name WHERE userID = %d", $userID ) );
	$user_wp_information = get_userdata( $userID );
	$user_category = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpapl_category_table_name WHERE categoryID = %d", $user_academic_information->categoryID ) );
	
	$user = $user_academic_information;
	$user->ID = $user_wp_information->ID;
	$user->user_login = $user_wp_information->user_login;
	$user->user_nicename = $user_wp_information->user_nicename;
	$user->user_email = $user_wp_information->user_email;
	$user->user_url = $user_wp_information->user_url;
	$user->user_registered = $user_wp_information->user_registered;
	$user->display_name = $user_wp_information->user_display_name;
	$user->first_name = $user_wp_information->first_name;
	$user->last_name = $user_wp_information->last_name;
	$user->nickname = $user_wp_information->nickname;
	$user->description = $user_wp_information->description;
	$user->user_level = $user_wp_information->user_level;
	$user->userphoto_thumb_file = get_option('siteurl'). '/wp-content/uploads/userphoto/' . $user_wp_information->userphoto_thumb_file;
	$user->userphoto_image_file = get_option('siteurl'). '/wp-content/uploads/userphoto/' . $user_wp_information->userphoto_image_file;
	$user->userphoto_thumb_width = $user_wp_information->userphoto_thumb_width;
	$user->userphoto_thumb_height = $user_wp_information->userphoto_thumb_height;
	$user->categoryID = $user_academic_information->categoryID;
	$user->category_name = $user_category->category_name;
	$user->full_name = $user->first_name . ' ';
	if( !empty( $user->middle_initial ) || !$user->middle_initial == "") {
		$user->full_name .= $user->middle_initial . '-. -';
	}
	$user->full_name .= $user->last_name;
	
	
	return $user;
	
}

// Strip out WPAPL GET parameters from URI
function wpapl_get_uri() {
	$current_url = get_page_link();//$_SERVER["REQUEST_URI"]; 
	$temp_url = explode( "&cat", $current_url );
	$current_url = $temp_url[0];
	$temp_url = explode( "&wpapl_id", $current_url );
	$current_url = $temp_url[0];
	$temp_url = explode( "&project_id", $current_url ); 
	$current_url = $temp_url[0];
	$temp_url = explode( "&reasearch_area_id", $current_url ); 
	$current_url = $temp_url[0];
	$temp_url = explode( "&pub_cat", $current_url ); 
	$current_url = $temp_url[0];
	$temp_url = explode( "&pub_id", $current_url ); 
	$current_url = $temp_url[0];
	$temp_url = explode( "?cat", $current_url );
	$current_url = $temp_url[0];
	$temp_url = explode( "?wpapl_id", $current_url );
	$current_url = $temp_url[0];
	$temp_url = explode( "?project_id", $current_url ); 
	$current_url = $temp_url[0];
	$temp_url = explode( "?reasearch_area_id", $current_url ); 
	$current_url = $temp_url[0];
	$temp_url = explode( "?pub_cat", $current_url ); 
	$current_url = $temp_url[0];
	$temp_url = explode( "?pub_id", $current_url ); 
	$current_url = $temp_url[0];
	
		
	return $current_url;
}

// Add seperator to the URI
function wpapl_uri_add_seperator( $URI) {
	// Pick the correct separator to use
	$separator = "?";
	if ( strpos( $URI, "?" ) !== false )
		$separator = "&";
	
	return $URI . $separator;
}

// Get people category URI
function wpapl_get_people_category_uri( $categoryID ) {
	$current_url = wpapl_get_uri();
	
	$category_uri = wpapl_uri_add_seperator( $current_url ) . 'cat=' . $categoryID;
	
	return $category_uri;
}

// Get publications category URI
function wpapl_get_publication_category_uri( $category_name ) {
	$current_url = wpapl_get_uri();
	
	// using URL encode because someitimes the category name more than one word
	$category_uri = wpapl_uri_add_seperator( $current_url ) . 'pub_type=' . urlencode($category_name);
	
	return $category_uri;
}

// Get certain publication URI
function wpapl_get_publication_uri( $pub_id ) {
	$current_url = wpapl_get_uri();
	
	$publicaiton_uri = wpapl_uri_add_seperator( $current_url ) . 'pub_id=' . $pub_id;
	
	return $publicaiton_uri;
}

// Get project URI
function wpapl_get_project_uri( $projectID ) {
	$current_url = wpapl_get_uri();
	
	$project_uri = wpapl_uri_add_seperator( $current_url ) . 'project_id=' . $projectID;

	return $project_uri;
}

// Get research area URI
function wpapl_get_research_area_uri( $researchAreaID ) {
	$current_url = wpapl_get_uri();
	
	$research_area_uri = wpapl_uri_add_seperator( $current_url ) . 'research_area_id=' . $researchAreaID;
	
	return $research_area_uri;
}


// Get user profile URI
function wpapl_get_user_profile_uri( $userID ) {
	$current_url = wpapl_get_uri();
	
	$user_link = wpapl_uri_add_seperator( $current_url ) . "wpapl_id=" . $userID;
	
	return $user_link;
}


// Get photo of a certain user
function wpapl_get_user_photo_uri( $userID ) {
	// Get user details
	$user = wpapl_get_academic_user_info( $userID );
	
	// URI of the default photo
	$default_image = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/images/default-user.png';
	
	// Get user photo
	if( function_exists( 'userphoto_exists' ) && userphoto_exists( $userID ) ) {
			$photo_uri = $user->userphoto_thumb_file;
			$photo_width = $user->userphoto_thumb_width; 
			$photo_height = $user->userphoto_thumb_height;
		}
	else {
    		$photo_uri =  $default_image;
    		$photo_width = 70; 
			$photo_height = 105;
		}
		
	$photo->uri = $photo_uri;
	$photo->width = $photo_width;
	$photo->height = $photo_height;
	
	return $photo;
}


?>