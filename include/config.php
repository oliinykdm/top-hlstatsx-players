<?php
// +---------------------------------------------------------------------------------------+
// | Top HLStatsX Players                                                                  |
// | Software is licensed under the GNU GPL v2. Prohibited for use in commercial software. |
// +---------------------------------------------------------------------------------------+
// | Version 0.115                                                                         |
// +---------------------------------------------------------------------------------------+
// | Author: Dima Oliynyk                                                                  |
// | Email: <dima@dima.rv.ua>                                                              |
// | Web-site: www.dima.rv.ua                                                              |
// +---------------------------------------------------------------------------------------+

include_once('database.class.php');
include_once('model.class.php');

/* --- Database --- */

/* Edit file include/database.class.php */

/* --- CONFIG --- */
$_config_itemsPerPage = 10; // players per page (10 - default)
$_config_paginationName = 'Page: '; // pagination title
$_config_hlstatsPath = 'http://hlstatsx1.uasource.com'; // path to hlstats dir (without slash /)
$_config_hlstatsImgPath = 'http://hlstatsx1.uasource.com/hlstatsimg'; // path to hlstatsimg dir (without slash /)
$_config_playerUpDesc = 'Player rating increased'; // description of player rating up (img alt, title)
$_config_playerDownDesc = 'Player rating dropped'; // description of player rating down (img alt, title)
$_config_playerNameCut = 14; // the number of characters to cut username (e.g. PlayerNa..., PlayerNam...)
$_config_TrPlayer = 'Player'; // description of table row
$_config_TrPlayerScore = 'Score'; // description of table row


