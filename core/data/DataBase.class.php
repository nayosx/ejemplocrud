<?php
abstract class DataBase {
    const HOST = 'host';
    const DATABASE = 'database';
    const USER = 'user';
    const PASSWORD = 'password';
    const PORT = 'port';
    const CHARTSET = 'chartset';
    //put your code here
    private $_host;
    private $_database;
    private $_user;
    private $_pass;
    private $_port;
    private $_chartset;
    private $_error;
    protected $connection; //database handler
    protected $stmt;
    protected $lastquery = NULL;
    private static $_instance; // singlenton instance

    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct($config = array()) {
        if (!empty($config)) {
            $this->_host = $config[self::HOST];
            $this->_database = $config[self::DATABASE]; //northwind
            $this->_user = $config[self::USER];
            $this->_pass = $config[self::PASSWORD];
            $this->_port = (!empty($config[self::PORT])) ? "port={$config[self::PORT]};" : '';
            $this->_chartset = (!empty($config[self::CHARTSET])) ? "charset={$config[self::CHARTSET]}" : 'charset=utf8'; 
            
            $dns = "mysql:host={$this->_host};{$this->_port}dbname={$this->_database};{$this->_chartset}";
            $options = array(
                PDO::ATTR_PERSISTENT => TRUE,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            try {
                $this->connection = new PDO($dns, $this->_user, $this->_pass, $options);
            } catch (PDOException $e) {
                $this->_error = $e->getMessage();
                echo $e->getMessage();
            }
        } else {
            die("Connection failed: No params to conetion");
        }
    }

    function __destruct() {
        $this->conexion = null;
    }

    /**
     * 
     * @param type string
     * @param type array
     * @return boolean
     */
    public function execute($statement, $params) {
        try {
            $this->stmt = $this->connection->prepare($statement);
            if ($params != NULL) {
                $this->bindParams($params);
            }
            $this->lastquery = $this->stmt->queryString;
            return $this->stmt->execute();
        } catch (Exception $ex) {
            $this->_error = $ex->getMessage();
            return FALSE;
        }
    }

    /**
     * Devulve el numero de filas afectadas tras la consulta previa
     * @return int
     */
    public function affected_rows() {
        return $this->stmt->rowCount();
    }

    public function beginTransaction() {
        $this->connection->beginTransaction();
    }

    public function commit() {
        $this->connection->commit();
    }

    public function rollBack() {
        $this->connection->rollBack();
    }

    /**
     * Retorna el ultimo id insertado en la base de datos
     * @return int
     */
    public function lastInsertId() {
        return $this->connection->lastInsertId();
    }

    /**
     * 
     * @return string
     */
    public function getError() {
        return $this->_error;
    }

    /**
     * 
     * @param type string
     * @return boolean / array
     */
    public function getColumnsNameForThisTable($table) {
        try {
            if (is_string($table)) {
                $tabla = filter_var($table, FILTER_SANITIZE_STRING);
                $query = "SELECT * FROM {$tabla} LIMIT 1";
                $result = $this->connection->query($query);
                $fields = array_keys($result->fetch(PDO::FETCH_ASSOC));
                return $fields;
            } else {
                return FALSE;
            }
        } catch (Exception $ex) {
            $this->_error = $ex->getMessage();
            return FALSE;
        }
    }

    public function setLastQuery($lastquery) {
        $this->lastquery = $lastquery;
    }

    public function getLastQuery() {
        return $this->lastquery;
    }

    public function getStmt() {
        return $this->stmt;
    }

    public function getCon() {
        return $this->connection;
    }

    /* de a poco se han ido mejorando los query, seriea bueno 
     * volver a crear esto, con los query necesarios, es probable que existan
     * metodos similares, pero desde esta linea es que se han arreglado
     */

    protected function bindValues($values) {
        $type = NULL;
        foreach ($values as $column => $val) {
            switch ($val) {
                case is_int($val):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($val):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($val):
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;
            }
            $this->stmt->bindValue($column, $val, $type);
        }
    }

    protected function bindParams($params) {
        $type = NULL;
        foreach ($params as $column => $val) {
            switch ($val) {
                case is_int($val):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($val):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($val):
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;
            }
            $this->stmt->bindValue($column, $val, $type);
        }
    }

    public function result_array($statement, $params) {
        try {
            $this->stmt = $this->connection->prepare($statement);
            if ($params != NULL) {
                $this->bindParams($params);
            }
            $this->lastquery = $this->stmt->queryString;
            $this->stmt->execute();
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            $this->_error = $ex->getMessage();
        }
    }

    public function result($statement, $params = NULL) {
        try {
            $this->stmt = $this->connection->prepare($statement);
            if ($params != NULL) {
                $this->bindParams($params);
            }
            $this->lastquery = $this->stmt->queryString;
            $this->stmt->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            $this->_error = $ex->getMessage();
        }
    }

    public function result_index($statement, $params = NULL) {
        try {
            $this->stmt = $this->connection->prepare($statement);
            if ($params != NULL) {
                $this->bindParams($params);
            }
            $this->lastquery = $this->stmt->queryString;
            $this->stmt->execute();
            return $this->stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $ex) {
            $this->_error = $ex->getMessage();
        }
    }

    public function row($statement, $params = NULL) {
        try {
            $this->stmt = $this->connection->prepare($statement);
            if ($params != NULL) {
                $this->bindParams($params);
            }
            $this->lastquery = $this->stmt->queryString;
            $this->stmt->execute();
            return $this->stmt->fetchObject();
        } catch (Exception $ex) {
            $this->_error = $ex->getMessage();
        }
    }

    public function row_array($statement, $params = NULL) {
        try {
            $this->stmt = $this->connection->prepare($statement);
            if ($params != NULL) {
                $this->bindParams($params);
            }
            $this->lastquery = $this->stmt->queryString;
            $this->stmt->execute();
            return $this->stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            $this->_error = $ex->getMessage();
        }
    }

    public function getArrayIndex($statement, $params = NULL) {
        try {
            $this->stmt = $this->connection->prepare($statement);
            if ($params != NULL) {
                $this->bindParams($params);
            }
            $this->lastquery = $this->stmt->queryString;
            $this->stmt->execute();
            return $this->stmt->fetch(PDO::FETCH_BOTH);
        } catch (Exception $ex) {
            $this->_error = $ex->getMessage();
        }
    }

}
