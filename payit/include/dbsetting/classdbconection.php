<?php
class dblms {
    private $lms_hostname;
    private $lms_username;
    private $lms_password;
    private $lms_database;
    private $connectlms;
    private $select_dblms;

    public function __construct() {
        $this->lms_hostname = LMS_HOSTNAME;
        $this->lms_username = LMS_USERNAME;
        $this->lms_password = LMS_USERPASS;
        $this->lms_database = LMS_NAME;
    }

    public function open_connectionlms() {

        try	{

            $this->connectlms 	= mysqli_connect($this->lms_hostname, $this->lms_username, $this->lms_password, $this->lms_database) or die (print "Class Database: Error while connecting to DB (link)");


            //$this->select_dblms = mysql_select_db($this->lms_database) or die (print "Class Database: Error while selecting DB");
        }

        catch(exception $e)	{
            return $e;
        }

    }

    public function close_connectionlms() {
        try	{
            mysqli_close($this->connectlms);
        }
        catch(exception $e)	{
            return $e;
        }
    }

    public function querylms($sqllms) {
        try	{
            $this->open_connectionlms();
            $sqllms = mysqli_query($this->connectlms, $sqllms);
        }
        catch(exception $e)	{
            return $e;
        }
        return $sqllms;
        $this->close_connectionlms();
    }

//------------ Get Latest Inserted id ---
    public function lastestid() {
        $lastid = mysqli_insert_id($this->connectlms);
        return $lastid;
        $this->close_connectionlms();
    }



    public function getRows($table, $conditions = array()){
        $sql = 'SELECT ';
        $sql .= array_key_exists("select",$conditions)?$conditions['select']:'*';
        $sql .= ' FROM '.$table;

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

        if(array_key_exists("having",$conditions)){
            $sql .= ' HAVING  '.$conditions['having'];

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

        //echo $sql;

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
//------------------------------------------
    public function Insert($table, $data){
        $fields = array_keys( $data );
        $values = array_values( $data );
        $sqlQuery = "INSERT INTO $table(".implode(",",$fields).") VALUES ('".implode("','", $values )."');";

        $result =  $this->querylms($sqlQuery);
        return $result;
    }
//------------------------------------------
    public function Update($table_name, $form_data, $where_clause='') {
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
} //Class End
//-----------Array Class-----------------------
class Stdlib_Array
{
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

?>