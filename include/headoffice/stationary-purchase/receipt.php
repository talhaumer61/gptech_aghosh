<?php

if(isset($_GET['pr'])){
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '52', 'view' => '1'))){ 

}
}
?>