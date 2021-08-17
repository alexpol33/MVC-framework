<?php
namespace application\models;

use application\core\Model;
use application\lib\Db;

class Main extends Model
{

    public function getNews(){
        return $this->db->row('select * from posts');
    }

}