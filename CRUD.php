<?php
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    //credentials
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "vivek";

    //create connection
    $connDB = mysqli_connect($server, $username, $password, $database);

    //delete query
    $sql = "DELETE FROM `crud` WHERE `id` =  $id ";
    $result = mysqli_query($connDB, $sql);

    if ($result) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Congratulations!</strong> Notes Deleted Successfully!!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Sorry!</strong> Something went wrong!!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['editId'])) {
        $id = $_POST['editId'];
        $name = $_POST['nameEdit'];
        $note = $_POST['noteEdit'];

        //credentials
        $server = "localhost";
        $username = "root";
        $password = "";
        $database = "vivek";

        //create connection
        $connDB = mysqli_connect($server, $username, $password, $database);

        $sql = "UPDATE `crud` SET `name`='$name', `note`='$note' WHERE `id`='$id'";
        $result = mysqli_query($connDB, $sql);
        if ($result) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Congratulations!</strong> Notes Updated Successfully!!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        } else {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Sorry!</strong> Something went wrong!!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        }
    } else {
        $name = $_POST['name'];
        $note = $_POST['note'];

        //credentials
        $server = "localhost";
        $username = "root";
        $password = "";
        $database = "vivek";

        //create connection
        $connDB = mysqli_connect($server, $username, $password, $database);

        $sql = "INSERT INTO `crud` (`name`, `note`) VALUES ('$name', '$note')";
        $result = mysqli_query($connDB, $sql);
        if ($result) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Congratulations!</strong> Notes Added Successfully!!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        } else {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Sorry!</strong> Something went wrong!!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <title>PHP CRUD</title>
</head>

<body class="container">

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/CRUD/CRUD.php">
                        <div class="mb-3">
                            <input type="hidden" name="editId" id="editId" value="">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" name="nameEdit" class="form-control" id="editName" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Note</label>
                            <input type="text" name="noteEdit" id="editNote" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Note</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- FORM  -->
    <form method="post" action="/CRUD/CRUD.php">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Note</label>
            <input type="text" name="note" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Add Note</button>
    </form>

    <!-- TABLE -->

    <div class="my-3">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Note</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //credentials
                $server = "localhost";
                $username = "root";
                $password = "";
                $database = "vivek";

                //create connection
                $connDB = mysqli_connect($server, $username, $password, $database);

                //query for getting all dta from database
                $sql = "SELECT * FROM `crud`";
                $result = mysqli_query($connDB, $sql);
                $num = mysqli_num_rows($result);
                //display all data
                $srno = 1;
                if ($num > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                        <th scope='row'>" . $srno . "</th>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['note'] . "</td>
                        <td> <button class='btn btn-sm btn-primary edit' data-bs-toggle='modal' data-bs-target='#editModal' id=" . $row['id'] . ">
                        Edit
                        </button>
                         <button class='btn btn-sm btn-primary delete' id=" . $row['id'] . ">Delete</button> </td>
                        </tr>";
                        $srno++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        edits = document.getElementsByClassName("edit");
        Array.from(edits).forEach((element) => {
            element.addEventListener('click', (e) => {
                tr = e.target.parentNode.parentNode;
                name = tr.getElementsByTagName("td")[0].innerText;
                note = tr.getElementsByTagName("td")[1].innerText;
                id = e.target.id;

                document.getElementById("editName").value = name;
                document.getElementById("editNote").value = note;
                document.getElementById("editId").value = id;
            })
        });

        del = document.getElementsByClassName("delete");
        Array.from(del).forEach((element) => {
            element.addEventListener("click", (e) => {
                id = e.target.id;
                if (confirm("Are you sure?")) {
                    window.location = `/CRUD/CRUD.php?delete=${id}`;
                }
            })
        })
    </script>
</body>

</html>