<?php

class security
{
	function __construct($dbConn, $serverDbTables)
	{
		$this->dbConn = $dbConn;
		$this->serverDbTables = $serverDbTables;
	}

	function escape_mysql_string($str)
	{
		return mysqli_escape_string($this->dbConn, $str);
	}

	function encrpt_alogrithm_1($reps, $str)
	{
		$newStr = $str;
		for ($i = 0; $i < $reps; $i++) {
			$newStr = sha1($newStr);
		}
		return $newStr;
	}
}

class site_db_fetch
{
	function __construct($dbConn, $serverDbTables)
	{
		$this->dbConn = $dbConn;
		$this->serverDbTables = $serverDbTables;
	}
	function fetch_user_colum($identifier,$identifierValue,$rowNeeded){
		$result = null;
		$identifier = mysqli_escape_string($this->dbConn,$identifier);
		$identifierValue = mysqli_escape_string($this->dbConn,$identifierValue);
		$rowNeeded = mysqli_escape_string($this->dbConn,$rowNeeded);
		$sql = "SELECT ".$rowNeeded." FROM ".$this->serverDbTables['userTable']." WHERE ".$identifier." = '".$identifierValue."'";
		$query = mysqli_query($this->dbConn,$sql);
		while($row = mysqli_fetch_array($query)){
			$result = $row[$rowNeeded];
		}
		return $result;
	}
}

$security_class = new security($dbConn, $serverDbTables);
$site_db_fetch = new site_db_fetch($dbConn, $serverDbTables);
