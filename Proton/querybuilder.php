<?php
/*
*   Author:  Umit Aksoylu
*   Date:    31.12.2020
*   Project: Proton Framework
*   Description: Object-orianted based SQL querybuilder for Proton Framework
*/

 function _sum($column,$alias)
{
    return "!sum(`".$column."`)"." as "."".$alias."";
}

 function _count($column,$alias)
{
    return "!count(`".$column."`)"." as "."".$alias."";
}

function _max($column,$alias) {
       return "!max(`".$column."`)"." as "."".$alias."";

};

function _min($column,$alias) {
       return "!min(`".$column."`)"." as "."".$alias."";

};


function _avg($column,$alias) {
       return "!avg(`".$column."`)"." as "."".$alias."";

};

function _param($val)
{   
    if (is_null($val))
        return 0;
    else if (is_numeric($val) OR is_bool($val))
        return SECURITY::ESCAPE($val);
    else
        return "'".SECURITY::ESCAPE($val)."'";
}

function _like($val)
{
    return "LIKE '%".$val."%'";
}

class XQuery{

    private $query;
    private static $db;
    private $rc = -1;
    private $type= "NULL";
    private $parameters = [];
    public function __construct()
    {

        if(DB == "ENABLED")
        {
            include "Proton/database.php";
            
     
        }

        self::$db = $db;
    }


    public function select($tableName, $params = [])
    {
        $tableName = $this->prepare($this->security($tableName));
        $len = sizeof($params);
        $selection = "";
        if($len != 0)
        {
            for($i =0; $i<$len;$i++)
            {
                $params[$i] = $this->prepare($params[$i]);
            }
            $selection = implode(', ', $params);
            foreach ($params as $parameter)
                $parameter = $this->security($parameter);     
        }
        else
        {
            $selection = "*";
        }


        $this->query = 'SELECT ' . $selection . ' FROM ' . $tableName;
        return $this;
    }

    public function update($tableName, $params)
    {
        $tableName = $this->prepare($this->security($tableName));
        
        $this->query = 'UPDATE ' . $tableName . ' SET ';

        $i = 0;
        $len = sizeof($params);
        foreach($params as $key => $value)
        {
            $this->query .=$this->prepare($this->security($key));
            $this->query .="='".$this->security($value)."'";


            if ( $i != $len -1 )
                $this->query .= ",";
            
            $i++;
        }

        return $this;
    }

    public function delete($tableName)
    {
        $tableName = $this->prepare($this->security($tableName));

        $this->query = 'DELETE FROM ' . $tableName;
        return $this;
    }

    public function insert($tableName, $params)
    {
        $tableName = $this->prepare($this->security($tableName));
        $i = 0;
        $len = sizeof($params);
        

        $columns = "(";
        $datas = "(";
        foreach($params as $key => $value)
        {
            $columns .=$this->prepare($this->security($key));
            $datas .="?";

            if ( $i != $len -1 )
                {
                    $columns .= ",";
                    $datas .= ",";
                }
                
            $this->parameters[] = $value;
            $i++;
        }
        $columns .= ")";
        $datas .= ")";
        

        $this->query = "INSERT INTO ".$tableName." ".$columns." VALUES ".$datas;
        $this->type = "INSERT";
        return $this;

    }

    /* OLDER */
    public function insert__($tableName, $params)
    {
        $tableName = $this->prepare($this->security($tableName));
        $i = 0;
        $len = sizeof($params);

        $columns = "(";
        $datas = "(";
        foreach($params as $key => $value)
        {
            $columns .=$this->prepare($this->security($key));
            $datas .=$this->prepare_($this->security($value));

            if ( $i != $len -1 )
                {
                    $columns .= ",";
                    $datas .= ",";
                }
                
            
            $i++;
        }
        $columns .= ")";
        $datas .= ")";

        $this->query = "INSERT INTO ".$tableName." ".$columns." VALUES ".$datas;
        
        return $this;

    }


    public function join($direction,$tableName,$statement)    
     {
        $tableName = $this->prepare($this->security($tableName));
        $statement = $this->security($statement);
        $directions = ['RIGHT', 'LEFT', 'INNER'];
        if (!in_array($direction, $directions, true)) {
            throw new InvalidArgumentException('Invalid Direction');
        }
        $this->query .= ' '. $direction. ' JOIN '. $tableName . ' ON '. $statement ;

        return $this;
    }


    public function orderByASC($columnName)
    {
        $columnName = $this->prepare($this->security($columnName));

        $this->query .= ' ORDER BY ' . $columnName . ' ' . 'ASC';
        return $this;
    }

    public function orderByDESC($columnName)
    {
        $columnName = $this->prepare($this->security($columnName));

        $this->query .= ' ORDER BY ' . $columnName . ' ' . 'DESC';
        return $this;
    }


    public function limit( $lim)
    {
        $lim = $this->security($lim);

        $this->query .= ' LIMIT ' . $lim;
        return $this;
    }

    public function offset( $off)
    {
        $off = $this->security($off);

        $this->query .= ' OFFSET ' . $off;
        return $this;
    }


    public function where($statement, $variables)
    {
        //_param
        foreach($variables as $key => $value)
        {   
            
            $statement = str_replace('{'.$key.'}', _param($value), $statement);
        }
        $this->query .= ' WHERE ' . $statement;
        return $this;
    }

    public function toString()
    {

        return $this->query;
    }

    public function run()
    {
        $this->rc = self::$db->prepare($this->query)->execute($this->parameters);
        return $this->rc;

        // TODO :  RESEARCH & FIX
        if($this->type == "INSERT" )
        {   

            $this->rc = self::$db->prepare($this->query)->execute($this->parameters);
            return $this->rc;
        }
        else 
        {
            $this->rc =  self::$db->exec($this->query);
            return $this->rc;
        }
       
    }

    public function fetch($param = 0)
    {
        $this->rc = 0;
        
        if($param != 0)
            $this->limit($param);


        $q = self::$db->query($this->query);
        
        
        if( $this->rc = $q->rowCount())
        {   
            if($param == 1)
                return $q->fetch();
            
            return $q->fetchAll(PDO::FETCH_ASSOC);
            
        }
        else
        {
            $this->rc = 0;
            return false;
        }
     
    }

    public function count()
    {
        if ($this->rc == -1)
            return "Proton error: SQL Query '".$this->query."' not executed yet.";
        else
            return $this->rc;
    }

    private function security($data)
    {
        //variable security
        $data = htmlspecialchars(strip_tags(trim(addslashes($data))));
        return $data;

    }

    private function prepare($str)
    {
        if($str[0] == '`')
        {
            return $str;
        }
        else if($str[0] == '!')
        {
            return substr($str, 1);
        }
        else
        {
            return "`".$str."`";
        }
    }


    private function prepare_($str)
    {
        if($str[0] == "'")
        {
            return $str;
        }
        else if($str[0] == "!")
        {
            return substr($str, 1);
        }
        else
        {
            return "`".$str."`";
        }
    }

}



?>