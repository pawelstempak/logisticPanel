<?php
/* controllers/SearchController.php */

namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\core\Auth;
use app\models\SearchModel;

class SearchController extends Controller
{
    public $search;

    public function __construct()
    {
        $this->search = new SearchModel();
    }

    public function searchForm(Request $request)
    {   
        $params['searchresult'] = "";
        if($request->isPost())
        {
            $search_result = $this->search->searchRequest($request->getBody());
            $params = [
                'searchresult' => $search_result
            ];
            return $this->render('search', $params);            
        }
        return $this->render('search', $params);
    }
}