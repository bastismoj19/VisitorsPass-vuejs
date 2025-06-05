<?php

    $has_no_error = false;
    if(isset($_POST["vpassNo"])) {
        $vpassNo = $_POST["vpassNo"];
        
        $connection = new PDO("sqlsrv:server=10.104.37.24; Database=TESTDATABASE", "testuser", "testuser");

        $sql_query = "
        DELETE FROM [dbo].[Visitor's_Day_Pass] WHERE vpassNo = '$vpassNo'
        ";

        $statement = $connection->prepare($sql_query);
        $statement->execute();

        $has_no_error = true;
        echo json_encode($has_no_error);
    } else {
        echo json_encode($has_no_error);
    }
?>