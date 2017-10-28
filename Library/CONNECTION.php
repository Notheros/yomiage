<?php

class CONNECTION {

    /**
     * @var Connection 
     */
    private static $instance;
    //
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "yomiage";
    private $link;
    private $result;

    private function __construct() {
        $this->connect();
    }

    /**
     * @return Connection
     */
    public static function getInstance() {
        if (!isset(self::$instance)) {
            $c = new Connection();
            self::$instance = $c;
        }

        return self::$instance;
    }

    public function __destruct() {
        $this->disconnect();
    }

    private function connect() {
        if (isset($this->link)) {
            return true;
        } else {
            $this->link = @mysqli_connect($this->host, $this->user, $this->password, $this->database);
            mysqli_set_charset($this->link, "utf8mb4");
            return true;
        }
    }

    private function disconnect() {
        @mysqli_close($this->link);
    }

    public function executeQuery($query) {
        if (($this->result = @mysqli_query($this->link, $query))) {
            return true;
        } else {
            //SESSION::redirect("tmwork.php");
            echo @mysqli_error($this->link);
            die();
        }
    }

    public function prox() {
        if (isset($this->result)) {
            if ($row = mysqli_fetch_assoc($this->result)) {
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getNumRows() {
        if (isset($this->result)) {
            return @mysqli_num_rows($this->result);
        } else {
            return 0;
        }
    }

    public function getStatus() {
        return mysqli_stat($this->link);
    }

    public function ping() {
        return mysqli_ping($this->link);
    }

    public function lastId() {
        return mysqli_insert_id($this->link);
    }

    public function debugResult() {
        $array = $this->getArrayFromResult();
        if ($array) {
            foreach ($array as $key => $value) {
                echo "<pre>$key - " . print_r($value, true) . "</pre>";
            }
        } else {
            return false;
        }
    }

    public function getRowAttribute($attribute) {
        if (isset($this->result)) {
            if ($row = mysqli_fetch_assoc($this->result)) {
                return $row[$attribute];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getResultRows() {
        if ($this->link) {
            return mysqli_affected_rows($this->link);
        } else {
            return 0;
        }
    }

    public function isResult() {
        if ($this->getResultRows() >= 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getArrayFromResult() {
        if ($this->isResult()) {
            $arr = array();
            while ($row = $this->prox()) {
                $arr[] = $row;
            }
            return $arr;
        } else {
            return false;
        }
    }

    public function getJsonFromResult() {
        if ($this->isResult()) {
            $arr = array();
            while ($row = $this->prox()) {
                $arr[] = $row;
            }
            return json_encode($arr);
        } else {
            return false;
        }
    }

    public function getRow() {
        if ($this->isResult()) {
            return $this->prox();
        } else {
            return false;
        }
    }

    public function getSingleArray() {
        if ($this->isResult()) {
            $arr = array();
            while ($res = $this->prox()) {
                $chave = array_keys($res);
                $chave_nome = $chave[0];
                $arr[] = $res["{$chave_nome}"];
            }
            return $arr;
        } else {
            return false;
        }
    }

    public function getUniqueSingleArray() {
        if ($this->isResult()) {
            $arr = array();
            while ($res = $this->prox()) {
                $chave = array_keys($res);
                $chave_nome = $chave[0];
                $arr[] = $res["{$chave_nome}"];
            }
            return array_unique($arr);
        } else {
            return false;
        }
    }

}
