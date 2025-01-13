<?php
// Setting up Database
$servername = "localhost";
$username = "root";
$password = "Test123";
$dbname = "test";

function init_connection()
{
    try {

        global $servername, $username, $password, $dbname;
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// setting the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function create_tables($conn): void
{
    try {
        $sql = "CREATE TABLE IF NOT EXISTS Students (
            studentID INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            title VARCHAR(30) NOT NULL,
            year int(11) NOT NULL,
            faculty VARCHAR(30) NOT NULL,
            department VARCHAR(30) NOT NULL
            )";
        $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS Hours (
            studentID INT PRIMARY KEY,
            teachinghoursdone INT DEFAULT 0,
            teachinghourstotal INT NOT NULL,
            researchhoursdone INT DEFAULT 0,
            researchhourstotal INT NOT NULL,
            otherhoursdone INT DEFAULT 0,
            otherhourstotal INT NOT NULL,
            FOREIGN KEY(studentID) REFERENCES Students(studentID)
            )";
        $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS Countdown (
            studentID INT PRIMARY KEY,
            pqedate DATE NOT NULL,
            phddefense DATE NOT NULL,
            FOREIGN KEY(studentID) REFERENCES Students(studentID)
            )";
        $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS Modules (
            moduleID INT AUTO_INCREMENT PRIMARY KEY,
            modulename VARCHAR(30) NOT NULL,
            modulemcs int NOT NULL Check (modulemcs = 4 or modulemcs = 8)
            )";
        $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS StudentsModules (
            studentID INT NOT NULL,
            moduleID INT NOT NULL,
            enrolldate DATE,
            grade varchar(30),
            Foreign Key(studentID) REFERENCES Students(studentID),
            Foreign Key(moduleID) REFERENCES Modules(moduleID),
            Primary Key(studentID, moduleID)
            )";
        $conn->exec($sql);
        echo "Tables Created";
    } catch (PDOException $e) {
        echo "Unable to create tables: " . $e->getMessage();
    }
}

function insertData($conn): void
{
    try {
        $sql = "INSERT INTO Students VALUES (1, 'Sherry', 'PGF Scholar', 4, 'School of Medicine', 'Department of Biochemistry')";
        $conn->exec($sql);
        $sql = "INSERT INTO Hours VALUES (1, 10, 40, 30, 40, 15, 40)";
        $conn->exec($sql);
        $sql = "INSERT INTO Countdown VALUES (1, '2024-10-22', '2026-10-22')";
        $conn->exec($sql);
        $sql = "INSERT INTO Modules VALUES (1, 'AR5652 PhD Lesson', 8),
                                           (2, 'AR5653 PhD Thesis', 8),
                                           (3, 'AR6764 R-Programming', 4),
                                           (4, 'MA2345 Thesis with Math', 8)";
        $conn->exec($sql);
        $sql = "INSERT INTO StudentsModules (studentID, moduleID, enrolldate) VALUES (1, 1, '2024-01-01'),
                                                                    (1, 2, '2024-01-01'),
                                                                    (1, 3, '2024-01-01'),
                                                                    (1, 4, '2024-01-01')";
        $conn->exec($sql);
        echo "Data inserted successfully.";
    } catch (PDOException $e) {
        echo "Unable to insert: " . $e->getMessage();
    }
}

function dropTable($conn): void
{
    try {
        $sql = "DROP TABLE IF EXISTS StudentsModules, Modules, Countdown, Hours, Students";
        $conn->exec($sql);
    } catch (PDOException $e) {
        echo "Unable to drop: " . $e->getMessage();
    }
}

function resetDB($conn): void
{
    dropTable($conn);
    create_tables($conn);
    insertData($conn);
}

function fetchModules($conn, $studentID): array
{
    try {
        $modules = array();
        $sql = "Select modulename, modulemcs from Modules where moduleID in 
                                                (SELECT moduleID FROM StudentsModules Where studentID = $studentID)";
        $result = $conn->query($sql);
        while ($row = $result->fetch()) {
            $modules[] = $row;
        }
        return $modules;
    } catch (PDOException $e) {
        echo "Unable to fetch data:" . $e->getMessage();
    }
    return array();
}

function fetchDates($conn, $studentID): array
{
    try {
        $sql = "Select pqedate, phddefense from Countdown where studentID = $studentID";
        $result = $conn->query($sql);
        return $result->fetch();
    } catch (PDOException $e) {
        echo "Unable to fetch data:" . $e->getMessage();
    }
    return array();
}

function fetchHours($conn, $studentID): array
{
    try {
        $sql = "Select teachinghoursdone, teachinghourstotal, researchhoursdone, researchhourstotal, otherhoursdone, otherhourstotal FROM Hours where studentID = $studentID";
        $result = $conn->query($sql);
        return $result->fetch();
    } catch (PDOException $e) {
        echo "Unable to fetch data:" . $e->getMessage();
    }
    return array();
}

function insertStudentModule($conn, $moduleName, $moduleMCs, $studentID): void
{
    try {
        // First check if module exists
        $sql = "Select moduleID FROM Modules where (modulename = :moduleName and modulemcs = :moduleMCs) ";
        $stmt = $conn->prepare($sql);

        // Bind the corresponding parameters
        $stmt->bindParam(':moduleName', $moduleName);
        $stmt->bindParam(':moduleMCs', $moduleMCs);

        // Exec and Obtain result
        $stmt->execute();
        $id = $stmt->fetch();
        if ($id) {
            $sql = "INSERT INTO StudentsModules (studentID, moduleID) VALUES ('$studentID', '$id[0]')";
            $conn->exec($sql);
        } else {
            $sql = "INSERT INTO Modules (modulename, modulemcs) VALUES (:moduleName, :moduleMCs)";
            $stmt = $conn->prepare($sql);
            // Bind the corresponding parameters
            $stmt->bindParam(':moduleName', $moduleName);
            $stmt->bindParam(':moduleMCs', $moduleMCs);
            // Exec and Obtain result
            $stmt->execute();

            $sql = "Select moduleID FROM Modules where (modulename = :moduleName and modulemcs = :moduleMCs) ";
            $stmt = $conn->prepare($sql);

            // Bind the corresponding parameters
            $stmt->bindParam(':moduleName', $moduleName);
            $stmt->bindParam(':moduleMCs', $moduleMCs);

            // Exec and Obtain result
            $stmt->execute();
            $id = $stmt->fetch();
            $sql = "INSERT INTO StudentsModules (studentID, moduleID) VALUES ('$studentID', '$id[0]')";
            $conn->exec($sql);
        }
    } catch (PDOException $e) {
        echo "Unable to insert data:" . $e->getMessage();
    }
}

function removeModule($conn, $moduleName, $moduleMCs, $studentID): void
{
    try {
        $sql = "Select moduleID FROM Modules where (modulename = '$moduleName' and modulemcs = '$moduleMCs') ";
        $result = $conn->query($sql);
        $id = $result->fetch();
        $sql = "DELETE FROM StudentsModules where studentID = $studentID and moduleID = $id[0]";
        $conn->exec($sql);
    } catch (PDOException $e) {
        echo "Unable to remove module:" . $e->getMessage();
    }
}

function updateHours($conn, $hours, $studentID): void
{
    try {
        // Filter out null values from hours
        $validUpdates = array_filter($hours, function ($value) {
            return $value !== null;
        });

        // If no valid updates, just return
        if (empty($validUpdates)) {
            return;
        }

        // Build the SET clause dynamically
        $setClause = implode(", ", array_map(function ($key) {
            return "$key = :$key";
        }, array_keys($validUpdates)));

        // Build the SQL query
        $sql = "UPDATE Hours SET $setClause WHERE studentID = '$studentID'";
        echo $sql;

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind parameters
        foreach ($validUpdates as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        // Execute the query
        $stmt->execute();

        echo "Database updated successfully.";
    } catch (PDOException $e) {
        echo "Error updating database: " . $e->getMessage();
    }
}

function updateCountdown($conn, $final, $studentID): void
{
    try {
        echo $final;
        // Filter out null values from updates
        $validUpdates = array_filter($final, function ($value) {
            return $value !== "";
        });

        // If no valid updates, return
        if (empty($validUpdates)) {
            echo "No updates to make.";
            return;
        }

        // Build the SET clause dynamically
        $setClause = implode(", ", array_map(function ($key) {
            return "$key = :$key";
        }, array_keys($validUpdates)));

        // Build the SQL query
        $sql = "UPDATE Countdown SET $setClause WHERE studentID = '$studentID'";
        echo $sql;

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind parameters
        foreach ($validUpdates as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        // Execute the query
        $stmt->execute();

        echo "Database updated successfully.";
    } catch (PDOException $e) {
        echo "Error updating database: " . $e->getMessage();
    }
}

