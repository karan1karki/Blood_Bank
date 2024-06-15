<?php
require_once('../database/connection_database.php');

class UserController {
    private $conn;

    public function __construct($db_conn) {
        $this->conn = $db_conn;
    }

    public function updateUserDetails($id, $firstname, $lastname, $email, $password, $group, $dob, $gender, $pint, $type) {
        if ($type === "donor") {
            $stmt = $this->conn->prepare("UPDATE donor SET firstname = ?, lastname = ?, email = ?, password = ?, `group` = ?, dob = ?, gender = ?, pint = ? WHERE id = ?");
        } else {
            $stmt = $this->conn->prepare("UPDATE needer SET firstname = ?, lastname = ?, email = ?, password = ?, `group` = ?, dob = ?, gender = ?, pint = ? WHERE id = ?");
        }

        if ($stmt === false) {
            die("Error preparing the SQL statement: " . $this->conn->error);
        }

        // Bind variables to the prepared statement
        $stmt->bind_param("ssssssisi", $firstname, $lastname, $email, $password, $group, $dob, $gender, $pint, $id);

        // Execute the statement and check for errors
        if ($stmt->execute()) {
            header("Location: dashboard.php?message=Details updated successfully");
            exit();
        } else {
            echo "Error updating details: " . $stmt->error;
            // Log detailed error information
            error_log("SQL Error: " . $stmt->error);
            error_log("SQL Statement: " . $stmt->error);
            error_log("Bound Parameters: " . json_encode([$firstname, $lastname, $email, $password, $group, $dob, $gender, $pint, $id]));
        }

        $stmt->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $group = $_POST['group']; // Changed variable name from $blood_group to $group
    $dob = $_POST['birth_date'];
    $gender = $_POST['gender'];
    $pint = $_POST['pint'];
    $type = $_POST['type']; // Add this field to your form to distinguish between donor and needer

    $userController = new UserController($conn);
    $userController->updateUserDetails($id, $firstname, $lastname, $email, $password, $group, $dob, $gender, $pint, $type);
} else {
    echo "Invalid request method.";
}
?>
