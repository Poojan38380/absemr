<?php

print('<pre>');
init();
print('</pre>');

function init()
{
    // for erver
    $database = live();

    // for local
    // $database = localTest();

    $GLOBALS['userName'] = $database['username'];
    $GLOBALS['password'] = $database['password'];
    $GLOBALS['db'] = $database['database'];

    // Call the addColumn function
    if (addColumn()) {
        echo "Column added successfully";
    } else {
        echo "Error adding column";
    }
}

//for server
function live()
{
    $database = [
        'username' => 'absopenemr',
        'password' => 'HdTp87iU82ExVrF!@#',
        'database' => 'absopenemr',
    ];

    return $database;
}

// for localhost
// function localTest()
// {
//     $database = [
//         'username' => 'openemr1111',
//         'password' => '5HMwK-9@Y2r8CRR',
//         'database' => 'openemr1111',
//     ];

//     return $database;
// }

function addColumn()
{
    $selectQuery = "ALTER TABLE patient_therapeutic_form ADD COLUMN fam_support_recovery TEXT";
    return DBRun($GLOBALS['userName'], $GLOBALS['password'], $GLOBALS['db'], $selectQuery);
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
