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

Class Model {
    public static $instance = null;
    public static function instance()
    {
        if (is_null(self::$instance) === true)
        {
            self::$instance = new Model();
        }
        return self::$instance;
    }
    public function getPlayersCount($game = 'csgo') {
        $query = Database::interpolateQuery("SELECT COUNT(*) AS `count`
                  FROM `hlstats_Players`
                  WHERE game = ':game'", ['game' => $game]);
        $prepared = Database::instance()->query($query);
        return $prepared->fetch()['count'];
    }
    public function getPlayersList($game = 'csgo', $offset = 1, $limit = 10) {
        $query = Database::interpolateQuery("SELECT *
                  FROM `hlstats_Players`
                  WHERE game = ':game'
                  ORDER BY skill DESC
                  LIMIT :offset, :limit", ['game' => $game, 'offset' => $offset, 'limit' => $limit]);
        $prepared = Database::instance()->query($query, PDO::FETCH_ASSOC);
        return $prepared->fetchAll();
    }
    public function getPlayerRank($game = 'csgo', $score = 1000) {
        $query = Database::interpolateQuery("SELECT COUNT(*) as `count`
                 FROM hlstats_Players
                 WHERE game = ':game'
                 AND skill > :skill
                 AND hideranking = 0
                 AND kills >= 1
                 AND IF(86400 * 21 > (UNIX_TIMESTAMP() - hlstats_Players.last_event), UNIX_TIMESTAMP() - hlstats_Players.last_event, -1 ) >= 0", ['game' => $game, 'skill' => $score]);
        $prepared = Database::instance()->query($query);
        return $prepared->fetchAll();
    }
}