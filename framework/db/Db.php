<?php
namespace framework\db;

use framework\Component;

class Db extends Component {
    protected $dbhost;
    protected $dbname;
    protected $dbuser;
    protected $dbpass;

    private $_connection;

    public function init($params = []){
        parent::init($params);
        $dsn = "mysql:host={$this->dbhost};dbname={$this->dbname}";
        $this->_connection = new \PDO($dsn, $this->dbuser, $this->dbpass);
    }

    public function getConnection(){
        return $this->_connection;
    }

    public function query($sql){
        $conn = $this->getConnection();

        if(empty($sql)){
            return;
        }
        $res = [];
        foreach($conn->query($sql, \PDO::FETCH_ASSOC) as $row){
            $res[] = $row;
        }
        return $res;
    }
}