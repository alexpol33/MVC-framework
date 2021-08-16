<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Db;

class MainController extends Controller
{

        public function indexAction(){
            $db = new Db;

            $params = [
                'id' => 2,
            ];

            $data = $db->column('SELECT full_name from users where id = :id', $params);

            debug($data);

            $this->view->render('Главная страница');
            //echo 'Главная Страница';
        }




}