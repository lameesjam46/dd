<?php


class db
{
    public $table;
    private $connection;
    private $sql;
   public function __construct($location,$username,$password,$db,$table)
    {
        $this->connection=mysqli_connect($location,$username,$password,$db);
        $this->table=$table;
    }


    public function insert($data)
    {
        $value="";
        $key="";
        foreach ($data as $k => $v) {
            $value.= "'$v',";
            $key.="`$k`,";
        }
        $key=rtrim($key,",");
        $value=rtrim($value,",");

        $this->sql="INSERT INTO $this->table ($key) VALUE ($value)";
//        echo $this->sql;die;
        return $this;

    }

    public function delete()
    {
       $this->sql="DELETE FROM $this->table ";
       return $this;
    }

    public function select($column = "*")
    {
        $this->sql="SELECT $column FROM  $this->table ";
        return $this;
    }

    public function update($data)
    {
        $row="";
        foreach ($data as $k => $v) {
            $row.="`$k`= '$v',";
        }
        $row= rtrim($row,",");
            $this->sql="UPDATE $this->table SET $row";


        return $this;
    }

    public function excute()
    {
        mysqli_query($this->connection,$this->sql);
        return mysqli_affected_rows($this->connection);
    }
    public function fetche (){
        $query=mysqli_query($this->connection,$this->sql);
       return mysqli_fetch_all($query,MYSQLI_ASSOC);

    }

    public function where($name,$operator,$value){
       $this->sql.="WHERE `$name` $operator '$value'";
       return $this;
    }

    public function Orwhere($name,$operator,$value){
        $this->sql.="OR `$name` $operator '$value'";
        return $this;
    }
    public function Andwhere($name,$operator,$value){
        $this->sql.="AND `$name` $operator '$value'";
        return $this;
    }
}

