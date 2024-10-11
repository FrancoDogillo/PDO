<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SQL Operations</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }
  </style>
</head>

<body>

<?php
// Include database configuration
include('dbconfig.php');

try {
    //SHOW CODE DEMONSTRATING FETCH_ALL(). USE PRINT_R(). WITH “<pre>” TAG IN BETWEEN. 
    $stmt = $conn->prepare("SELECT * FROM Students");
    $stmt->execute();
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h2>All Students:</h2><pre>";
    print_r($students);
    echo "</pre>";



    //SHOW CODE DEMONSTRATING HOW FETCH() IS USED. USE PRINT_R(). WITH “<pre>” TAG IN BETWEEN. 
    $stmt = $conn->prepare("SELECT * FROM Students WHERE student_id = 1");
    $stmt->execute();
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo "<h2>Single Student:</h2><pre>";
    print_r($student);
    echo "</pre>";



    //SHOW CODE DEMONSTRATING INSERTION OF RECORD TO YOUR DATABASE
    $sql = "INSERT INTO Students (student_id, first_name, last_name, date_of_birth, program_id) 
            VALUES (2, 'John', 'Doe', '2000-01-01', 101)";
    $conn->exec($sql);



    
    //SHOW CODE DEMONSTRATING DELETION OF RECORD TO YOUR DATABASE
    $student_id_to_delete = 2; // Change to the ID of the student you want to delete
    $sql = "DELETE FROM Students WHERE student_id = :student_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':student_id', $student_id_to_delete);
    $stmt->execute();

    

    //SHOW CODE DEMONSTRATING UPDATING OF RECORD FROM YOUR DATABASE
    $sql = "UPDATE Students 
            SET first_name = 'Jane', last_name = 'Doe', date_of_birth = '2001-02-02', program_id = 102 
            WHERE student_id = 1"; // Change to the ID of the student you want to update
    $conn->exec($sql);

    


    //SHOW CODE DEMONSTRATING AN SQL QUERY’S RESULT SET IS RENDERED ON AN HTML TABLE
    $stmt = $conn->prepare("SELECT * FROM Students");
    $stmt->execute();
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h2>Students Table:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th><th>Program ID</th></tr>";
    
    foreach ($students as $student) {
        echo "<tr>
                <td>{$student['student_id']}</td>
                <td>{$student['first_name']}</td>
                <td>{$student['last_name']}</td>
                <td>{$student['date_of_birth']}</td>
                <td>{$student['program_id']}</td>
              </tr>";
    }
    
    echo "</table>";
}
catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the connection
$conn = null;
?>

</body>

</html>