<?php
class MP_Tracking_module_u005 extends MP_tracking_module_
{
	var $id	= 'u005';
	var $context= 'side';
	var $file 	= __FILE__;

	function meta_box($mp_user)
	{
		global $wpdb;

		$tracks = $wpdb->get_results( $wpdb->prepare( "SELECT context, count(*) as count FROM $wpdb->mp_tracks WHERE user_id = %d AND mail_id <> 0 GROUP BY context ORDER BY context;", $mp_user->id) );

		if ($tracks)
		{
			$total = 0;
			foreach($tracks as $track)
			{
				$context[$track->context] = $track->count;
				$total += $track->count;
			}
			foreach($context as $k => $v)
			{
				echo '<b>' . $k . '</b> : &#160;' . sprintf("%01.2f %%",100 * $v/$total ) . '&#160;&#160;&#160;&#160;';
			}
			echo '<br />';
		}
		echo '<br />';
		$tracks = $wpdb->get_results( $wpdb->prepare( "SELECT DISTINCT agent, ip FROM $wpdb->mp_tracks WHERE user_id = %d LIMIT 10;", $mp_user->id) );
		if ($tracks) foreach($tracks as $track) {echo MailPress_tracking::get_os($track->agent) . ' ' . MailPress_tracking::get_browser($track->agent) . '&#160;&#160;&#160;@&#160;' . $track->ip . '<br />'; }
	}
}
new MP_Tracking_module_u005(__('System info', MP_TXTDOM));