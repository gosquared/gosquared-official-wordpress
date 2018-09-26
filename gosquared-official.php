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
 	$this->gsOfficialSettings = new GoSquaredOptionsPage;
	 add_action( 'wp_footer', array( $this, 'gs_snippet' ) );
	 add_action( 'gosquared_identify_snippet', array( $this, 'add_identify' ) );
	}

	 function gs_snippet()  { ?>
    <script>
      !function(g,s,q,r,d){r=g[r]=g[r]||function(){(r.q=r.q||[]).push(
      arguments)};d=s.createElement(q);q=s.getElementsByTagName(q)[0];
      d.src='//d1l6p2sc9645hc.cloudfront.net/tracker.js';q.parentNode.
      insertBefore(d,q)}(window,document,'script','_gs');

			_gs('<?php echo $this->gsOfficialSettings->get( 'gosquared_site_token' ); ?>');
			<?php do_action( 'gosquared_identify_snippet' ); ?>
    </script>

	<?php }

	public function add_identify() { global $current_user;  wp_get_current_user(); ?>
	_gs('identify', {
	username: '<?php echo $current_user->user_login; ?>',
	email:    '<?php echo $current_user->user_email; ?>'
});
<?php }


}


if ( class_exists( 'GoSquaredOfficial' ) ) {
	$gsOfficial = new GoSquaredOfficial();
}
