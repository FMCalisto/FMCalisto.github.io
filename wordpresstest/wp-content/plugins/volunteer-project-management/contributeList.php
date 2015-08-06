<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class contribute_Table extends WP_List_Table {
                    var $data = null;
                    
                    function __construct($data){
                        global $status, $page;
                        $this->data = $data;

                        //Set parent defaults
                        parent::__construct( array(
                            'singular'  => 'project',     //singular name of the listed records
                            'plural'    => 'projects',    //plural name of the listed records
                            'ajax'      => false        //does this table support ajax?
                        ) );

                    }
                    function column_default($item, $column_name){
                        
                        switch($column_name){
                            case 'vpm_excerpt':
                            case 'vpm_endDate':
                            case 'vpm_downloads':
                            case 'vpm_contributions':
                                return $item[$column_name];
                            default:
                                return print_r($item,true); //Show the whole array for troubleshooting purposes
                        }
                    }
                    function column_title($item){
        
                        //Build row actions
                        $actions = array(
                            'view'      => sprintf('<a href="?post_type=vpm-project&page=%s&action=%s&post=%s">'.__('View details',"VolunteerProjectManagement").'</a>',$_REQUEST['page'],'view',$item['ID']),
                            'contribute'    => sprintf('<a href="?post_type=vpm-project&page=%s&action=%s&post=%s">'.__('Contribute',"VolunteerProjectManagement").'</a>',$_REQUEST['page'],'contribute',$item['ID']),
                        );

                        //Return the title contents
                        //return sprintf('%1$s <span style="color:silver">(id:%2$s)</span>%3$s',
                        return sprintf('%1$s %3$s',        
                            /*$1%s*/ $item['title'],
                            /*$2%s*/ $item['ID'],
                            /*$3%s*/ $this->row_actions($actions)
                        );
                    }
                    /*function column_cb($item){
                        return sprintf(
                            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
                            /*$1%s*/ //$this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
                            /*$2%s*/ //$item['ID']                //The value of the checkbox should be the record's id
                        //);
                    //}
                    function get_columns(){
                        $columns = array(
                            //'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
                            'title'     => __( 'Vol. Projects',"VolunteerProjectManagement"),
                            'vpm_excerpt' => __( 'Excerpt' ),
                            'vpm_endDate' => __( 'End Date'),
                            'vpm_downloads' => __('Downloads',"VolunteerProjectManagement"),
                            'vpm_contributions' => __('Contributions',"VolunteerProjectManagement")
                        );
                        return $columns;
                    }
                    function get_sortable_columns() {
                        $sortable_columns = array(
                            'title'     => array('title',true),     //true means its already sorted
                            'vpm_excerpt'     => array('vpm_excerpt',true),     //true means its already sorted
                            'vpm_endDate'    => array('vpm_endDate',false),
                            'vpm_downloads'  => array('vpm_downloads',false),
                            'vpm_contributions' => array('vpm_contributions',false),
                        );
                        return $sortable_columns;
                    }
                    /*function get_bulk_actions() {
                        $actions = array(
                            'delete'    => 'Delete'
                        );
                        return $actions;
                    }*/
                    function process_bulk_action() {
                        //Detect when a bulk action is being triggered...
                        /*if( 'delete'===$this->current_action() ) {
                            wp_die('Items deleted (or they would be if we had items to delete)!');
                        }*/
                    }
                    function prepare_items() {

                        $per_page = 5;

                        $columns = $this->get_columns();
                        $hidden = array();
                        $sortable = $this->get_sortable_columns();

                        $this->_column_headers = array($columns, $hidden, $sortable);

                        
                        $this->process_bulk_action();

                        $data = $this->data;
                        function usort_reorder($a,$b){
                            $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'title'; //If no sort, default to title
                            $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'asc'; //If no order, default to asc
                            $result = strcmp($a[$orderby], $b[$orderby]); //Determine sort order
                            return ($order==='asc') ? $result : -$result; //Send final sort direction to usort
                        }
                        usort($data, 'usort_reorder');


                        $current_page = $this->get_pagenum();

                        $total_items = count($data);

                        $data = array_slice($data,(($current_page-1)*$per_page),$per_page);

                        $this->items = $data;


                        $this->set_pagination_args( array(
                            'total_items' => $total_items,                  //WE have to calculate the total number of items
                            'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
                            'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
                        ) );
                    }
                }
?>
