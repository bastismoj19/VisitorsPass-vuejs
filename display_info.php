<?php
    $connection = new PDO("sqlsrv:server=10.104.37.24; Database=TESTDATABASE", "testuser", "testuser");

    $sql_query = "SELECT [vpassNo],[requestedBy],[date],[deptMgr],[status]
                        ,[nameOfVisitor],[company],[position],[address],[purposeOfVisit]
                        ,[parkingInsideFCI],[allowCam],[camJustification],[areasToPic]
                        ,[personsToBeVisited] ,[areaToBeVisited],[dateOfVisit],[timeOfVisit]
                        ,[durationOfDayVisit],[escort],[actualDateIn] ,[timeIn],[actualTimeOut]
                  FROM [dbo].[Visitor's_Day_Pass] ORDER BY dateOfVisit DESC";

    $statement = $connection->prepare($sql_query);
    $statement->execute();

    $arrayData = Array();

    while($current_row = $statement->fetch(PDO::FETCH_OBJ)) {
        array_push($arrayData, $current_row);
    }

    echo json_encode($arrayData);
?>