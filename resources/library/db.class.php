<?php

class DB
{
    function __construct()
    {
    	include $_SERVER['DOCUMENT_ROOT']."/admin-panel/resources/config.php";
		$this->host = $config["db"]["db1"]["host"];
		$this->username = $config["db"]["db1"]["username"];
		$this->password = $config["db"]["db1"]["password"];
		$this->dbname = $config["db"]["db1"]["dbname"];
    }

    private function connect()
    {
		$this->db_server = odbc_connect($this->host,$this->username,$this->password);
		if (!$this->db_server) die ("Could not connect to MySQL server: ".odbc_error());
    }
    
    public function query($sql)
    {
	$this->connect();
//	echo $sql;
	if(strtolower(substr($sql,0,6)) == 'select')
	{
	    $resource = odbc_exec($this->db_server,$sql);
	    if($resource)
	    {
		$table = false;
		$numfields = odbc_num_fields($resource);
		$num_rows = odbc_num_rows($resource);
		$r = 0;
		$k = 1;
		while($row = odbc_fetch_array($resource))
		{
			for ($i=1; $i <= $numfields; $i++)
		    {
			if(!empty($this->index) && $this->index == odbc_field_name ($resource, $i)) $k = $i;
			}
			
		    for ($i=1; $i <= $numfields; $i++)
		    {
			if(!empty($this->index))
			{	
			    $table[$row[odbc_field_name ($resource, $k)]][odbc_field_name ($resource, $i)] = $row[odbc_field_name ($resource, $i)];
			}
			elseif($num_rows > 1 && empty($this->index))
			    $table[$r][odbc_field_name ($resource, $i)] = $row[odbc_field_name ($resource, $i)];
			else
			    $table[odbc_field_name ($resource, $i)] = $row[odbc_field_name ($resource, $i)];
		    }
		    $r++;
			
		}
		return $table;
	    }
	    else
		return false;
	}
	elseif(strtolower(substr($sql,0,6)) == 'update') {
	    $resource = odbc_exec($this->db_server, $sql);
	    if($resource)
			return true;
	    else
			return false;

	}
	elseif(strtolower(substr($sql,0,6)) == 'insert') {
	    $resource = odbc_exec($this->db_server,$sql);
	    if($resource)
			return true;
	    else
			return false;
	}
	elseif(strtolower(substr($sql,0,6)) == 'delete') {
		$resource = odbc_exec($this->db_server,$sql);
	    if($resource)
			return true;
	    else
			return false;
	}
}
    
}
?>