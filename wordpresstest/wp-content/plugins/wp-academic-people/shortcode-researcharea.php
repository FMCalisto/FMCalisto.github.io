<?php


// This function is activated for [academic-research-area] and then act accordingly
function wpapl_shortcode_academic_reasearch_areas( $atts ) {
	global $wpapl_research_area_table_name, $wpdb, $wpapl_project_table_name;
	
	// If want to see a certain project
	if( isset( $_GET['project_id'] ) ) {
		return wpapl_shortcode_academic_projects( $atts );
	}
	
	// For a detailed information of an individual
	if( isset( $_GET['wpapl_id'] ) ) {
		return wpapl_shortcode_academic_people_list( $atts );
	}
	

	$html = '<div class="wpapl-research-area-list-top"><ul>';
	
	// Fetch all research areas from DB
	$all_research_areas = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_research_area_table_name ORDER BY %s ASC", "title" ) ); 
	
	foreach( $all_research_areas as $research_area ) {
		// Fetch all projects under current research area
		$all_projects = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_project_table_name WHERE researchAreaID = %d ORDER BY %s ASC", $research_area->researchAreaID, "title" ) ); 
		
		$projects_html = '';
		
		foreach( $all_projects as $project )
		{
			$projects_html .= '<li><a href="' . wpapl_get_project_uri( $project->projectID ) . '">' . $project->title . '</a></li>
			';
		}
		
		$projects_html = '<div class="wpapl-research-area-project-list">
				  <h5>Projects</h5>
				  <ul>
					 ' . $projects_html . '
				  </ul>
				</div>';
		// remove the whole project text if there are no projects
		if( count( $all_projects ) == 0 ) {
			$projects_html = '';
		}
		
		$html .= '<li><h4>' . $research_area->title . '</h4>
			  
				<div class="wpapl-research-area-description">
					<p>' . $research_area->description . '</p>
			  </div>
				' . $projects_html . '
			</li>';
	}
	
	$html .= '</div><br /><br />';
	
	return $html;
}



?>
