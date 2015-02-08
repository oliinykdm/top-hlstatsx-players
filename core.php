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

require_once('include/config.php');

$playerOutput = null;
$output = null;
$navigation = null;
$print = null;

$_gameType = $_GET['game'];

$itemsPerPage = $_config_itemsPerPage;
$pages = ceil(Model::instance()->getPlayersCount($_gameType) / $itemsPerPage);
$page = (isset($_GET['page']) && $_GET['page'] <= Model::instance()->getPlayersCount($_gameType) ? $_GET['page'] : 1);
$offset = ($page - 1) * $itemsPerPage;
$start = ($page > 5) ? $page - 4 : 1;

if ($pages > 1)
{
	$navigation = $_config_paginationName;
	for ($i = $start; $i <= $pages; $i++)
	{
		if ($page > 4 && $i == $page - 4)
		{
			$navigation = $navigation . '<a href="javascript:void(0);" onClick="getTopPlayers(\'' . $_gameType . '\', ' . $i . ')">&laquo;</a>' . "\n";
			continue;
		}

		if ($i > $page + 3)
		{
			$navigation = $navigation . '<a href="javascript:void(0);" onClick="getTopPlayers(\'' . $_gameType . '\', ' . $i . ')">&raquo;</a>' . "\n";
			break;
		}

		if ($i == $page)
		{
			$navigation = $navigation . ' <span style="font-weight: bold;"> ' . $i . ' </span> ' . "\n";
		}
		else
		{
			$navigation = $navigation . '<a href="javascript:void(0);" onClick="getTopPlayers(\'' . $_gameType . '\', ' . $i . ')">' . $i . '</a>' . "\n";
		}
	}
}

$offset = htmlspecialchars($offset);
$itemsPerPage = htmlspecialchars($itemsPerPage);

if ($page > 0)
{
	if ($page <= $pages)
	{
		foreach(Model::instance()->getPlayersList($_gameType, $offset, $itemsPerPage) as $player)
		{
			$nickname = $player['lastName'];
			$score = $player['skill'];
			$country = strtolower($name = $player['flag']);
			if (empty($country))
			{
				$country = '0';
			}

			$rating = $player['last_skill_change'];
			$playerId = $player['playerId'];
			if ($rating <= 0)
			{
				$rating = '<img src="' . $_config_hlstatsImgPath . '/t2.gif" alt="' . $_config_playerDownDesc . '" title="' . $_config_playerDownDesc . '" />';
			}
			else
			{
				if ($rating > 0)
				{
					$rating = '<img src="' . $_config_hlstatsImgPath . '/t0.gif" alt="' . $_config_playerUpDesc . '" title="' . $_config_playerUpDesc . '"  />';
				}
			}

			if (mb_strlen($nickname, 'UTF-8') > $_config_playerNameCut)
			{
				$nickname = mb_substr($nickname, 0, $_config_playerNameCut, 'UTF-8') . "...";
			}

			foreach(Model::instance()->getPlayerRank($_gameType, $score) as $rank)
			{
				$line = file_get_contents('include/template/line.php');
				$replace = ['%RANK%' => $rank['count'] + 1, '%FLAG%' => $_config_hlstatsImgPath . '/flags/' . $country . '.gif', '%PLAYER_ID%' => $playerId, '%HLSTATS_PATH%' => $_config_hlstatsPath, '%NICKNAME%' => $nickname, '%SCORE%' => $score, '%RATING%' => $rating];
				$output.= str_replace(array_keys($replace) , array_values($replace) , $line);
			}
		}
	}
}

$mainTemplate = file_get_contents('include/template/main.php');
$replace = ['%OUTPUT%' => $output, '%NAVIGATION%' => $navigation, '%PLAYER%' => $_config_TrPlayer, '%SCORE%' => $_config_TrPlayerScore];
$print .= str_replace(array_keys($replace) , array_values($replace) , $mainTemplate);
print $print;
