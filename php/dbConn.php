<?php
include_once('constants.php');

class dbConn
{
    private $host = HOST;
    private $user = USER;
    private $password = PASSWORD;
    private $db = DB;
    private $charset = "utf8mb4";

    private $pdo = null;
    private $dsn;
    private $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    /**
     * dbConn constructor.
     */
    public function __construct()
    {
        $this->dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";

        try {
            $this->pdo = new PDO($this->dsn, $this->user, $this->password, $this->options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * @param $table
     * @param $data
     * @return string
     */
    public function buildInsertQuery($table, $data)
    {
        $column_array = array_keys($data);
        $values_array = array_values($data);

        $column_statement = '(';
        foreach ($column_array as $column) {
            $column_statement .= ' ' . $column . ',';
        }
        $columns = substr($column_statement, 0, -1) . ')';

        $values_statement = '(';
        foreach ($values_array as $value) {
            if (is_int($value)) {
                $values_statement .= '' . $value . ',';
            } else {
                $values_statement .= '\'' . $value . '\',';
            }
        }
        $values = substr($values_statement, 0, -1) . ")";

        return 'INSERT INTO `' . $table . '` ' . $columns . ' VALUES ' . $values . ';';
    }

    /**
     * @param $table
     * @param $id
     * @param $data
     * @return string
     */
    public function buildUpdateQueryById($table, $id, $data)
    {
        $setValueStr = '';

        foreach ($data as $key => $value) {
            $setValueStr .= '`' . $key . '` = \'' . $value . '\',';
        }

        $setValues = substr($setValueStr, 0, -1);

        $query = 'UPDATE `'.$table.'` SET '.$setValues.' WHERE `'.$table.'`.`id` = '.$id;

        return $query;
    }

    /**
     * @return PDO|null
     */
    public function getConnection()
    {
        return $this->pdo;
    }

    /**
     * @param $query
     * @return string|null
     */
    public function insert($query)
    {
        try {
            $stmt = $this->pdo->prepare($query);
            $this->pdo->beginTransaction();
            $stmt->execute();
            $id = $this->pdo->lastInsertId();
            $this->pdo->commit();
            return $id;
        } catch (Exception $e) {
            $this->pdo->rollback();
            return null;
        }
    }

    /**
     * @param $query
     * @return bool
     */
    public function execute($query)
    {
        try {
            $stmt = $this->pdo->prepare($query);
            $this->pdo->beginTransaction();
            $stmt->execute();
            $this->pdo->commit();
            return true;
        }catch (Exception $e){
            $this->pdo->rollback();
            return false;
        }
    }

    /**
     * @param $stmt
     * @return mixed
     */
    public function read($stmt)
    {
       return $this->pdo->query($stmt)->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param $stmt
     * @return array
     */
    public function multipleRead($stmt)
    {
        return $this->pdo->query($stmt)->fetchAll(PDO::FETCH_ASSOC);
    }

}