<?php

/**
* @package GoSquaredOfficial
*/
/*
Plugin Name: GoSquared Official
Plugin URI: http://github.com/gosquared/
Description: This is the official GoSquared Plugin for lead capture, live chat and analytics
Version: 1.0.0
Author: Russell Vaughan
License: GPLv2 or later
Text Domain: GoSquared-Offical
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

if ( ! defined ( 'ABSPATH' ) ) {
	die;
}

class GoSquaredOfficial
{
	function __construct() {
		add_action( 'plugins_loaded', array( $this, 'load_tracker' ) );
	}

	function load_tracker() {

	require_once 'includes/gosquared-official-options.php';
	require_once 'includes/gosquared-official-gravity-forms-integration.php';

 	$this->gsOfficialSettings = new GoSquaredOptionsPage;

	add_action( 'wp_head', array( $this, 'gs_snippet' ) );

	$this->project_token = $this->gsOfficialSettings->get( 'gosquared_site_token' );
		if( 1 == absint( $this->gsOfficialSettings->get( 'gosquared_identify' ) ) ) {
 	  	add_action( 'gosquared_identify_snippet', array( $this, 'add_identify' ) );
  	}
		if( 1 == absint( $this->gsOfficialSettings->get( 'gosquared_gravity_forms' ) ) ) {
			$this->gsGfint = new GoSquaredGFIntegration($this->project_token);
		}
	}
	 function gs_snippet()  {
    echo "<script>";
    echo "!function(g,s,q,r,d){r=g[r]=g[r]||function(){(r.q=r.q||[]).push(";
    echo  "arguments)};d=s.createElement(q);q=s.getElementsByTagName(q)[0];";
    echo  "d.src='//d1l6p2sc9645hc.cloudfront.net/tracker.js';q.parentNode.";
    echo  "insertBefore(d,q)}(window,document,'script','_gs');";
		echo	"_gs('" . $this->gsOfficialSettings->get( 'gosquared_site_token' ) . "');";
	  do_action( 'gosquared_identify_snippet' );
  	echo  "</script>";
	 }

	public function add_identify() {
		$current_user=wp_get_current_user();
		$properties = array();
		$this->properties['custom']=array();
		$this->properties['email'] = $current_user->user_email;
		$this->properties['first_name']= $current_user->user_firstname;
		$this->properties['last_name'] = $current_user->user_lastname;
		$this->properties['custom']['username']= $current_user->user_login;

		if ($this->properties['email'] && $this->properties['email'] !== null && $this->properties['email'] !== '') {
			echo "_gs('identify'," . json_encode($this->properties) . ")";
		}
	}
}

if ( class_exists( 'GoSquaredOfficial' ) ) {
	$gsOfficial = new GoSquaredOfficial();
}

add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'my_plugin_action_links' );

function my_plugin_action_links( $links ) {
$links = array_merge( array(
	'<a href="' . esc_url( admin_url( '/options-general?page=gosquared-official-plugin.php' ) ) . '">' . __( 'Settings', 'textdomain' ) . '</a>'
), $links );
return $links;
}
