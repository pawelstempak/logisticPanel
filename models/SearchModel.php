<?php
/* models/SearchModel.php */

namespace app\models;
use \PDO;
use app\core\Application;

class SearchModel
{
    public function searchRequest($getBody)
    {
        $db_request = Application::$core->con->pdo->prepare('
                                    SELECT *
                                    FROM orders
                                    WHERE tracking = :tracking
        ');
        $db_request->execute(['tracking' => $getBody['tracking']]);
        
        $tracking_result = $db_request->fetchAll(PDO::FETCH_ASSOC);

        return $tracking_result;        
    }
}