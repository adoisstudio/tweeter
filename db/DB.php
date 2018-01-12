<?php
/**
 * Created by PhpStorm.
 * User: amitkumar
 * Date: 16/11/17
 * Time: 3:14 PM
 */


class DB
{

    private static $self = null;
    private $link = null;

    private $query = "";
    private $columns = "";
    private $values = "";

    public function __construct()
    {

        self::$self = $this;

        $host = "localhost";
        $user = "root";
        $password = "root";
        $database = "tweeter";
        $port = "3306";

        $this->link = mysqli_connect($host, $user, $password, $database, $port);

        if (!$this->link)
            die("database connection failed");

        //die(var_dump(mysqli_query($con, "select * from user_master;")));

    }

    public static function connect()
    {
        if (self::$self == null)
            self::$self = new DB();

        return self::$self;
    }//connect

    public function updateIn($table_name)
    {
        return new UpdateQuery($this->link, $table_name);
    }//update in

    public function insertIn($table)
    {
        return new InsertQuery($this->link, $table);
    }//insert in

    public function select($what)
    {
        return new SelectQuery($this->link, $what);
    }//select query

    public function query($query)
    {
        return mysqli_query($this->link, $query);
    }//query

    public function getError()
    {
        return mysqli_error($this->link);
    }

    public function getLink()
    {
        return $this->link;
    }

}//class

//Update Query
class UpdateQuery
{

    private $db_connection;
    private $query = "";


    public function __construct($db, $table)
    {
        $this->db_connection = $db;
        $this->query = "UPDATE $table SET";
    }

    public function setStringOf($param, $value)
    {
        $value = mysqli_real_escape_string($this->db_connection, $value);
        $this->query .= " $param = '$value'";
        //echo $this->query . "\n";
        return $this;
    }

    public function setNumberOf($param, $value)
    {
        $value = mysqli_real_escape_string($this->db_connection, $value);
        $this->query .= " $param = $value";
        //echo $this->query . "\n";
        return $this;
    }

    public function also()
    {
        $this->query .= " AND";
        //echo $this->query . "\n";
        return $this;
    }

    public function where()
    {
        $this->query .= " WHERE";
        //echo $this->query . "\n";
        return $this;
    }

    public function stringOf($param, $value)
    {
        $value = mysqli_real_escape_string($this->db_connection, $value);
        $this->query .= " $param = '$value'";
        //echo $this->query . "\n";
        return $this;
    }

    public function numberOf($param, $value)
    {
        $value = mysqli_real_escape_string($this->db_connection, $value);
        $this->query .= " $param = $value";
        //echo $this->query . "\n";
        return $this;
    }

    public function run()
    {
        return $this->db_connection->query($this->query);
    }

}//UpdateQuery

//Insert Query
class InsertQuery
{

    private $db_connection;
    private $query = "";
    private $columns = "";
    private $values = "";

    public function __construct($db, $table)
    {
        $this->db_connection = $db;
        $this->query = "INSERT INTO $table(";
        return $this;
    }

    public function columnAsString($column_name, $value)
    {
        $value = mysqli_real_escape_string($this->db_connection, $value);
        $this->columns .= ", " . $column_name;
        $this->values .= ", '$value'";
        //echo $this->query . $this->columns . ")Values(" . $this->values . "\n";
        return $this;
    }

    public function columnAsNumber($column_name, $value)
    {
        $value = mysqli_real_escape_string($this->db_connection, $value);
        $this->columns .= ", " . $column_name;
        $this->values .= ", $value";
        //echo $this->query . $this->columns . ")Values(" . $this->values . "\n";
        return $this;
    }

    public function save()
    {

        $this->columns = substr($this->columns, strpos($this->columns, ",") + 1);
        $this->values = substr($this->values, strpos($this->values, ",") + 1);

        ////echo $this->query . $this->columns . ") VALUES (" . $this->values . ")\n";

        if ($this->columns == "" || $this->values == "")
            return false;

        $this->query = $this->query . $this->columns . ") VALUES (" . $this->values . ")";
        //echo $this->query . "\n";

        return $this->db_connection->query($this->query);
    }

}//InsertQuery

//Select Query
class SelectQuery
{

    private $db_connection;
    private $query = "";

    public function __construct($db, $what)
    {
        $this->db_connection = $db;
        $this->query = "SELECT $what";
        //echo $this->query . "\n";
    }

    public function from($table)
    {
        $this->query .= " FROM $table";
        //echo $this->query . "\n";
        return $this;
    }

    public function also()
    {
        $this->query .= " AND";
        //echo $this->query . "\n";
        return $this;
    }

    public function where()
    {
        $this->query .= " WHERE";
        //echo $this->query . "\n";
        return $this;
    }

    public function stringOf($param, $value)
    {
        $value = mysqli_real_escape_string($this->db_connection, $value);

        $this->query .= " $param = '$value'";
        //echo $this->query . "\n";
        return $this;
    }

    public function numberOf($param, $value)
    {
        $value = mysqli_real_escape_string($this->db_connection, $value);

        $this->query .= " $param = $value";
        //echo $this->query . "\n";
        return $this;
    }

    public function run($append = "")
    {
        return $this->db_connection->query($this->query . " " . $append);
    }

}//SelectQuery

