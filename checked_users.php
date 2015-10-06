<?php
require("db_connect.php");

if (!empty($_GET)) {
    if (empty($_GET['location_id'])) {
        $response["success"] = 0;
        $response["message"] = "Σφάλμα: λείπει το location_id.";
        die(json_encode($response));
    }

    $query = "SELECT COUNT(*) AS checked_users
              FROM checked
              WHERE location_id = :location_id";
              
    $query_params = array(
        ':location_id' => $_GET['location_id']
    );

    try {
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
    } catch (PDOException $ex) {      
        $response["success"] = 0;
        $response["message"] = "Σφάλμα βάσης δεδομένων: παρακαλώ, προσπαθήστε ξανά.";
        die(json_encode($response));
    }

    $row = $stmt->fetch();
    $response["checked_users"] = $row['checked_users'];
    die(json_encode($response));
} else {
?>
    <h2>Checked Users</h2> 
    <form action="checked_users.php" method="GET">
        <input type="text" name="location_id" placeholder="location_id" value="" /><br /> 
        <input type="submit" value="Retrieve" /> 
    </form>
<?php
}
?>