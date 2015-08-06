<?php


// This function is activated for [academic-publications] and then act accordingly
function wpapl_shortcode_academic_publications( $atts ) {
	extract( shortcode_atts( array(
		'type' => 'all'
	), $atts ) );
	
	// For a detailed information of an individual
	if( isset( $_GET['wpapl_id'] ) ) {
		return wpapl_shortcode_academic_people_list( $atts );
	}
	
	$html = '<div id="wpapl-publications-list-top">';
	
	// Category list HTML
	$html .= wpapl_publication_category_list();
	
	// If want a certain publication only
	if( isset( $_GET["pub_id"] ) )
	{
		return $html . wpapl_show_publication_detail( $_GET["pub_id"] );
	}
	
	$title_html = '';
	
	// If want to see a certain category
	if( isset( $_GET['pub_type'] ) ) {
		$title_html = '<h3>'.$_GET['pub_type'].'</h3>';
		$all_publications = wpapl_publication_get_list( urldecode( $_GET['pub_type'] ) );
	}	
	else if( $type != 'all' )
	{
		$title_html = '<h3>'.$type.'</h3>';
		$all_publications = wpapl_publication_get_list( $type );	
	} 
	else
	{
		$all_publications = wpapl_publication_get_list();			
	}
	
	$html = $html . $title_html . wpapl_publications_list_html( $all_publications );
	
	$html .= '</div>';
	
	return $html;
}


// Return HTML string of academic publication category list
function wpapl_publication_category_list() {
	global $wpapl_publication_table_name, $wpdb;
	
	$all_publications = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_publication_table_name ORDER BY %s ASC", "type" ) ); 
	$html = '<div id="wpapl-category-list-navmenu"><ul>';
	
	
	foreach( $all_publications as $publications) {
		$html .= '<li><a href="' . wpapl_get_publication_category_uri( $publications->type ) . '">' . $publications->type . '</a></li>'; 
	}
	
	$html .= '</ul></div>';
	
	return $html;
}

// Get list of all publications
function wpapl_publication_get_list( $category_name = -1) {
	global $wpdb, $wpapl_publication_table_name;
	if( $category_name == -1 ) {
		$all_publications = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_publication_table_name ORDER BY %s ASC", "type" ) ); 
	} else {
			$all_publications = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_publication_table_name WHERE type = %s ORDER BY %s ASC", $category_name, "type" ) ); 
	}
	
	return $all_publications;
}

// Get publication list in HTML
function wpapl_publications_list_html( $publications )
{
	$html = "<div><ul>";
	
	//Generating HTML for list of publicaitons
	foreach( $publications as $publication )
	{
		$html .= '<li><a href="' . wpapl_get_publication_uri( $publication->publicationID ) . '">' . $publication->title . '</a></li>
		';
	}
	
	$html .= "</ul></div>";
	
	return $html;
	
}

// Show detail of a specific publication
function wpapl_show_publication_detail( $pub_id ) {
	global $wpdb, $wpapl_publication_table_name, $wpapl_publication_people_table_name;
	
	
	// Get publication information
	$publication = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpapl_publication_table_name WHERE publicationID = %d", $pub_id ) ); 
	
	// Get people working on this publication
	$all_people = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_publication_people_table_name WHERE publicationID = %d", $pub_id ) );

	$people_html = '<ul>';
	
	foreach( $all_people as $people )
	{
		$user = wpapl_get_academic_user_info( $people->userID );
		$people_html .= '<li><a href="' . wpapl_get_user_profile_uri( $user->userID ) . '">' . $user->full_name . '</a></li>
		';
	}
	$people_html .= '</ul>';
	
	$html = ' 
		<div class="wpapl-publication-detail">
		<span class="wpapl-publication-minititle">publications</span><h3>' . $publication->title . '
		  </h3>
		<ul>   
			<li><h4>Authors</h4>
			  ' . $people_html . '
			</li>		
			<li><h4>Publishing Year</h4>
			  <p>' . $publication->publish_year . '</p>
			</li>
			<li><h4>Other Authors</h4>
			  <p>' . $publication->other_authors . '</p>
			</li>			
			<li><h4>'. $publication->type .'</h4>
			  <p>' . $publication->type_text . '</p>
			</li>
		  </ul>
		
		</div>
	';
	return $html;
}

?>