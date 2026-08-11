<?php
class dblms {
	private $lms_hostname;
	private $lms_username;
	private $lms_password;
	private $lms_database;
	private $connectlms;
	private $select_dblms;
		// This function is to store the databsae variables
	public function __construct() {
		$this->lms_hostname = LMS_HOSTNAME;
		$this->lms_username = LMS_USERNAME;
		$this->lms_password = LMS_USERPASS;
		$this->lms_database = LMS_NAME;
	}
		// This function is for open connection
	public function open_connectionlms() {
		try	{
			$this->connectlms 	= mysqli_connect($this->lms_hostname, $this->lms_username, $this->lms_password, $this->lms_database) or die (print "Class Database: Error while connecting to DB (link)");
		} catch(exception $e)	{
			return $e;
		}
	}
		// This function is for make connection
	public function close_connectionlms() {
		try	{
			mysqli_close($this->connectlms);
		}
		catch(exception $e)	{
			return $e;
		}
	}
		// This fucntion is for run direct query 
	public function querylms($sqllms) {
		try	{
			$this->open_connectionlms();
			$sqllms = mysqli_query($this->connectlms, $sqllms);
		} catch(exception $e)	{
			return $e;
		}
		return $sqllms;
		$this->close_connectionlms();
	}
		// This function is to get last data inserted id it will make query it self
	public function lastestid() {
		$lastid = mysqli_insert_id($this->connectlms);
		return $lastid;
		$this->close_connectionlms();
	}
		// This function is for get data from database and it will make query it self
	public function getRows($table, $conditions = array()){ 
		
        $sql = 'SELECT '; 
        $sql .= array_key_exists("select",$conditions)?$conditions['select']:'*'; 
        $sql .= ' FROM '.$table.' '; 
	
		 if(array_key_exists("join",$conditions)){ 
			 $sql .= ' '.$conditions['join']; 
			
		//	echo $conditions['join'];
		}
        if((array_key_exists("where",$conditions))){ 
            $sql .= ' WHERE '; 
            $i = 0; 
            foreach($conditions['where'] as $key => $value){ 
                $pre = ($i > 0)?' AND ':''; 
                $sql .= $pre.$key." = '".$value."'"; 
                $i++; 
            } 
			//echo $sql;
        } 
	
		if(array_key_exists("not_equal",$conditions)){ 
			if(empty(array_key_exists("where",$conditions))){ 
				 $sql .= ' WHERE '; 
			} else {
				 $sql .= ' AND '; 
			}
           
			$iq = 0; 
            foreach($conditions['not_equal'] as $key => $value){ 
				
                $preq = ($iq > 0)?' AND ':''; 
                $sql .= $preq.$key." != '".$value."'"; 
                $iq++; 
            } 
			//echo $sql;
        } 
	
    	if(array_key_exists("search_by",$conditions)){ 
			
			 $sql .= $conditions['search_by']; 
			
		//	echo $conditions['join'];
		} 
	
		if(array_key_exists("not_in",$conditions)){ 
			
			 $sql .= ' '.$conditions['not_in']; 
			
		//	echo $conditions['join'];
		} 
	
		if(array_key_exists("group_by",$conditions)){ 
			 $sql .= ' GROUP BY '.$conditions['group_by']; 
			
		//	echo $conditions['join'];
		}
        if(array_key_exists("order_by",$conditions)){ 
            $sql .= ' ORDER BY '.$conditions['order_by'];  
        } 
		
         
        if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){ 
            $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit'];  
        }elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){ 
            $sql .= ' LIMIT '.$conditions['limit'];  
        } 
	
		// echo $sql;
         
        $result = $this->querylms($sql);
         
        if(array_key_exists("return_type",$conditions) && $conditions['return_type'] != 'all'){ 
            switch($conditions['return_type']){ 
                case 'count': 
                    $data = mysqli_num_rows($result); 
                    break; 
                case 'single': 
                    $data = mysqli_fetch_array($result); 
                    break; 
                default: 
                    $data = ''; 
            } 
        }else{ 
            if(mysqli_num_rows($result) > 0){ 
                while($row = mysqli_fetch_array($result)){ 
                    $data[] = $row; 
                } 
            } 
        } 
        return !empty($data)?$data:false; 
    }
		// This function is for insert data in database and it will make query it self
	public function Insert($table, $data){
		$id_company 	= 'id_company';
		$id_added 		= 'id_added';
		$date_added 	= 'date_added';
		if (!array_key_exists($date_added,$data) && !array_key_exists($id_added,$data)):
			$colName	= $this->querylms("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$table."'");
			if(mysqli_num_rows($colName) > 0):
                while($row = mysqli_fetch_array($colName)):
					if (in_array($id_company,$row)):
						$data[$id_company]	= cleanvars($_SESSION['userlogininfo']['LOGINCOMPANYID']);
					endif;
					if (in_array($id_added,$row)):
						$data[$id_added]	= cleanvars($_SESSION['userlogininfo']['LOGINIDA']);
					endif;
					if (in_array($date_added,$row)):
						$data[$date_added]	= date('Y-m-d g:i:s');
					endif;
                endwhile;
            endif;
		endif;
		$fields 	= array_keys( $data );  
		$values 	= array_map('cleanvars', array_values( $data ) );
		$sqlQuery 	= "INSERT INTO $table(".implode(",",$fields).") VALUES ('".implode("','", $values )."');";
		$result 	=  $this->querylms($sqlQuery);
		return $result;
	}
	public function InsertB($table, $data){
		$id_company 	= 'id_company';
		$id_added 		= 'id_added';
		$date_added 	= 'date_added';
		if (!array_key_exists($date_added,$data) && !array_key_exists($id_added,$data)):
			$colData = 0;
			$colName	= $this->querylms("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$table."'");
			if(mysqli_num_rows($colName) > 0):
                while($row = mysqli_fetch_array($colName)):
					if (in_array($id_company,$row)):
						$data[$id_company]	= cleanvars($_SESSION['userlogininfo']['LOGINCOMPANYID']);
					endif;
					if (in_array($id_added,$row)):
						$data[$id_added]	= cleanvars($_SESSION['userlogininfo']['LOGINIDA']);
					endif;
					if (in_array($date_added,$row)):
						$data[$date_added]	= date('Y-m-d g:i:s');
					endif;
                endwhile;
            endif;
		endif;
		// $fields 	= array_keys( $data );  
		// $values 	= array_map('cleanvars', array_values( $data ) );
		// $sqlQuery 	= "INSERT INTO $table(".implode(",",$fields).") VALUES ('".implode("','", $values )."');";
		// $result 	=  $this->querylms($sqlQuery);
		// return $result;
	}
		// This function is for update data in database and it will make query it self
	public function Update($table_name, $form_data, $where_clause='') {   
		$id_modify 		= 'id_modify';
		$date_modify 	= 'date_modify';

		$is_deleted 	= 'is_deleted';
		$id_deleted 	= 'id_deleted';
		$ip_deleted 	= 'ip_deleted';
		$date_deleted 	= 'date_deleted';
		if (!array_key_exists($date_modify,$form_data) && !array_key_exists($id_modify,$form_data)):
			$colName	= $this->querylms("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$table_name."'");
			if(mysqli_num_rows($colName) > 0):
                while($row = mysqli_fetch_array($colName)):
					if (!array_key_exists($is_deleted,$form_data)):
						if (in_array($id_modify,$row)):
							$form_data[$id_modify]	= cleanvars($_SESSION['userlogininfo']['LOGINIDA']);
						endif;
						if (in_array($date_modify,$row)):
							$form_data[$date_modify]	= date('Y-m-d g:i:s');
						endif;
					endif;
					if (array_key_exists($is_deleted,$form_data)):
						if (in_array($id_deleted,$row)):
							$form_data[$id_deleted]			= cleanvars($_SESSION['userlogininfo']['LOGINIDA']);
						endif;
						if (in_array($ip_deleted,$row)):
							$form_data[$ip_deleted]			= cleanvars(LMS_IP);
						endif;
						if (in_array($date_deleted,$row)):
							$form_data[$date_deleted]		= date('Y-m-d g:i:s');
						endif;
					endif;
                endwhile;
            endif;
		endif;
		// check for optional where clause
		$whereSQL = '';
		if(!empty($where_clause))
		{
			// check to see if the 'where' keyword exists
			if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
			{
				// not found, add key word
				$whereSQL = " WHERE ".$where_clause;
			} else
			{
				$whereSQL = " ".trim($where_clause);
			}
		}
		// start the actual SQL statement
		$sql = "UPDATE ".$table_name." SET ";

		// loop and build the column /
		$sets = array();
		
		foreach($form_data as $column => $value){
			$sets[] = "`".$column."` = '".$value."'";
		}

		$sql .= implode(', ', $sets);

		// append the where statement
		$sql .= $whereSQL;
			
		// run and return the query result
		$result =  $this->querylms($sql);
		return $result;
	}
	public function UpdateB($table_name, $form_data, $where_clause='') {   
		$id_modify 		= 'id_modify';
		$date_modify 	= 'date_modify';

		$is_deleted 	= 'is_deleted';
		$id_deleted 	= 'id_deleted';
		$ip_deleted 	= 'ip_deleted';
		$date_deleted 	= 'date_deleted';
		if (!array_key_exists($date_modify,$form_data) && !array_key_exists($id_modify,$form_data)):
			$colName	= $this->querylms("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$table_name."'");
			if(mysqli_num_rows($colName) > 0):
                while($row = mysqli_fetch_array($colName)):
					if (!array_key_exists($is_deleted,$form_data)):
						if (in_array($id_modify,$row)):
							$form_data[$id_modify]	= cleanvars($_SESSION['userlogininfo']['LOGINIDA']);
						endif;
						if (in_array($date_modify,$row)):
							$form_data[$date_modify]	= date('Y-m-d g:i:s');
						endif;
					endif;
					if (array_key_exists($is_deleted,$form_data)):
						if (in_array($id_deleted,$row)):
							$form_data[$id_deleted]			= cleanvars($_SESSION['userlogininfo']['LOGINIDA']);
						endif;
						if (in_array($ip_deleted,$row)):
							$form_data[$ip_deleted]			= cleanvars(LMS_IP);
						endif;
						if (in_array($date_deleted,$row)):
							$form_data[$date_deleted]		= date('Y-m-d g:i:s');
						endif;
					endif;
                endwhile;
            endif;
		endif;
		// check for optional where clause
		$whereSQL = '';
		if(!empty($where_clause))
		{
			// check to see if the 'where' keyword exists
			if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
			{
				// not found, add key word
				$whereSQL = " WHERE ".$where_clause;
			} else
			{
				$whereSQL = " ".trim($where_clause);
			}
		}
		// start the actual SQL statement
		$sql = "UPDATE ".$table_name." SET ";

		// loop and build the column /
		$sets = array();
		
		foreach($form_data as $column => $value){
			$sets[] = "`".$column."` = '".$value."'";
		}

		$sql .= implode(', ', $sets);

		// append the where statement
		$sql .= $whereSQL;
			
		// run and return the query result
		$result =  $this->querylms($sql);
		return $result;
	}
}

class Stdlib_Array {
    public static function multiSearch(array $array, array $pairs)
    {
        $found = array();
        foreach ($array as $aKey => $aVal) {
            $coincidences = 0;
            foreach ($pairs as $pKey => $pVal) {
                if (array_key_exists($pKey, $aVal) && $aVal[$pKey] == $pVal) {
                    $coincidences++;
                }
            }
            if ($coincidences == count($pairs)) {
                $found[$aKey] = $aVal;
            }
        }

        return $found;
    }    
}