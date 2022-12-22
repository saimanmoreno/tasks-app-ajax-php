<?php

include('database.php');


if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else {
    echo "NOT FOUND";
}




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

    $name = $_POST['name'];
    $description = $_POST['description'];

    if ($name) {

        $query = "INSERT INTO task(name, description) VALUES ('$name', '$description')";

        $result = mysqli_query($conn, $query);

        if (!$result) {
            die('Query failed! ' . mysqli_error($conn));
        }

        echo "Tarefa criado com sucesso!";
    }
}


function listTasks()
{

    global $conn;

    $query = "SELECT * FROM task";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Query error ' . mysqli_error($conn));
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
