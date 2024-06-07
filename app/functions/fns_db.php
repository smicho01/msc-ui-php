<?php

/**
 * Connects to the database [here Postgres] using the provided environment variables
 * and returns a PDO (PHP Data Object) instance.
 *
 * @return PDO|void Returns an instance of PDO if the connection is successful, otherwise terminates the script.
 */
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

/**
 * Inserts a log entry into the database.
 *
 * @param string $level The log level (e.g. ERROR, WARNING, INFO).
 * @param string $module The module or source of the log.
 * @param string $eventType The type of event being logged.
 * @param string $message The log message.
 * @param mixed|null $json Optional JSON data to associate with the log entry.
 *
 * @return void
 */
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
