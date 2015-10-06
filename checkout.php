<?php
require("db_connect.php");

if (!empty($_GET)) {
    if (empty($_GET['user_id']) || empty($_GET['location_id'])) {
        $response["success"] = 0;
        $response["message"] = "Σφάλμα: κάποιο απαραίτητο στοιχείο λείπει.";
        die(json_encode($response));
    }

    $query = "SELECT *
              FROM checked
              WHERE user_id = :user_id";

    $query_params = array(
        ':user_id' => $_GET['user_id']
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
    if ($row) {       
        $query = "DELETE FROM checked
                  WHERE user_id = :user_id";

        $query_params = array(
            ':user_id' => $_GET['user_id']
        );

        try {
            $stmt   = $db->prepare($query);
            $result = $stmt->execute($query_params);
        } catch (PDOException $ex) {      
            $response["success"] = 0;
            $response["message"] = "Σφάλμα βάσης δεδομένων: αδυναμία διαγραφής check-in.";
            die(json_encode($response));
        }

        $response["success"] = 1;
        $response["message"] = "Κάνατε επιτυχώς check-out!";
        die(json_encode($response));
    }
} else {
?>
    <h2>Check-out</h2> 
    <form action="checkout.php" method="GET">
        <input type="text" name="user_id" placeholder="user_id" value="" /><br /> 
        <input type="text" name="location_id" placeholder="location_id" value="" /><br /> 
        <input type="submit" value="Check-out" /> 
    </form>
<?php
}
?>