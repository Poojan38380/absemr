<?php

print('<pre>');
init();
print('</pre>');

function init()
{
    // for erver
    // $database = live();

    // for local
    $database = localTest();

    $GLOBALS['userName'] = $database['username'];
    $GLOBALS['password'] = $database['password'];
    $GLOBALS['db'] = $database['database'];

    // Call the addColumn function
    // if (addColumn()) {
    //     echo "Column added successfully";
    // } else {
    //     echo "Error adding column";
    // }

    // Call the createTable function
    if (createTable()) {
        echo "Table added successfully";
    } else {
        echo "Error creating table";
    }
}

//for server
// function live()
// {
//     $database = [
//         'username' => 'absopenemr',
//         'password' => 'HdTp87iU82ExVrF!@#',
//         'database' => 'absopenemr',
//     ];

//     return $database;
// }

// for localhost
function localTest()
{
    $database = [
        'username' => 'openemr1111',
        'password' => '5HMwK-9@Y2r8CRR',
        'database' => 'openemr1111',
    ];

    return $database;
}

// function addColumn()
// {
//     $selectQuery = "ALTER TABLE patient_therapeutic_form ADD COLUMN fam_support_recovery TEXT";
//     return DBRun($GLOBALS['userName'], $GLOBALS['password'], $GLOBALS['db'], $selectQuery);
// }

function createTable()
{
    $sql = "CREATE TABLE `patient_notice_form` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`full_document` TEXT NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
	`groupname` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`user` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`authorized` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`activity` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`pid` BIGINT(20) NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE ) COLLATE='utf8_general_ci'";

    return DBRun($GLOBALS['userName'], $GLOBALS['password'], $GLOBALS['db'], $sql);
}

function DBRun($username, $password, $dbname, $query)
{
    // Create connection
    $conn = new mysqli('localhost', $username, $password, $dbname);
    mysqli_set_charset($conn, 'utf8');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = $query;
    $result = $conn->query($sql);

    if ($result) {
        $conn->close(); // Close the connection before returning
        return true;
    } else {
        echo "Error: " . $conn->error;
        $conn->close(); // Close the connection before returning
        return false;
    }
}
