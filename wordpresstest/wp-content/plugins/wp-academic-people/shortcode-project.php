<?php

// This function is activated for [academic-projects] and then act accordingly
function wpapl_shortcode_academic_projects( $atts ) {
	global $wpdb, $wpapl_project_table_name;
	extract( shortcode_atts( array(
		'research_area' => 'all'
	), $atts ) );	
	
	// If want to see a certain project
	if( isset( $_GET['project_id'] ) ) {
		return wpapl_showProjectDetail( $_GET['project_id'] );
	}
	
	// For a detailed information of an individual
	if( isset( $_GET['wpapl_id'] ) ) {
		return wpapl_shortcode_academic_people_list( $atts );
	}
	
	// If want to see research area
	if( isset( $_GET['research_area_id'] ) ) {
		return wpapl_shortcode_academic_reasearch_areas( $_GET['research_area_id'] );
	}

	if( $research_area == 'all' ) {
		// Fetch all projects
		$all_projects = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_project_table_name ORDER BY %s ASC", "title" ) ); 
	}
	else {
		// Fetch all specified projects
		$all_projects = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_project_table_name WHERE title = %s ORDER BY %s ASC", $research_area, "title" ) ); 
	} 
	
	$html = '<div class="wpapl-project-list-top">
			  <ul>';
	
	foreach( $all_projects as $project ) {
		$html .= '<li><h4><a href="' . wpapl_get_project_uri( $project->projectID ) . '">' . $project->title . '</a></h4>
				<p>' . $project->description . '
				</p></li>
		';
	}
	
	$html .= '</ul>
			</div><br />';
			
	return $html;
}

// Show detail of a specific project
function wpapl_showProjectDetail( $projectID ) {
	global $wpapl_project_table_name, $wpapl_research_area_table_name, $wpdb, $wpapl_people_project_table_name;
	
	// Get project information
	$project = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpapl_project_table_name WHERE projectID = %d", $projectID ) ); 
	
	// Get research area info
	$research_area = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpapl_research_area_table_name WHERE researchAreaID = %d", $project->researchAreaID ) ); 
	
	// Get people working on this project
	$all_people = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_people_project_table_name WHERE projectID = %d", $project->projectID ) );

	$people_html = '<ul>';
	
	foreach( $all_people as $people )
	{
		$user = wpapl_get_academic_user_info( $people->userID );
		$people_html .= '<li><a href="' . wpapl_get_user_profile_uri( $user->userID ) . '">' . $user->full_name . '</a></li>
		';
	}
	$people_html .= '</ul>';
	
	require_once('functions.php');
	$research_area_uri = wpapl_get_research_area_uri( $research_area->researchAreaID );

	$html = ' 
		<div class="wpapl-project-detail">
		<div class="wpapl-category-heading"><p><a href="' . $research_area_uri . '">' .  $research_area->title . '</a> &gt;&gt; </p></div>
		<span class="wpapl-project-minititle"></span><h3>' . $project->title . '
		  </h3>
		<ul>   
			<li><h4>Abstract</h4>
			  <p>' . $project->abstract . '</p>
			</li>
			<li><h4>Description</h4>
			  <p>' . $project->description . '</p>
			</li>
			<li><h4>Team Members</h4>
			  ' . $people_html . '
			</li>
		  </ul>
		
		</div>
	';
	return $html;
}

?>