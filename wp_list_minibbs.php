<?php
/*
Plugin Name: WP miniBB Boards
Plugin URI: http://www.lazybrain.de/wordpress-wp-minibb-boards-plugin.html
Description: Outputs all Boards from an minibb Forum http://www.minibb.net/
Author: Chris "Lazy" Kopp
Version: 0.1.2
*/
/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
http://www.gnu.org/licenses/gpl.html
*/

// wp_list_minibbs
function wp_list_minibbc()
{
global $wpdb;


// PLEASE FILL IT OUT.. its really needed, boys.. ;)
$prefix = "minibbtable_"; // Prefix of the minibb database tables (e.g. minibb_)

$LIMIT = "DESC LIMIT 0,2"; // Show only 5 Boards? Insert it like "LIMIT 5", show all boards -> do nothing here

$utb = "/forum"; // URL to minibb boards.. e.g. domain.de/board then insert something like /board , no backslash please..

$modrewrite = "1"; // if using minibb`s rewrite rules, please insert 1, if not.. nothing.


$sqlit = "SELECT SQL_CACHE forum_id, forum_name, topics_count, posts_count FROM " . $prefix . "forums ORDER BY forum_name " . $LIMIT . "";

$boards = $wpdb->get_results($sqlit);

foreach ($boards as $board)
	{
echo "<li>";

if ($modrewrite = '1') 	{
echo "<a href=\"" . $utb . "/" . $board->forum_id . "_0.html\" title=\"" .
$board->forum_name . "\">";
	} else {
echo "<a href=\"" . $utb . "/index.php?action=vtopic&amp;forum=" . $board->forum_id . ">";
	}
echo "<b>" . $board->forum_name . "</b></a> (Topics: " . $board->topics_count . " Posts: " . $board->posts_count . ")</li>";
	}
}
?>