<?php

include('database.php');

$action = $_POST['action'];

$action();

function searchTasks()
{

    global $conn;

    $searchText = $_POST['searchText'];

    if (!empty($searchText)) {

        $query = "SELECT * FROM task WHERE name LIKE '%$searchText%'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die('Query error' . mysqli_error($conn));
        }

        $json = array();

        // percorrer o resultado e converté-lo em um json
        while ($row = mysqli_fetch_array($result)) {
            $json[] = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description']
            );
        }

        $jsonstring = json_encode($json);

        echo $jsonstring;
    }
}

function createTask()
{

    global $conn;

    $newTask = $_POST['newTask'];

    /*
    if (!empty($newTask)) {

        $query = "CREATE * FROM task WHERE name LIKE '%$searchText%'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die('Query error' . mysqli_error($conn));
        }

        $json = array();

        // percorrer o resultado e converté-lo em um json
        while ($row = mysqli_fetch_array($result)) {
            $json[] = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description']
            );
        }

        $jsonstring = json_encode($json);

        echo $jsonstring;
    }
    */
}


function listTasks()
{

    global $conn;

    $tasks = $_POST['tasks'];

    /*
    if (!empty($newTask)) {

        $query = "CREATE * FROM task WHERE name LIKE '%$searchText%'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die('Query error' . mysqli_error($conn));
        }

        $json = array();

        // percorrer o resultado e converté-lo em um json
        while ($row = mysqli_fetch_array($result)) {
            $json[] = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description']
            );
        }

        $jsonstring = json_encode($json);

        echo $jsonstring;
    }
    */
}


function deleteTask()
{

    global $conn;

    $task = $_POST['task'];

    /*
    if (!empty($newTask)) {

        $query = "CREATE * FROM task WHERE name LIKE '%$searchText%'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die('Query error' . mysqli_error($conn));
        }

        $json = array();

        // percorrer o resultado e converté-lo em um json
        while ($row = mysqli_fetch_array($result)) {
            $json[] = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description']
            );
        }

        $jsonstring = json_encode($json);

        echo $jsonstring;
    }
    */
}