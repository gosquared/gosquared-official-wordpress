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
		add_action( 'plugins_loaded', array( $this, 'loadTracker' ) );
	}

	function loadTracker() {
	 add_action( 'wp_footer', array( $this, 'gs_snippet' ) );
	}

	 function gsSnippet() { 

    <script>
      !function(g,s,q,r,d){r=g[r]=g[r]||function(){(r.q=r.q||[]).push(
      arguments)};d=s.createElement(q);q=s.getElementsByTagName(q)[0];
      d.src='//d1l6p2sc9645hc.cloudfront.net/tracker.js';q.parentNode.
      insertBefore(d,q)}(window,document,'script','_gs');
     _gs('GSN-628668-H'); 
    </script>
  
  } 

}

if ( class_exists( 'GoSquaredOfficial' ) ) {
	$gsOfficial = new GoSquaredOfficial();
}
