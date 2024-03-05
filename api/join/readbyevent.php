<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=utf-8");
    include('../server.php');
    try{
        $stmt = $dbh->prepare("SELECT
            ej.id, ej.user_id, ej.event_id, ej.joinAt, ej.runNo, ej.paid, ej.size, ej.ship,
            i.fname, i.lname, i.gender, i.phone, i.emerphone

            FROM event_joined AS ej
            INNER JOIN users AS u ON ej.user_id = u.id
            INNER JOIN info AS i ON u.id = i.user_id
            WHERE ej.event_id =?");
        $stmt->execute([$_GET['id']]);
        $joins = array();
        foreach ($stmt as $row){
            $join = array(
                'id'=> $row['id'],
                'user_id'=> $row['user_id'],
                'event_id'=> $row['event_id'],
                'joinAt'=> $row['joinAt'],
                'runNo'=> $row['runNo'],
                'paid'=> $row['paid'],
                'fname'=>$row['fname'],
                'lname'=>$row['lname'],
                'gender'=>$row['gender'],
                'phone'=>$row['phone'],
                'emerphone'=>$row['emerphone'],
            );
            $joins[] = $join;
        }
        echo json_encode($joins);
        $dbh = null;
    }catch(PDOException $e){
        print "Error: " . $e->getMessage() ."<br/>";
        die();
    }

//             e.name, e.distance, e.type, e.address, e.province,
//            e.name, e.distance, e.type, e.address, e.province,
// e.owner, e.coverimg

                // 'name'=>$row['name'],
                // 'distance'=>$row['distance'],
                // 'type'=>$row['type'],
                // 'address'=>$row['address'],
                // 'province'=>$row['province'],
                // 'owner'=>$row['owner'],
                // 'coverimg'=>$row['coverimg'],