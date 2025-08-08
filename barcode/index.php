<?php

    include "../dbsetting/lms_vars_config.php";
	include "../dbsetting/vars_setting.php";
	include "../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../functions/functions.php";
    

    echo '
    <table class="table table-bordered table-hover">
        <tr>
            <th>Book Name</th>
            <th>Bar Code</th>
        </tr>';
        $sqllms  = $dblms->querylms("SELECT DISTINCT(bk.book_title)
										FROM ".LRC_BOOKS_DETAIL." bk_detail
										INNER JOIN ".LRC_BOOKS." bk ON bk.book_id = bk_detail.id_book
										WHERE bk.status = '1'
										ORDER BY rand() LIMIT 15");
        while($value = mysqli_fetch_array($sqllms)) {

            $uniqueNum = hexdec(uniqid());

        echo '
        <tr>
            <td>'.$value['book_title'].'</td>
            <td><img src="barcode.php?codetype=Code39&size=40&text='.$uniqueNum.'&print=true" alt="Bar Code"/></td>
        </tr>';
        }
    echo '
    </table>';
?>