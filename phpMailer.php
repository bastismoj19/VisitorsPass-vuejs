<?php
    session_start();

    require  "pages/get_info_from_DB.php";
    require  "phpmailer/class.phpmailer.php";

    if(isset($_POST["vpassNo"])) {
        $vpassNo                = $_POST["vpassNo"];
        $deptMgr                = $_POST["deptMgr"];
        $requestedBy            = $_POST["requestedBy"];
        $status                 = $_POST["status"];
        
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Debugoutput = 'html';
        $mail->Host = "157.184.222.11";
        $mail->Port = 2525;
        
        $mail->setFrom( $requestedBy ."@funai-cebu.com.ph", "Requestor");

        $userEmail = $_SESSION["username"];

        if ($userEmail === $deptMgr && $status === "Submitted to Dept Manager") {          
        $mail->addAddress($deptMgr ."@funai-cebu.com.ph", "Approver");

            $whole_message = "$mail->Body
                        Dear Department Manager, <br><br>
                        Visitor's pass Number <b>$vpassNo</b> has been submitted for review and approval. <br><br>

                        <p>Click <a href='http://10.104.36.24/basti/vue pass/index.php?vpassNo=$vpassNo&status=$status'
                        <b><i>View</i></b></a> to view the Requestor's data.</p>
                        ";
        } else {
            //CHANGE THIS TO SECURITY            
        $mail->addAddress($deptMgr ."@funai-cebu.com.ph", "Security Office");

            $whole_message = "$mail->Body
                        Dear Security Office, <br>
                        Vpass Number <b>$vpassNo</b> has been approved by the Department Manager. <br><br>
                        Please fill up the form for the Actual Date In, Actual Time In and Actual Time Out of visitor(s).<br>
                        
                        <p>Click <a href='http://10.104.36.24/basti/vue pass/index.php?vpassNo=$vpassNo&status=$status' class='view-link'
                        <b><i>View</i></b></a> to view the data.</p>
                        ";
        }
        
        $mail->Subject = "Request for Visitor's Pass";
        
        $mail->msgHTML($whole_message);
        
        $response = $mail->send();
    
        if (!$response) {
            echo $mail->ErrorInfo;
        } else {
            echo "Email successfully sent!";
        }
    }
?>