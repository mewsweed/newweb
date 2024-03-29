<?php
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: Content-Type");
// header("Content-Type: application/json; charset=utf-8");
//     include('../server.php');
//     try{
//         $stmt = $dbh->prepare("SELECT * FROM event_joined where user_id= ?");
//         $stmt->execute([$_GET['id']]);
//         foreach ($stmt as $row){
//             $join = array(
//                 'id'=> $row['id'],
//                 'user_id'=> $row['user_id'],
//                 'event_id'=> $row['event_id'],
//                 'joinAt'=> $row['joinAt'],
//                 'runNo'=> $row['runNo'],
//                 'paid'=> $row['paid'],
//             );
//             echo json_encode($join);
//             break;   
//         }
//         $dbh = null;
//     }catch(PDOException $e){
//         print "Error: " . $e->getMessage() ."<br/>";
//         die();
//     }

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=utf-8");

include('../server.php');

try {
    $stmt = $dbh->prepare("SELECT 
    ej.id, ej.user_id, ej.event_id, ej.joinAt, ej.runNo, ej.size, ej.ship,
     e.address, e.province, e.distance, e.datetime AS event_datetime,
    e.name AS event_name, e.owner, e.coverimg
                          FROM event_joined AS ej 
                          INNER JOIN users AS u ON ej.user_id = u.id 
                          INNER JOIN events AS e ON ej.event_id = e.id 
                          WHERE DATE(e.datetime) < CURDATE()" );
    $stmt->execute();
    
    $joins = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $join = array(
            'id' => $row['id'],
            'user_id' => $row['user_id'],
            'event_id' => $row['event_id'],
            'joinAt' => $row['joinAt'],
            'runNo' => $row['runNo'],
            'size' => $row['size'],
            'ship' => $row['ship'],
            'address' => $row['address'],
            'province' => $row['province'],
            'distance' => $row['distance'],
            'event_datetime' => $row['event_datetime'],
            'event_name' => $row['event_name'],
            'owner' => $row['owner'],
            'coverimg' => $row['coverimg']
        );
        $joins[] = $join;
    }
    
    echo json_encode($joins);
    
    $dbh = null;
} catch (PDOException $e) {
    print "Error: " . $e->getMessage() . "<br/>";
    die();
}
