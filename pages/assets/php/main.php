<?php
    include('./config/database.php');
    session_start();

    $formula = $_POST['formula'] ?? '';

    switch ($formula) {

        case 'add_employee':
        $name = $_POST['name'];
        $contact = $_POST['contact_no'];
        $address = $_POST['address'];
       
        $query = "SELECT * FROM `ASKI` WHERE name = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $existing = $result->fetch_assoc();
        $stmt->close();

        if (empty($existing)) {
            $insert = "INSERT INTO `ASKI` (`name`, `contact_no`, `address`) VALUES (?, ?, ?)";
            $stmt = $con->prepare($insert);
            $stmt->bind_param("sss", $name, $contact, $address);

            try {
                $exec = $stmt->execute();
                echo ($exec ? 'success' : 'failed');
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }

            $stmt->close();
        } else {
            echo 'exist';
        }
        
        break;

        case 'edit_employee':
            $id = $_POST['edit_id'];
            $edit_name = $_POST['edit_name'];
            $edit_contact = $_POST['edit_contact_no'];
            $edit_address = $_POST['edit_address'];

            $update = "UPDATE `ASKI` SET `name` = ?, `contact_no` = ?, `address` = ? WHERE `id` = ?";
            $stmt = $con->prepare($update);
            $stmt->bind_param("sssi", $edit_name, $edit_contact, $edit_address, $id);

            try {
                $exec = $stmt->execute();
                echo ($exec ? 'success' : 'failed');
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }

            $stmt->close();
        break;

        case 'delete_employee':
            $id = $_POST['id'];

            $delete = "DELETE FROM `ASKI` WHERE `id` = ?";
            $stmt = $con->prepare($delete);
            $stmt->bind_param("i", $id);

            try {
                $exec = $stmt->execute();
                echo ($exec ? 'success' : 'failed');
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }

            $stmt->close();
        break;

        case 'get_employee':
            try {
            $id = $_POST['id'];
            $query = "SELECT 
                            id, 
                            name, 
                            contact_no, 
                            address, 
                            dt_added 
                    FROM ASKI 
                    WHERE id = ?;";
            
            $stmt = $con->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();
            $employees = $result->fetch_assoc();

            echo json_encode($employees ? $employees : []);
            $stmt->close();

        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;

        case 'employeet_':
        try {
            $query = "SELECT * FROM `ASKI`;";
            
            $stmt = $con->prepare($query);
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

    default:
        echo json_encode(["message" => "No valid formula received."]);
        break;
    }
?>