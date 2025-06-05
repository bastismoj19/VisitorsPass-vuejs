<?php
    $connection = new PDO("sqlsrv:server=10.104.37.24; Database=TESTDATABASE", "testuser", "testuser"); 
    
    if(isset($_POST["vpassNo"])) {
        $vpassNo = $_POST["vpassNo"];

        $sql_query = "
            SELECT [vpassNo],[requestedBy],[date],[deptMgr],[status]
            ,[nameOfVisitor],[company],[position],[address],[purposeOfVisit]
            ,[parkingInsideFCI],[allowCam],[camJustification],[areasToPic]
            ,[personsToBeVisited] ,[areaToBeVisited],[dateOfVisit],[timeOfVisit]
            ,[durationOfDayVisit],[escort],[actualDateIn] ,[timeIn],[actualTimeOut]
            FROM [dbo].[Visitor's_Day_Pass] where vpassNo = '$vpassNo'
        ";

        $statement = $connection->prepare($sql_query);
        $statement->execute();

        $item_info = null;
        
        while($current_row = $statement->fetch(PDO::FETCH_OBJ)){
            $item_info = $current_row;
        }
        
        echo json_encode($item_info);
    } else {
        echo json_encode("no vpass number");
    }
?>