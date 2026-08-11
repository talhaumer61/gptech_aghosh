<?php
//----------------Update Single Fee Chalaln----------------------
if(isset($_POST['make_salary'])) { 

    $sqllmsinsertsalary  = $dblms->querylms("INSERT INTO ".SALARY." (
                                                                        status										, 
                                                                        slip_no									    , 
                                                                        id_emply									, 
                                                                        month										,
                                                                        basic_salary								,
                                                                        total_allowances							,
                                                                        total_deductions							,
                                                                        net_pay							            ,
                                                                        dated										, 
                                                                        id_campus									, 
                                                                        id_added									, 
                                                                        date_added				
                                                                    )

                                                                VALUES(
                                                                        '1'			                                ,
                                                                        '".cleanvars(uniqid())."' 		            ,
                                                                        '".cleanvars($_POST['id_emply'])."' 		,
                                                                        '".cleanvars($_POST['month'])."' 		    ,
                                                                        '".cleanvars($_POST['basic_salary'])."'     ,
                                                                        '".cleanvars($_POST['total_allowance'])."'  ,
                                                                        '".cleanvars($_POST['total_deduction'])."'  ,
                                                                        '".cleanvars($_POST['net_salary'])."'       ,
                                                                        NOW()										,
                                                                        '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."',
                                                                        '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."',
                                                                        NOW()			
                                                                    )
                                                                ");

    $id_voucher = $dblms->lastestid();	

	for($i=0; $i<= count(!empty($_POST['allowance_value'])); $i++){

        if($_POST['allowance_value'][$i] != 0){

        $sqllmsallowance  = $dblms->querylms("INSERT INTO ".SALARY_PART." (
                                                                            id_voucher									, 
                                                                            name									    , 
                                                                            type										,
                                                                            amount				
                                                                        )

                                                                    VALUES(
                                                                            '".cleanvars($id_voucher)."' 		        ,
                                                                            '".cleanvars($_POST['allowance_name'][$i])."',
                                                                            '1' 		                                ,
                                                                            '".cleanvars($_POST['allowance_value'][$i])."'			
                                                                        )
                                                                ");
        }
    }

    for($j=0; $j<= count(!empty($_POST['deduction_name'])); $j++){

        if($_POST['deduction_value'][$j] != 0){

        $sqllmsdeduction  = $dblms->querylms("INSERT INTO ".SALARY_PART." (
                                                                            id_voucher									, 
                                                                            name									    , 
                                                                            type										,
                                                                            amount				
                                                                        )

                                                                    VALUES(
                                                                            '".cleanvars($id_voucher)."' 		        ,
                                                                            '".cleanvars($_POST['deduction_name'][$j])."',
                                                                            '2' 		                                ,
                                                                            '".cleanvars($_POST['deduction_value'][$j])."'			
                                                                        )
                                                                ");
        }
    }

    if($sqllmsinsertsalary) { 

        $remarks = 'Created Monthly Salary ID: "'.cleanvars($id_voucher).'"';
        $sqllmslog  = $dblms->querylms("INSERT INTO ".LOGS." (
                                                                    id_user										, 
                                                                    filename									, 
                                                                    action										,
                                                                    dated										,
                                                                    ip											,
                                                                    remarks										, 
                                                                    id_campus				
                                                                )

                                                            VALUES(
                                                                    '".cleanvars($_SESSION['userlogininfo']['LOGINIDA'])."'				,
                                                                    '".strstr(basename($_SERVER['REQUEST_URI']), '.php', true)."' 		, 
                                                                    '1'																	, 
                                                                    NOW()																,
                                                                    '".cleanvars($ip)."'												,
                                                                    '".cleanvars($remarks)."'						,
                                                                    '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'			
                                                                )
                                                ");
        
        //--------------------------------------
		header("Location: salary.php?id=".$id_voucher, true, 301);
		exit();
		//--------------------------------------
    }

}