<?php
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '40', 'view' => '1'))){ 
echo '
<section class="panel panel-featured panel-featured-primary">
<header class="panel-heading">';
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '40', 'add' => '1'))){ 
		echo'<a href="#make_books" class="modal-with-move-anim btn btn-primary btn-xs pull-right">
		<i class="fa fa-plus-square"></i> Add Books</a>';
	}
	echo'
	<h2 class="panel-title"><i class="fa fa-list"></i>  Books List</h2>
</header>
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed mb-none" id = "table_export">
<thead>
	<tr>
		<th style="text-align:center;">No.</th>
		<th>Book Code</th>
		<th>Book Name</th>
		<th>Author</th>
		<th>isbn</th>
		<th>Category</th>
		<th>Publisher</th>
		<th>Price</th>
		<th>Rack No.</th>
		<th>Quantity</th>
		<th>Details</th>
		<th width="70px;" style="text-align:center;">Status</th>
		<th width="100" style="text-align:center;">Options</th>
	</tr>
</thead>
<tbody>';
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT b.book_id, b.book_code, b.book_name, b.book_author, b.book_isbn, b.id_cat, b.book_publisher, 
									b.book_price, b.book_rackno, b.book_qty, b.book_detail, b.book_status,
									cat.cat_id, cat.cat_name
									
								   FROM ".LMS_BOOKS." b  
								   INNER JOIN ".LMS_BOOKCATEGORY." cat ON cat.cat_id = b.id_cat
								   WHERE b.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY b.book_name ASC");
$srno = 0;
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
//-----------------------------------------------------
$srno++;
//-----------------------------------------------------
echo '
<tr>
	<td style="text-align:center;">'.$srno.'</td>
	<td>'.$rowsvalues['book_code'].'</td>
	<td>'.$rowsvalues['book_name'].'</td>
	<td>'.$rowsvalues['book_author'].'</td>
	<td>'.$rowsvalues['book_isbn'].'</td>
	<td>'.$rowsvalues['cat_name'].'</td>
	<td>'.$rowsvalues['book_publisher'].'</td>
	<td>'.$rowsvalues['book_price'].'</td>
	<td>'.$rowsvalues['book_rackno'].'</td>
	<td>'.$rowsvalues['book_qty'].'</td>
	<td>'.$rowsvalues['book_detail'].'</td>
	<td style="text-align:center;">'.get_status($rowsvalues['book_status']).'</td>
	<td>';
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '40', 'edit' => '1'))){ 
			echo'<a href="#show_modal" class="modal-with-move-anim-pvs btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/books/modal_lms_books_update.php?id='.$rowsvalues['book_id'].'\');"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
		}
		if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '40', 'delete' => '1'))){ 
			echo'<a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal(\'lms_books.php?deleteid='.$rowsvalues['book_id'].'\');"><i class="el el-trash"></i></a>';
		}
		echo'
	</td>
</tr>';
//-----------------------------------------------------
}
//-----------------------------------------------------
echo '
</tbody>
</table>
</div>
</section>';
}
else{
	header("location: dashboard.php");
}