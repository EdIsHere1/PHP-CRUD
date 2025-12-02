<?php
    include('./config/database.php');
    session_start();

    $formula = $_POST['formula'] ?? '';

    switch ($formula) {

        case 'employeeT_':
            try {
                $query ="SELECT * FROM ASKI;";
                $stmt =$con->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                $employees = [];
                while ($row = $result->fetch_assoc()) {
                    $employees[] = $row;
                }
                echo json_encode($employees);
                $stmt->close();
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        break;

    }
?>

