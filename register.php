<?php
require("db_connect.php");

if (!empty($_POST)) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $response["success"] = 0;
        $response["message"] = "Παρακαλώ εισάγετε το όνομά σας και τον κωδικό σας.";
        die(json_encode($response));
    }
    
    $query = "SELECT 1
              FROM users
              WHERE username = :user";

    $query_params = array(
        ':user' => $_POST['username']
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
        $response["success"] = 0;
        $response["message"] = "Συγγνώμη, αυτό το όνομα χρησιμοποιείται ήδη.";
        die(json_encode($response));
    }
    
    $query = "INSERT INTO users (username, password)
              VALUES (:user, :pass)";
    
    $query_params = array(
        ':user' => $_POST['username'],
        ':pass' => md5($_POST['password'])
    );
    
    try {
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
    } catch (PDOException $ex) {       
        $response["success"] = 0;
        $response["message"] = "Σφάλμα βάσης δεδομένων: αποτυχία δημιουργίας νέου χρήστη. Παρακαλώ, προσπαθήστε ξανά.";
        die(json_encode($response));
    }
    
    $response["success"] = 1;
    $response["message"] = "Η καταχώρηση ήταν επιτυχής!";
    echo json_encode($response);
} else {
?>
	<h2>Register</h2> 
	<form action="register.php" method="POST"> 
	    <input type="text" name="username" placeholder="username" /><br /> 
	    <input type="password" name="password" placeholder="password" /><br /> 
	    <input type="submit" value="Register" /> 
	</form>
<?php
}
?>