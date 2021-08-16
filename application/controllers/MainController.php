<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Db;

class MainController extends Controller
{

        public function indexAction(){
            $db = new Db;
            $data = $db->row('SELECT full_name from users');
            debug($data);
            $this->view->render('Главная страница');
            //echo 'Главная Страница';
        }




}