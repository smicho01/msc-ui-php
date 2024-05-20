<?php

function conn()
{
    $host = getenv("POSTGRESHOST");
    $port = getenv("POSTGRESPORT");
    $dbname = getenv("POSTGRESDBNAME");
    $user = getenv("POSTGRESUSER");
    $password = getenv("POSTGRESPASSWORD");

    // DSN (Data Source Name)
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";

    try {
        $pdo = new PDO($dsn);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $pdo;
}
function disconnect ($pdo)
{
    $pdo = null;
}

function insertDbLogData($level, $module, $eventType, $message, $json = null) {
    $level =  strtoupper($level);
    $userId = 'anonymous';
    if(isset($_SESSION['user']['email'])) {
        $userId = $_SESSION['user']['email']; // may change to user id later
    }

    $IP =  get_client_ip();

    $sql = "INSERT INTO uilogs.logs (Timestamp, Level, Source, UserID, EventType, Message, IPAddress, SessionID) 
                VALUES ( NOW(), ?,?,?,?,?,?,?)";
    $pdo = conn();
    $stmt= $pdo->prepare($sql);

    $stmt->execute([$level, $module, $userId, $eventType, $message, $IP, session_id() ]);
    $pdo = null;
}

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

//$query = 'SELECT * FROM users.user';
//$statement = $pdo->query($query);
//
//while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
//    echo $row['username'] . '<br>';
//}