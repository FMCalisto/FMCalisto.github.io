<?php
// Register function for the administrative panel
add_action( 'admin_menu', 'wpapl_administrative_menu' );

// Administrative menu
function wpapl_administrative_menu() {

	// Add top administrative menu to manage academic people
	// add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
	add_menu_page( "WordPress Academic", "Academic People", "manage_options", "top_level_wpa_handle", "wpapl_admin_people_page" );
	
	// Add sub-administrative menu to manage categories
	// add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function); 
	add_submenu_page( "top_level_wpa_handle", "Academic People Categories Administration", "People Categories", "manage_options", "wpapl_categories_submenu_handle", "wpapl_admin_people_category_page" );
	
	// Add sub-administrative menu to manage research area
	// add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function); 
	add_submenu_page( "top_level_wpa_handle", "Research Area Administration", "Research Areas", "manage_options", "wpapl_reseach_area_submenu_handle", "wpapl_admin_research_area_page" );

	// Add sub-administrative menu to manage project
	// add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function); 
	add_submenu_page( "top_level_wpa_handle", "Project Administration", "Projects", "manage_options", "wpapl_project_submenu_handle", "wpapl_admin_project_page" );
	
	// Add sub-administrative menu to manage publications
	// add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function); 
	add_submenu_page( "top_level_wpa_handle", "Publication Administration", "Publications", "manage_options", "wpapl_publication_submenu_handle", "wpapl_admin_publication_page" );	
	
	// Add the ability for users to edit their own academic profile
	// add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);
	add_submenu_page('profile.php', "Academic Information","Academic Information", 0, "wpapl-user-academic-profile", 'wpapl_user_profile_page');
	
	
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////
// People Category administrative page                                                                   //
///////////////////////////////////////////////////////////////////////////////////////////////////////////
function wpapl_admin_people_category_page() {
	global $wpdb, $wpapl_category_table_name;
	
	// Check if user has the required capability
	if(!current_user_can( 'manage_options' ))
	{
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	// Fetch all people categories
	$all_categories = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_category_table_name ORDER BY %s ASC", "category_name" ) ); 
	
	echo '<div class="wrap wpa">';
	
	// If POST for adding category
	if( isset( $_POST['type']) && $_POST['type'] == 'add_category' ) {
		// Adding to the database
		$wpdb->insert( $wpapl_category_table_name, array( 'category_name' => $_POST["category_name"], ) );
		?>
		<div class="updated"><p><strong>Category <?php echo $_POST['category_name']; ?> has been added to the database.</strong></p></div>
		<?php
	}
	
	// If POST for editing or deleting a category
	if( isset( $_POST['type']) && $_POST['type'] == 'edit_delete' ) {
		// If delete
		if( isset( $_POST['submit_button']) && $_POST['submit_button'] == 'Delete' )
		{
			// Perform deletion on the database
			$result = $wpdb->query( $wpdb->prepare( "DELETE FROM $wpapl_category_table_name WHERE categoryID = %d", $_POST['category'] ) );
			if($result) {
				?>
                <div class="updated"><p><strong>Category deleted.</strong></p></div>
                <?php
			} else {
				?>
                <div class="error"><p>Unable to delete category.</p></div>
                <?php
			}
		}
		
		// If edit
		else if(isset( $_POST['submit_button']) && $_POST['submit_button'] == 'Edit') {
			// Get category information from database
			$category = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpapl_category_table_name WHERE categoryID = %d", $_POST['category'] ) );
			?><br /><h4>Edit Category</h4><?php
			?>
			<form name="edit_category" method="post" action="">
				<ul>
					<li><label for="category_name">Category Name: </label>
					<input id="category_name" type="text" size="20" maxlength="255" name="category_name" value="<?php echo $category->category_name; ?>" /></li>
                    <li><input type="hidden" name="type" value="submit_edit"  /></li>
                    <li><input type="hidden" name="category_id" value="<?php echo $_POST['category']; ?>"  /></li>
					<li><input type="submit" name="submit_button" value="Submit" class="button-secondary" /></li>
                </ul>
			</form> <?php
		}
	}
	
	// If POST for submitting an edition
	if( isset( $_POST['type']) && $_POST['type'] == 'submit_edit' ) {
		$result = $wpdb->query( $wpdb->prepare( "UPDATE $wpapl_category_table_name SET category_name = %s WHERE categoryID = %d", $_POST['category_name'], $_POST['category_id'] ) );
		if($result) {
			?>
			<div class="updated"><p>Category has been renamed to <?php echo $_POST['category_name']; ?>.</p></div>
			<?php
		} else {
			?>
			<div class="error"><p>Unable to edit the category.</p></div>
			<?php
		}		
	}



	// Fetch all people categories (again incase any update happened)
	$all_categories = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_category_table_name ORDER BY %s ASC", "category_name" ) ); 
	
	// ------------------------------------------+
	// Form to edit or delete people categories  |
	// ------------------------------------------+
	
	?><br /><h4>Edit or Delete a Category</h4><?php
	// Form for selecting user
	?><form name="form1" method="post" action=""> <?php
    	?><ul><?php
			?><li><label for="category">Category: </label><?php
            ?><select id="category" name="category"><?php
			// We got all the IDs, now loop through them to get individual IDs
			foreach ( $all_categories as $category ) {
				?><option value="<?php echo $category->categoryID; ?>"><?php echo $category->category_name; ?></option><?php
			}
			?></select></li><li><input type="hidden" name="type" value="edit_delete"  /></li><?php
			?><li><input type="submit" name="submit_button" value="Edit" class="button-secondary" /></li><?php
			?><li><input type="submit" name="submit_button" value="Delete" class="button-secondary" /></li><?php
    	?></ul><?php
	?></form><?php 
	
	// ------------------------------------------+
	// Form to add new category                  |
	// ------------------------------------------+
	
	?><br /><h4>Add New Category</h4><?php
	// Form for selecting user
	?>
	<form name="edit_user" method="post" action="">
		<ul>
			<li><label for="category_name">Category Name: </label>
			<input id="category_name" type="text" size="20" maxlength="255" name="category_name" /></li>
            <li><input type="hidden" name="type" value="add_category"  /></li>
        	<li><input type="submit" name="submit_button" value="Add" class="button-secondary" /></li>
        </ul>
    </form>
	<?php
	
	
	echo '</div>';
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////
// People List administrative page                                                                       //
///////////////////////////////////////////////////////////////////////////////////////////////////////////
function wpapl_admin_people_page() {
	global $wpapl_people_table_name, $wpdb, $wpapl_category_table_name, $wpapl_project_table_name, $wpapl_people_project_table_name;
	
	// Check if user has the required capability
	if(!current_user_can( 'manage_options' ))
	{
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

	echo '<div class="wrap wpa">';
	
	// If POST for upgrading a user
	if( isset( $_POST['type']) && $_POST['type'] == 'upgrade' ) {
		$result = $wpdb->insert( $wpapl_people_table_name, array( 'userID' => $_POST["userID"], ) );
		if($result) {
			?>
			<div class="updated"><p>User has been upgraded.</p></div>
			<?php
		} else {
			?>
			<div class="error"><p>Unable to upgrade the user.</p></div>
			<?php
		}
	}
	
	// If POST for editing a user
	if( isset( $_POST['type']) && $_POST['type'] == 'edit' ) {
		// Get WPAPL user data
		$user_information = wpapl_get_academic_user_info( $_POST['userID'] );
		
		// Fetch all people category
		$all_categories = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_category_table_name ORDER BY %s ASC", "category_name" ) );
		
		// Fetch WP's user information
		$user = get_userdata( $_POST['userID'] );
									 
		?><br /><h4>Edit User Information</h4><?php
		?>
        <form name="edit_user" method="post" action="">
        	<ul>
        		<li><label for="first_name">First Name: </label>
                <input id="first_name" type="text" size="20" maxlength="35" name="first_name" value="<?php echo $user->first_name; ?>" readonly /></li>
                <li><label for="middle_initial">Middle Initial:</label>
                <input id="middle_initial" type="text" size="2" maxlength="1" name="middle_initial" value="<?php echo $user_information->middle_initial; ?>" /></li>
                <li><label for="last_name">Last Name:</label>
                <input id="last_name" type="text" size="20" maxlength="35" name="last_name" value="<?php echo $user->last_name; ?>" readonly /></li>
                <li><label for="phone_number">Phone Number: </label>
                <input id="phone_number" type="text" size="20" maxlength="35" name="phone_number" value="<?php echo $user_information->phone_number; ?>" /></li>
                <li><label for="website">Website: </label>
                <input id="website" type="text" size="30" maxlength="255" name="website" value="<?php echo $user_information->url; ?>" /></li>
                <li><label for="academic_email">Academic Email: </label>
                <input id="academic_email" type="text" size="30" maxlength="255" name="academic_email" value="<?php echo $user_information->academic_email; ?>" /></li>
                <li><label for="current_job">Current Job: </label>
                <input id="current_job" type="text" size="30" maxlength="255" name="current_job" value="<?php echo $user_information->current_job; ?>" /></li>
                <li><label for="BS_field">Bachelore Degree Area: </label>
                <input id="BS_field" type="text" size="40" maxlength="255" name="BS_field" value="<?php echo $user_information->BS_field; ?>" />e.g. Computer Engineering</li>
                <li><label for="BS_institution">Bachelore Degree Institution: </label>
                <input id="BS_institution" type="text" size="40" maxlength="255" name="BS_institution" value="<?php echo $user_information->BS_institution; ?>" /> e.g. Kuwait University</li>
                <li><label for="BS_year">Bachelore Degree Year: </label>
                <input id="BS_year" type="text" size="4" maxlength="4" name="BS_year" value="<?php echo $user_information->BS_year; ?>" /> e.g. 2010</li>
                <li><label for="MS_field">Master Degree Area: </label>
                <input id="MS_field" type="text" size="40" maxlength="255" name="MS_field" value="<?php echo $user_information->MS_field; ?>" /></li>
                <li><label for="MS_institution">Master Degree Institution: </label>
                <input id="MS_institution" type="text" size="40" maxlength="255" name="MS_institution" value="<?php echo $user_information->MS_institution; ?>" /></li>
                <li><label for="MS_year">Master Degree Year: </label>
                <input id="MS_year" type="text" size="4" maxlength="4" name="MS_year" value="<?php echo $user_information->MS_year; ?>" /></li> 
                <li><label for="PhD_field">Ph.D. Area: </label>
                <input id="PhD_field" type="text" size="40" maxlength="255" name="PhD_field" value="<?php echo $user_information->PhD_field; ?>" /></li>
                <li><label for="PhD_institution">Ph.D. Institution: </label>
                <input id="PhD_institution" type="text" size="40" maxlength="255" name="PhD_institution" value="<?php echo $user_information->PhD_institution; ?>" /></li>
                <li><label for="PhD_year">Ph.D. Year: </label>
                <input id="PhD_year" type="text" size="4" maxlength="4" name="PhD_year" value="<?php echo $user_information->PhD_year; ?>" /></li>                                
                <li><label for="bio">Biography: </label>
                <textarea id="bio" name="bio" cols="60" rows="8"><?php echo $user_information->bio; ?></textarea></li> 
                <li><label for="address">Address: </label>
                <textarea id="address" name="address" cols="30" rows="3"><?php echo $user_information->address; ?></textarea></li> 
                <li><label for="categoryID">Category: </label>
                <select id="categoryID" name="categoryID"><?php
                // Loop through people categories
                foreach ( $all_categories as $category ) {
					?><option value="<?php echo $category->categoryID; ?>" <?php if( $user_information->categoryID == $category->categoryID ) echo "selected"; ?>><?php echo $category->category_name; ?></option><?php
					
                }
                ?></select>
                <li><input type="hidden" name="type" value="submit_edit"  /></li>
                <li><input type="hidden" name="userID" value="<?php echo $_POST['userID']; ?>"  /></li>
                <li><input type="submit" value="Submit" class="button-secondary" /></li>
        	</ul>
        </form>
        <?php
	}
	
	// If POST for submitting an edit for a user
	if( isset( $_POST['type']) && $_POST['type'] == 'submit_edit' ) {
		$result = $wpdb->update( $wpapl_people_table_name, 
					  array( 'middle_initial' => $_POST['middle_initial'], 'phone_number' => $_POST['phone_number'], 'url' => $_POST['website'], 'academic_email' => $_POST['academic_email'],
						'current_job' => $_POST['current_job'], 'BS_field' => $_POST['BS_field'], 'BS_institution' => $_POST['BS_institution'], 'BS_year' => $_POST['BS_year'],
						'MS_field' => $_POST['MS_field'], 'MS_institution' => $_POST['MS_institution'], 'MS_year' => $_POST['MS_year'], 'PhD_field' => $_POST['PhD_field'], 
						'PhD_institution' => $_POST['PhD_institution'], 'PhD_year' => $_POST['PhD_year'], 'bio' => $_POST['bio'], 'address' => $_POST['address'],
						'categoryID' => $_POST['categoryID'] ), 
					  array( 'userID' => $_POST['userID'] ) );
		if($result) {
			?>
			<div class="updated"><p>User academic profile edition has been committed.</p></div>
			<?php
		} else {
			?>
			<div class="error"><p>Unable to commit user academic profile.</p></div>
			<?php
		}
	}

	// If POST for assigning a user to a project
	if( isset( $_POST['type']) && $_POST['type'] == 'assign_project' ) {
		
		// first make sure that entry does not exists 
		$temp_result = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_people_project_table_name WHERE userID = %d, projectID = %d", $_POST['userID'], $_POST['projectID'] ) ) ;
		if( !$temp_result ) {	
			
			$result = $wpdb->insert( $wpapl_people_project_table_name, array( 'userID' => $_POST['userID'], 'projectID' => $_POST['projectID'] ) );
			
			if($result) {
				?>
				<div class="updated"><p>The user has been assigned.</p></div>
				<?php
			} else {
				?>
				<div class="error"><p>Unable to assign the user.</p></div>
				<?php
			}
		}
		else {
			?>
			<div class="error"><p>That assignment already exist.</p></div>
			<?php			
		}
	}
	
	// If POST for downgrading a user
	if( isset( $_POST['type']) && $_POST['type'] == 'downgrade' ) {
		$result = $wpdb->query( $wpdb->prepare( "DELETE FROM $wpapl_people_table_name WHERE userID = %d", $_POST['userID'] ) );
		if($result) {
			?>
			<div class="updated"><p>User has been downgraded.</p></div>
			<?php
		} else {
			?>
			<div class="error"><p>Unable to downgraded the user.</p></div>
			<?php
		}
	}
	
	// ---------------------------------------+
	// Form to upgrade user to academic user  |
	// ---------------------------------------+
	
	// Fetch all user IDs
	$all_users_id = $wpdb->get_col( $wpdb->prepare( "SELECT $wpdb->users.ID FROM $wpdb->users ORDER BY %s ASC", "display_name" ) );

	
	?><br /><h4>Upgrade a User to Academic</h4><?php
	// Form for selecting user
	?><form name="form1" method="post" action=""> <?php
    	?><ul><?php
			?><li><label for="userID">Select user: </label><?php
            ?><select id="userID" name="userID"><?php
			// We got all the IDs, now loop through them to get individual IDs
			foreach ( $all_users_id as $i_users_id ) {
				if( !$wpdb->get_var( $wpdb->prepare( "SELECT * FROM $wpapl_people_table_name WHERE userID = %d", $i_users_id ) ) ) {
					$user = wpapl_get_academic_user_info( $i_users_id );
					?><option value="<?php echo $i_users_id; ?>"><?php echo $user->nickname . ': '. $user->full_name; ?></option><?php
				} 
			}
			?></select></li><li><input type="hidden" name="type" value="upgrade"  /></li><?php
			?><li><input type="submit" value="Upgrade" class="button-secondary" /></li><?php
    	?></ul><?php
	?></form><?php  
	
	
	// ---------------------------------------+
	// Form to downgrade user to normal user  |
	// ---------------------------------------+
	
	// This will cause his academic profile to be deleted
	?><br /><h4>Downgrade an Academic User to Normal user</h4><?php
	// Form for selecting user
	?><form name="form2" method="post" action=""> <?php
    	?><ul><?php
			?><li><label for="userID">Select user: </label><?php
            ?><select id="userID" name="userID"><?php
			// We got all the IDs, now loop through them to get individual IDs
			foreach ( $all_users_id as $i_users_id ) {
				if( $wpdb->get_var( $wpdb->prepare( "SELECT * FROM $wpapl_people_table_name WHERE userID = %d", $i_users_id ) ) ) {
					$user = wpapl_get_academic_user_info( $i_users_id );
					?><option value="<?php echo $i_users_id; ?>"><?php echo $user->nickname . ': '. $user->full_name; ?></option><?php
				}
			}
			?></select></li><li><input type="hidden" name="type" value="downgrade"  /></li><?php
			?><li><input type="submit" value="Downgrade" class="button-secondary" /></li><?php
			?></select><?php
    	?></ul><?php
	?></form><?php  
	
	
	// -------------------------------------------+
	// Form to edit a user's academic information |
	// -------------------------------------------+
	 
	?><br /><h4>Edit an Academic Profile</h4><?php
	// Form for selecting user
	?><form name="form3" method="post" action=""> <?php
    	?><ul><?php
			?><li><label for="userID">Select user: </label><?php
            ?><select id="userID" name="userID"><?php
			// We got all the IDs, now loop through them to get individual IDs
			foreach ( $all_users_id as $i_users_id ) {
				if( $wpdb->get_var( $wpdb->prepare( "SELECT * FROM $wpapl_people_table_name WHERE userID = %d", $i_users_id ) ) ) {
					$user = wpapl_get_academic_user_info( $i_users_id );
					?><option value="<?php echo $i_users_id; ?>"><?php echo $user->nickname . ': '. $user->full_name; ?></option><?php
				}
			}
			?></select></li><li><input type="hidden" name="type" value="edit"  /></li><?php
			?><li><input type="submit" value="Edit" class="button-secondary" /></li><?php
			?></select><?php
    	?></ul><?php
	?></form><?php  
	

	// -------------------------------------------+
	// Assign a user to a project                 |
	// -------------------------------------------+
	 // Fetch all projects 
	$all_projects = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_project_table_name ORDER BY %s ASC", "title" ) ); 

	?><br /><h4>Assign a User to a Project</h4><?php
	// Form for selecting user and assigning it to a project
	?><form name="form3" method="post" action=""> <?php
    	?><ul><?php
			?><li><label for="userID">Select user: </label><?php
            ?><select id="userID" name="userID"><?php
			// We got all the IDs, now loop through them to get individual IDs
			foreach ( $all_users_id as $i_users_id ) {
				if( $wpdb->get_var( $wpdb->prepare( "SELECT * FROM $wpapl_people_table_name WHERE userID = %d", $i_users_id ) ) ) {
					$user = wpapl_get_academic_user_info( $i_users_id );
					?><option value="<?php echo $i_users_id; ?>"><?php echo $user->nickname . ': '. $user->full_name; ?></option><?php
				}
			}
			?></select></li>
			<li><label for="projectID">Select project: </label><?php
            ?><select id="projectID" name="projectID"><?php
			// Print all projects
			foreach ( $all_projects as $project ) {
				?><option value="<?php echo $project->projectID; ?>"><?php echo $project->title; ?></option><?php
			}
			
			?></select></li>            
            <li><input type="hidden" name="type" value="assign_project"  /></li><?php
			?><li><input type="submit" value="Assign" class="button-secondary" /></li><?php
			?></select><?php
    	?></ul><?php
	?></form><?php  
	
	
	
	echo "</div>";
}




/////////////////////////////////////////////////////////////////////////////////////////////
// People Profile Edit Page                                                                //
/////////////////////////////////////////////////////////////////////////////////////////////
function wpapl_user_profile_page() {
	global $wpapl_category_table_name, $wpapl_people_table_name, $wpdb;
	
	//Get current user information
	global $current_user;
	get_currentuserinfo();
	
	// If POST for editing profile submitted
	if( isset( $_POST['type']) && $_POST['type'] == 'submit_edit' ) {
		$result = $wpdb->update( $wpapl_people_table_name, 
			array( 'middle_initial' => $_POST['middle_initial'], 'phone_number' => $_POST['phone_number'], 'url' => $_POST['website'], 'academic_email' => $_POST['academic_email'],
						'current_job' => $_POST['current_job'], 'BS_field' => $_POST['BS_field'], 'BS_institution' => $_POST['BS_institution'], 'BS_year' => $_POST['BS_year'],
						'MS_field' => $_POST['MS_field'], 'MS_institution' => $_POST['MS_institution'], 'MS_year' => $_POST['MS_year'], 'PhD_field' => $_POST['PhD_field'], 
						'PhD_institution' => $_POST['PhD_institution'], 'PhD_year' => $_POST['PhD_year'], 'bio' => $_POST['bio'], 'address' => $_POST['address']),
					  array( 'userID' => $current_user->ID ) );
			if($result) {
				?>
				<div class="updated"><p>User academic profile edition has been committed.</p></div>
				<?php
			} else {
				?>
				<div class="error"><p>Unable to commit user academic profile.</p></div>
				<?php
			}
	}
	
	// Check if user is Academic user
	if( !$wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_people_table_name WHERE userID = %d", $current_user->ID ) ) )
	{
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	// Get WPAPL user data
	$user_information = wpapl_get_academic_user_info( $current_user->ID );
	
	// Fetch all people category
	$all_categories = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_category_table_name ORDER BY %s ASC", "category_name" ) );
		
	// Fetch WP's user information
	$user = get_userdata( $current_user->ID );
								 
	?><br /><h4>Edit Academic Profile</h4><?php
	?>
	<form name="edit_user" method="post" action="">
		<ul>
			<li><label for="first_name">First Name: </label>
			<input id="first_name" type="text" size="20" maxlength="35" name="first_name" value="<?php echo $user->first_name; ?>" readonly /></li>
			<li><label for="middle_initial">Middle Initial:</label>
			<input id="middle_initial" type="text" size="2" maxlength="1" name="middle_initial" value="<?php echo $user_information->middle_initial; ?>" /></li>
			<li><label for="last_name">Last Name:</label>
			<input id="last_name" type="text" size="20" maxlength="35" name="last_name" value="<?php echo $user->last_name; ?>" readonly /></li>
			<li><label for="phone_number">Phone Number: </label>
			<input id="phone_number" type="text" size="20" maxlength="35" name="phone_number" value="<?php echo $user_information->phone_number; ?>" /></li>
			<li><label for="website">Website: </label>
			<input id="website" type="text" size="30" maxlength="255" name="website" value="<?php echo $user_information->url; ?>" /></li>
			<li><label for="academic_email">Academic Email: </label>
			<input id="academic_email" type="text" size="30" maxlength="255" name="academic_email" value="<?php echo $user_information->academic_email; ?>" /></li>
			<li><label for="current_job">Current Job: </label>
			<input id="current_job" type="text" size="30" maxlength="255" name="current_job" value="<?php echo $user_information->current_job; ?>" /></li>
			<li><label for="BS_field">Bachelore Degree Area: </label>
			<input id="BS_field" type="text" size="40" maxlength="255" name="BS_field" value="<?php echo $user_information->BS_field; ?>" />e.g. Computer Engineering</li>
			<li><label for="BS_institution">Bachelore Degree Institution: </label>
			<input id="BS_institution" type="text" size="40" maxlength="255" name="BS_institution" value="<?php echo $user_information->BS_institution; ?>" /> e.g. Kuwait University</li>
			<li><label for="BS_year">Bachelore Degree Year: </label>
			<input id="BS_year" type="text" size="4" maxlength="4" name="BS_year" value="<?php echo $user_information->BS_year; ?>" /> e.g. 2010</li>
			<li><label for="MS_field">Master Degree Area: </label>
			<input id="MS_field" type="text" size="40" maxlength="255" name="MS_field" value="<?php echo $user_information->MS_field; ?>" /></li>
			<li><label for="MS_institution">Master Degree Institution: </label>
			<input id="MS_institution" type="text" size="40" maxlength="255" name="MS_institution" value="<?php echo $user_information->MS_institution; ?>" /></li>
			<li><label for="MS_year">Master Degree Year: </label>
			<input id="MS_year" type="text" size="4" maxlength="4" name="MS_year" value="<?php echo $user_information->MS_year; ?>" /></li> 
			<li><label for="PhD_field">Ph.D. Area: </label>
			<input id="PhD_field" type="text" size="40" maxlength="255" name="PhD_field" value="<?php echo $user_information->PhD_field; ?>" /></li>
			<li><label for="PhD_institution">Ph.D. Institution: </label>
			<input id="PhD_institution" type="text" size="40" maxlength="255" name="PhD_institution" value="<?php echo $user_information->PhD_institution; ?>" /></li>
			<li><label for="PhD_year">Ph.D. Year: </label>
			<input id="PhD_year" type="text" size="4" maxlength="4" name="PhD_year" value="<?php echo $user_information->PhD_year; ?>" /></li>                                
			<li><label for="bio">Biography: </label>
			<textarea id="bio" name="bio" cols="60" rows="8"><?php echo $user_information->bio; ?></textarea></li> 
			<li><label for="address">Address: </label>
			<textarea id="address" name="address" cols="30" rows="3"><?php echo $user_information->address; ?></textarea></li> 
			<li><label for="category_name">Category: </label>
			<input id="category_name" name="category_name" size="20" type="text" value="<?php
			// Loop through people categories
			foreach ( $all_categories as $category ) {
				if( $user_information->categoryID == $category->categoryID ) echo $category->category_name;
				
			}
			?>"  readonly />
			<li><input type="hidden" name="type" value="submit_edit"  /></li>
			<li><input type="submit" value="Submit" class="button-secondary" /></li>
		</ul>
	</form>
	<?php
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////
// Research Area administrative page                                                                     //
///////////////////////////////////////////////////////////////////////////////////////////////////////////
function wpapl_admin_research_area_page() {
	global $wpdb, $wpapl_research_area_table_name;
	
	// Check if user has the required capability
	if(!current_user_can( 'manage_options' ))
	{
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	echo '<div class="wrap wpa">';
	
	// If POST for adding research area
	if( isset( $_POST['type']) && $_POST['type'] == 'add_research_area' ) {
		// Adding to the database
		$wpdb->insert( $wpapl_research_area_table_name, array( 'title' => $_POST["research_area_title"], 'description' => $_POST['description'] ) );
		?>
		<div class="updated"><p><strong>Category <?php echo $_POST['title']; ?> has been added to the database.</strong></p></div>
		<?php
	}
	
	// If POST for editing or deleting a research area
	if( isset( $_POST['type']) && $_POST['type'] == 'edit_delete' ) {
		// If delete
		if( isset( $_POST['submit_button']) && $_POST['submit_button'] == 'Delete' )
		{
			// Perform deletion on the database
			$result = $wpdb->query( $wpdb->prepare( "DELETE FROM $wpapl_research_area_table_name WHERE researchAreaID = %d", $_POST['research_area'] ) );
			if($result) {
				?>
                <div class="updated"><p><strong>Research area deleted.</strong></p></div>
                <?php
			} else {
				?>
                <div class="error"><p>Unable to delete research area.</p></div>
                <?php
			}
		}
		// If edit
		else if(isset( $_POST['submit_button']) && $_POST['submit_button'] == 'Edit') {
			// Get category information from database
			$research_area = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpapl_research_area_table_name WHERE researchAreaID = %d", $_POST['research_area'] ) );
			?><br /><h4>Edit Research Area</h4><?php
			?>
			<form name="edit_research_area" method="post" action="">
				<ul>
					<li><label for="research_area_title">Title: </label>
					<input id="research_area_title" type="text" size="20" maxlength="255" name="research_area_title" value="<?php echo $research_area->title; ?>" /></li>
                    <li><label for="description">Description: </label>
                    <textarea id="description" name="description" cols="60" rows="8"><?php echo $research_area->description; ?></textarea></li> 
                    <li><input type="hidden" name="type" value="submit_edit"  /></li>
                    <li><input type="hidden" name="researchAreaID" value="<?php echo $research_area->researchAreaID; ?>"  /></li>
					<li><input type="submit" name="submit_button" value="Submit" class="button-secondary" /></li>
                </ul>
			</form> <?php
		}
	}
	
	// If POST for submitting an edition
	if( isset( $_POST['type']) && $_POST['type'] == 'submit_edit' ) {
		$result = $wpdb->query( $wpdb->prepare( "UPDATE $wpapl_research_area_table_name SET title = %s, description = %s WHERE researchAreaID = %d", $_POST['research_area_title'], $_POST['description'], $_POST['researchAreaID'] ) );
		if($result) {
			?>
			<div class="updated"><p>Research area <?php echo $_POST['research_area_title']; ?> has been modified.</p></div>
			<?php
		} else {
			?>
			<div class="error"><p>Unable to edit the research area.</p></div>
			<?php
		}		
	}


	// Fetch all people research areas (again incase any update happened)
	$all_research_areas = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_research_area_table_name ORDER BY %s ASC", "title" ) ); 
	
	// ------------------------------------------+
	// Form to edit or delete research area      |
	// ------------------------------------------+
	
	?><br /><h4>Edit or Delete a Research Area</h4><?php
	// Form for selecting user
	?><form name="edit_delete_research_area_form" method="post" action=""> <?php
    	?><ul><?php
			?><li><label for="research_area">Title: </label><?php
            ?><select id="research_area" name="research_area"><?php
			// We got all the IDs, now loop through them to get individual IDs
			foreach ( $all_research_areas as $research_area ) {
				?><option value="<?php echo $research_area->researchAreaID; ?>"><?php echo $research_area->title; ?></option><?php
			}
			?></select></li>
            <li><input type="hidden" name="type" value="edit_delete"  /></li>
			<li><input type="submit" name="submit_button" value="Edit" class="button-secondary" /></li>
			<li><input type="submit" name="submit_button" value="Delete" class="button-secondary" /></li><?php
    	?></ul><?php
	?></form><?php
	
	// ------------------------------------------+
	// Form to add new research area             |
	// ------------------------------------------+
	
	?><br /><h4>Add New Research Area</h4><?php
	// Form for adding new research area
	?>
	<form name="add_research_area_form" method="post" action="">
		<ul>
			<li><label for="research_area_title">Title: </label>
			<input id="research_area_title" type="text" size="20" maxlength="255" name="research_area_title" /></li>
           	<li><label for="description">Description: </label>
			<textarea id="description" name="description" cols="60" rows="8"></textarea></li> 
            <li><input type="hidden" name="type" value="add_research_area"  /></li>
        	<li><input type="submit" name="submit_button" value="Add" class="button-secondary" /></li>
        </ul>
    </form>
	<?php
	
	
	echo '</div>';
}



///////////////////////////////////////////////////////////////////////////////////////////////////////////
// Project administrative page                                                                           //
///////////////////////////////////////////////////////////////////////////////////////////////////////////
function wpapl_admin_project_page() {
	global $wpdb, $wpapl_project_table_name, $wpapl_research_area_table_name;
	
	// Check if user has the required capability
	if(!current_user_can( 'manage_options' ))
	{
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

	// Fetch all research areas (again incase any update happened)
	$all_research_areas = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_research_area_table_name ORDER BY %s ASC", "title" ) ); 
	
	echo '<div class="wrap wpa">';
	
	// If POST for adding project
	if( isset( $_POST['type']) && $_POST['type'] == 'add_project' ) {
		// Adding to the database
		$rseult = $wpdb->insert( $wpapl_project_table_name, array( 'title' => $_POST["project_title"], 'description' => $_POST['description'], 'abstract' => $_POST['abstract'], 'researchAreaID' => $_POST['research_area_id'] ) );
		if( $result ) {
			?>
			<div class="updated"><p><strong>Project <?php echo $_POST['project_title']; ?> has been added to the database.</strong></p></div>
			<?php
		} else {
				?>
				<div class="error"><p>Unable to add the project.</p></div>
				<?php
		}
	}
	
	// If POST for editing or deleting a research area
	if( isset( $_POST['type']) && $_POST['type'] == 'edit_delete' ) {
		// If delete
		if( isset( $_POST['submit_button']) && $_POST['submit_button'] == 'Delete' )
		{
			// Perform deletion on the database
			$result = $wpdb->query( $wpdb->prepare( "DELETE FROM $wpapl_project_table_name WHERE projectID = %d", $_POST['projectID'] ) );
			$wpdb->query( $wpdb->prepare( "DELETE FROM $wpapl_people_project_table_name WHERE projectID = %d", $_POST['projectID'] ) );
			if($result) {
				?>
                <div class="updated"><p><strong>Project has been deleted.</strong></p></div>
                <?php
			} else {
				?>
                <div class="error"><p>Unable to delete the project.</p></div>
                <?php
			}
		}
		// If edit
		else if(isset( $_POST['submit_button']) && $_POST['submit_button'] == 'Edit') {
			// Get category information from database
			$project = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpapl_project_table_name WHERE projectID = %d", $_POST['projectID'] ) );
			?><br /><h4>Edit Project</h4><?php
			?>
			<form name="edit_project" method="post" action="">
				<ul>
					<li><label for="project_title">Title: </label>
					<input id="project_title" type="text" size="20" maxlength="255" name="project_title" value="<?php echo $project->title; ?>" /></li>
                    <li><label for="abstract">Abstract: </label>
                    <textarea id="abstract" name="abstract" cols="60" rows="8"><?php echo $project->abstract; ?></textarea></li> 
                    <li><label for="description">Description: </label>
                    <textarea id="description" name="description" cols="60" rows="8"><?php echo $project->description; ?></textarea></li> 
                    <li><label for="research_area_id">Research Area: </label>
                    <select id="research_area_id" name="research_area_id"><?php
                    // Loop through people categories
                    foreach ( $all_research_areas as $research_area ) {
                        ?><option value="<?php echo $research_area->researchAreaID; ?>" <?php if( $project->researchAreaID == $research_area->researchAreaID ) echo "selected"; ?>><?php echo $research_area->title; ?></option><?php
                        
                    }
                    ?></select>
                    <li><input type="hidden" name="type" value="submit_edit"  /></li>
                    <li><input type="hidden" name="projectID" value="<?php echo $_POST['projectID']; ?>"  /></li>
					<li><input type="submit" name="submit_button" value="Submit" class="button-secondary" /></li>
                </ul>
			</form> <?php
		}
	}
	
	// If POST for submitting an edition
	if( isset( $_POST['type']) && $_POST['type'] == 'submit_edit' ) {
		$result = $wpdb->query( $wpdb->prepare( "UPDATE $wpapl_project_table_name SET title = %s, description = %s, abstract = %s, researchAreaID = %d WHERE projectID = %d", $_POST['project_title'], $_POST['description'], $_POST['abstract'], $_POST['research_area_id'], $_POST['projectID'] ) );
		if($result) {
			?>
			<div class="updated"><p>Project <?php echo $_POST['project_title']; ?> has been modified.</p></div>
			<?php
		} else {
			?>
			<div class="error"><p>Unable to edit the Project.</p></div>
            <?php
		}		
	}


	// Fetch all projects (again incase any update happened)
	$all_projects = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_project_table_name ORDER BY %s ASC", "title" ) ); 

	// ------------------------------------------+
	// Form to edit or delete a project          |
	// ------------------------------------------+
	
	?><br /><h4>Edit or Delete Project</h4><?php
	// Form for selecting user
	?><form name="edit_delete_project_form" method="post" action=""> <?php
    	?><ul><?php
			?><li><label for="projectID">Title: </label><?php
            ?><select id="projectID" name="projectID"><?php
			// We got all the IDs, now loop through them to get individual IDs
			foreach ( $all_projects as $project ) {
				?><option value="<?php echo $project->projectID; ?>"><?php echo $project->title; ?></option><?php
			}
			?></select></li>
            <li><input type="hidden" name="type" value="edit_delete"  /></li>
			<li><input type="submit" name="submit_button" value="Edit" class="button-secondary" /></li>
			<li><input type="submit" name="submit_button" value="Delete" class="button-secondary" /></li><?php
    	?></ul><?php
	?></form><br /><?php
	
	// ------------------------------------------+
	// Form to add new project                   |
	// ------------------------------------------+
	
	?><h4>Add New Project</h4><?php
	// Form for adding new research area
	?>
	<form name="add_project_form" method="post" action="">
		<ul>
			<li><label for="project_title">Title: </label>
			<input id="project_title" type="text" size="40" maxlength="255" name="project_title" /></li>
           	<li><label for="abstract">Abstract: </label>
			<textarea id="abstract" name="abstract" cols="60" rows="8"></textarea></li> 
			<li><label for="description">Description: </label>
			<textarea id="description" name="description" cols="60" rows="8"></textarea></li> 
			<li><label for="research_area_id">Research Area: </label>
            <select id="research_area_id" name="research_area_id"><?php
			// We got all the IDs, now loop through them to get individual IDs
			foreach ( $all_research_areas as $research_area ) {
				?><option value="<?php echo $research_area->researchAreaID; ?>"><?php echo $research_area->title; ?></option><?php
			}
			?></select></li>
            <li><input type="hidden" name="type" value="add_project"  /></li>
        	<li><input type="submit" name="submit_button" value="Add" class="button-secondary" /></li>            
        </ul>
    </form>
    
	<?php
		
	echo '</div>';
}





///////////////////////////////////////////////////////////////////////////////////////////////////////////
// Publications administrative page                                                                           //
///////////////////////////////////////////////////////////////////////////////////////////////////////////
function wpapl_admin_publication_page() {
	global $wpdb, $wpapl_publication_table_name, $wpapl_publication_people_table_name, $wpapl_people_table_name;
	
	// Check if user has the required capability
	if(!current_user_can( 'manage_options' ))
	{
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

	// Fetch all publications
	$all_publications = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_publication_table_name ORDER BY %s ASC", "title" ) ); 
	
	echo '<div class="wrap wpa">';
	
	// If POST for adding publication
	if( isset( $_POST['type']) && $_POST['type'] == 'add_publication' ) {
		// Adding to the database
		$result = $wpdb->insert( $wpapl_publication_table_name, array( 'title' => $_POST["publication_title"], 'other_authors' => $_POST['other_authors'], 'publish_year' => $_POST['publish_year'], 'type' => $_POST['pub_type']
																	, 'type_text' => $_POST['type_text'], 'pdf_url' => $_POST['pdf_url']) );
		if( $result ) {
			?>
			<div class="updated"><p><strong>Publication <?php echo $_POST['publication_title']; ?> has been added to the database.</strong></p></div>
			<?php
		} else {
				?>
				<div class="error"><p>Unable to add the publication.</p></div>
				<?php
		}
	}
	
	// If POST for editing or deleting a publication
	if( isset( $_POST['type']) && $_POST['type'] == 'edit_delete' ) {
		// If delete
		if( isset( $_POST['submit_button']) && $_POST['submit_button'] == 'Delete' )
		{
			// Perform deletion on the database
			$result = $wpdb->query( $wpdb->prepare( "DELETE FROM $wpapl_publication_table_name WHERE publicationID = %d", $_POST['publicationID'] ) );
			$wpdb->query( $wpdb->prepare( "DELETE FROM $wpapl_publication_people_table_name WHERE publicationID = %d", $_POST['publicationID'] ) );
			if($result) {
				?>
                <div class="updated"><p><strong>Publication has been deleted.</strong></p></div>
                <?php
			} else {
				?>
                <div class="error"><p>Unable to delete the publication.</p></div>
                <?php
			}
		}
		// If edit
		else if(isset( $_POST['submit_button']) && $_POST['submit_button'] == 'Edit') {
			// Get category information from database
			$publication = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpapl_publication_table_name WHERE publicationID = %d", $_POST['publicationID'] ) );
			?><br /><h4>Edit Publication</h4><?php
			?>
            <form name="add_publication_form" method="post" action="">
                <ul>
                    <li><label for="publication_title">Title: </label>
                    <input id="publication_title" type="text" size="60" name="publication_title" value="<?php echo $publication->title; ?>" /></li>
                    <li><label for="publish_year">Publishing year: </label>
                    <input id="publish_year" type="text" size="4" name="publish_year" value="<?php echo $publication->publish_year; ?>" />e.g. 2010</li>  
                    <li><label for="other_authors">Other authors: </label>
                    <input id="other_authors" type="text" size="60" name="other_authors" value="<?php echo $publication->other_authors; ?>" /></li>   
                    <li><label for="pdf_url">PDF location: </label>
                    <input id="pdf_url" type="text" size="60" name="pdf_url" value="<? echo $publication->pdf_url; ?>" /></li>                 
                    <li><label for="pub_type">Publication Type: </label>
                    <select id="pub_type" name="pub_type">
                        <option value="journal" <?php if( $publication->type == 'journal' ) echo 'selected'; ?> >Journal</option>
                        <option value="conference" <?php if( $publication->type == 'conference' ) echo 'selected'; ?> >Conference</option>
                        <option value="thesis" <?php if( $publication->type == 'thesis' ) echo 'selected'; ?> >Thesis</option>
                        <option value="thesis" <?php if( $publication->type == 'book' ) echo 'selected'; ?> >Book</option>                        
                    </select></li>                               
                    <li><label for="type_text">Description: </label>
                    <textarea id="type_text" name="type_text" cols="60" rows="8"><?php echo $publication->type_text; ?></textarea></li> 
                    <li><input type="hidden" name="type" value="submit_edit"  /></li>
                    <li><input type="hidden" name="publicationID" value="<?php echo $_POST['publicationID']; ?>"  /></li>
                    <li><input type="submit" name="submit_button" value="Add" class="button-secondary" /></li>
                </ul>
            </form> 
            <?php
		}
	}
	
	// If POST for submitting an edition
	if( isset( $_POST['type'] ) && $_POST['type'] == 'submit_edit' ) {
		$result = $wpdb->query( $wpdb->prepare( "UPDATE $wpapl_publication_table_name SET title = %s, publish_year = %s, other_author = %s, type = %s, type_text = %s, pdf_url = %s WHERE publicationID = %d", $_POST['publication_title'], $_POST['publish_year'], $_POST['other_author'], $_POST['pdf_url'], $_POST['pub_type'], $_POST['type_text'], $_POST['pdf_url'], $_POST['publicationID'] ) );
		if($result) {
			?>
			<div class="updated"><p>Publication <?php echo $_POST['publication_title']; ?> has been modified.</p></div>
			<?php
		} else {
			?>
			<div class="error"><p>Unable to edit the publication.</p></div>
            <?php
		}		
	}

	// If POST for assigning a user to a publication
	if( isset( $_POST['type']) && $_POST['type'] == 'assign_publication' ) {
		
		// first make sure that entry does not exists 
		$temp_result = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_people_publication_table_name WHERE userID = %d, publicationID = %d", $_POST['userID'], $_POST['publicationID'] ) ) ;
		if( !$temp_result ) {	
			
			$result = $wpdb->insert( $wpapl_publication_people_table_name, array( 'userID' => $_POST['userID'], 'publicationID' => $_POST['publicationID'] ) );
			
			if($result) {
				?>
				<div class="updated"><p>The user has been assigned.</p></div>
				<?php
			} else {
				?>
				<div class="error"><p>Unable to assign the user.</p></div>
				<?php
			}
		}
		else {
			?>
			<div class="error"><p>That assignment already exist.</p></div>
			<?php			
		}
	}

	// Fetch all publication (again incase any update happened)
	$all_publications = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpapl_publication_table_name ORDER BY %s ASC", "title" ) ); 

	// ------------------------------------------+
	// Form to edit or delete a publication      |
	// ------------------------------------------+
	
	?><br /><h4>Edit or Delete a Publication</h4><?php
	// Form for selecting user
	?><form name="edit_delete_publication_form" method="post" action=""> <?php
    	?><ul><?php
			?><li><label for="publicationID">Title: </label><?php
            ?><select id="publicationID" name="publicationID"><?php
			// We got all the IDs, now loop through them to get individual IDs
			foreach ( $all_publications as $publication ) {
				?><option value="<?php echo $publication->publicationID; ?>"><?php echo $publication->title; ?></option><?php
			}
			?></select></li>
            <li><input type="hidden" name="type" value="edit_delete"  /></li>
			<li><input type="submit" name="submit_button" value="Edit" class="button-secondary" /></li>
			<li><input type="submit" name="submit_button" value="Delete" class="button-secondary" /></li><?php
    	?></ul><?php
	?></form><br /><?php
	
	// ------------------------------------------+
	// Form to add new publication                   |
	// ------------------------------------------+
	
	?><h4>Add New Publication</h4><?php
	// Form for adding new publication
	?>
	<form name="add_publication_form" method="post" action="">
		<ul>
			<li><label for="publication_title">Title: </label>
			<input id="publication_title" type="text" size="60" name="publication_title" /></li>
			<li><label for="publish_year">Publishing year: </label>
			<input id="publish_year" type="text" size="4" name="publish_year" />e.g. 2010</li>  
			<li><label for="other_authors">Other authors: </label>
			<input id="other_authors" type="text" size="60" name="other_authors" /></li>   
			<li><label for="pdf_url">PDF location: </label>
			<input id="pdf_url" type="text" size="60" name="pdf_url" /></li>                 
			<li><label for="pub_type">Publication Type: </label>
            <select id="pub_type" name="pub_type">
				<option value="journal">Journal</option>
				<option value="conference">Conference</option>
				<option value="thesis">Thesis</option>
				<option value="book">Book</option>                
			</select></li>                               
           	<li><label for="type_text">Description: </label>
			<textarea id="type_text" name="type_text" cols="60" rows="8">For journal, write journal name. For conference, write the conference name, year &amp; location. For thesis, write the abstract.</textarea></li> 
            <li><input type="hidden" name="type" value="add_publication"  /></li>
        	<li><input type="submit" name="submit_button" value="Add" class="button-secondary" /></li>
        </ul>
    </form>
    
	<?php
	// -------------------------------------------+
	// Assign a user to a publication             |
	// -------------------------------------------+
	$all_users_id = $wpdb->get_col( $wpdb->prepare( "SELECT $wpdb->users.ID FROM $wpdb->users ORDER BY %s ASC", "display_name" ) );	
	?><br /><h4>Assign a User to a Publication</h4><?php
	// Form for selecting user and assigning it to a publication
	?><form name="user_to_publication_form" method="post" action=""> <?php
    	?><ul><?php
			?><li><label for="userID">Select user: </label><?php
            ?><select id="userID" name="userID"><?php
			// We got all the IDs, now loop through them to get individual IDs
			foreach ( $all_users_id as $i_users_id ) {
				if( $wpdb->get_var( $wpdb->prepare( "SELECT * FROM $wpapl_people_table_name WHERE userID = %d", $i_users_id ) ) ) {
					$user = wpapl_get_academic_user_info( $i_users_id );
					?><option value="<?php echo $i_users_id; ?>"><?php echo $user->nickname . ': '. $user->full_name; ?></option><?php
				}
			}
			?></select></li>
			<li><label for="publicationID">Select publication: </label><?php
            ?><select id="publicationID" name="publicationID"><?php
			// Print all projects
			foreach ( $all_publications as $publication ) {
				?><option value="<?php echo $publication->publicationID; ?>"><?php echo $publication->title; ?></option><?php
			}
			
			?></select></li>            
            <li><input type="hidden" name="type" value="assign_publication"  /></li><?php
			?><li><input type="submit" value="Assign" class="button-secondary" /></li><?php
			?></select><?php
    	?></ul><?php
	?></form><?php  
	
	
	echo '</div>';
}

