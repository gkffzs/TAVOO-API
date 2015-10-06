<?php
require("db_connect.php");

if (!empty($_GET)) {
    $query = "INSERT INTO logs (user_id, activity_tag, action_tag, related_id, action_timestamp)
              VALUES (:user_id, :activity_tag, :action_tag, :related_id, :cur_timestamp)";

    date_default_timezone_set("Europe/Athens");
    $formatted_timestamp = date("Y-m-d G:i:s", $_GET['cur_timestamp']/1000);

    $query_params = array(
        ':user_id' => $_GET['user_id'],
        ':activity_tag' => $_GET['activity_tag'],
        ':action_tag' => $_GET['action_tag'],
        ':related_id' => $_GET['related_id'],
        ':cur_timestamp' => $formatted_timestamp
    );

    try {
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
    } catch (PDOException $ex) {      
        $response["success"] = 0;
        $response["message"] = "Σφάλμα βάσης δεδομένων: αδυναμία καταγραφής πράξης.";
        die(json_encode($response));
    }

    $response["success"] = 1;
    $response["message"] = "Η πράξη καταγράφθηκε επιτυχώς.";
    die(json_encode($response));
} else {
?>
    <h2>Logging</h2>
    <form action="logging.php" method="GET">
        <input type="text" name="user_id" placeholder="user_id" value="" /><br /> 
        <input type="text" name="activity_tag" placeholder="activity_tag" value="" /><br />
        <input type="text" name="action_tag" placeholder="action_tag" value="" /><br />
        <input type="text" name="related_id" placeholder="related_id" value="" /><br />
        <input type="text" name="cur_timestamp" placeholder="cur_timestamp" value="" /><br /> 
        <input type="submit" value="Submit" /> 
    </form>
<?php
}
?>