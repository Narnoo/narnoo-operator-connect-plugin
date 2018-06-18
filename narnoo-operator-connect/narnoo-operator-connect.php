<?php
/*
Plugin Name: Narnoo Operator Connect
Plugin URI: http://narnoo.com/
Description: Allows Wordpress users to connect with other Narnoo products and import their listings into their website.
Version: 1.0.0
Author: Narnoo Wordpress developer
Author URI: http://www.narnoo.com/
License: GPL2 or later
*/

/*  Copyright 2018  Narnoo.com  (email : info@narnoo.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
// plugin definitions
define( 'NARNOO_OPERATOR_CONNECT_PLUGIN_NAME', 'Narnoo Operator Connect' );
define( 'NARNOO_OPERATOR_CONNECT_CURRENT_VERSION', '1.0.0' );
define( 'NARNOO_OPERATOR_CONNECT_I18N_DOMAIN', 'narnoo-operator-connect' );

define( 'NARNOO_OPERATOR_CONNECT_URL', plugin_dir_url( __FILE__ ) );
define( 'NARNOO_OPERATOR_CONNECT_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

// include files
if( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

//require_once( NARNOO_OPERATOR_CONNECT_PLUGIN_PATH . 'class-narnoo-operator-followers-table.php' );
require_once( NARNOO_OPERATOR_CONNECT_PLUGIN_PATH . 'class-operator-connect-helper.php' );
require_once( NARNOO_OPERATOR_CONNECT_PLUGIN_PATH . 'class-narnoo-connect-find-table.php' );

require_once( NARNOO_OPERATOR_CONNECT_PLUGIN_PATH . 'libs/narnoo-api-authenticate.php' );
require_once( NARNOO_OPERATOR_CONNECT_PLUGIN_PATH . 'libs/narnoo-api-functions.php' );

// begin!
new Narnoo_Operator_Connect();

class Narnoo_Operator_Connect {

	/**
	 * Plugin's main entry point.
	 **/
	function __construct() {
		if ( is_admin() ) {

			add_action( 'admin_menu', array( &$this, 'create_menu' ) );

		}else{
		
			

		}
		
		
	}

	/**
	*	Create the shortcode help menu
	**/
	function create_menu(){	

		add_menu_page( 
			__('Narnoo Operator Connect', 	NARNOO_OPERATOR_CONNECT_I18N_DOMAIN), 
			__('Connect', 			NARNOO_OPERATOR_CONNECT_I18N_DOMAIN),  
			'manage_options', 
			'narnoo_operator_connect', 
			array( &$this, 'find_page' ), 
			NARNOO_OPERATOR_CONNECT_URL . 'images/icon-16.png'
			);
		
		$page = add_submenu_page(
			'narnoo_operator_connect',
			__( 'Find', NARNOO_OPERATOR_CONNECT_I18N_DOMAIN ),
			__( 'Find', NARNOO_OPERATOR_CONNECT_I18N_DOMAIN ),
			'manage_options',
			'narnoo-operator-find',
			array( &$this, 'find_page' )
		);
		add_action( "load-$page", array( 'Narnoo_Connect_Find_Table', 'add_screen_options' ) );
		

		$page = add_submenu_page(
			'narnoo_operator_connect',
			__( 'Following', NARNOO_OPERATOR_CONNECT_I18N_DOMAIN ),
			__( 'Following', NARNOO_OPERATOR_CONNECT_I18N_DOMAIN ),
			'manage_options',
			'narnoo-operator-following',
			array( &$this, 'following_page' )
		);
		add_action( "load-$page", array( 'Narnoo_Connect_Find_Table', 'add_screen_options' ) );

	}

		
	
	function find_page(){
		global $narnoo_connect_find_table;
		?>
		<div class="wrap">
			<div class="icon32"><img src="<?php echo NARNOO_OPERATOR_CONNECT_PLUGIN_URL; ?>/images/icon-32.png" /><br /></div>
			<h2><?php _e( 'Narnoo Connect - Find Operators', NARNOO_OPERATOR_CONNECT_I18N_DOMAIN ) ?></h2>
				<form id="narnoo-find-form" method="post" action="?<?php echo esc_attr( build_query( array( 'page' => isset( $_REQUEST['page'] ) ? $_REQUEST['page'] : '', 'paged' => $narnoo_connect_find_table->get_pagenum() ) ) ); ?>">

				<?php
				
				if ( $narnoo_connect_find_table->prepare_items() ) {
					$narnoo_connect_find_table->display();
				}
				
				?>
				</form>
		</div>
		<?php
	}

	/**
	 * Display Narnoo Followers page.
	 **/
	function following_page() {
		global $narnoo_connect_find_table;
		?>
		<div class="wrap">
			<div class="icon32"><img src="<?php echo NARNOO_OPERATOR_CONNECT_PLUGIN_URL; ?>/images/icon-32.png" /><br /></div>
			<h2><?php _e( 'Narnoo Connect - Following Operators', NARNOO_OPERATOR_CONNECT_I18N_DOMAIN ) ?></h2>
				<form id="narnoo-find-form" method="post" action="?<?php echo esc_attr( build_query( array( 'page' => isset( $_REQUEST['page'] ) ? $_REQUEST['page'] : '', 'paged' => $narnoo_connect_find_table->get_pagenum() ) ) ); ?>">

				<?php
				
				if ( $narnoo_connect_find_table->prepare_items() ) {
					$narnoo_connect_find_table->display();
				}
				
				?>
				</form>
		</div>
		<?php
	}

	


}
