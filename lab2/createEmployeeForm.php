<html>


<body>
    <form method="POST" action="index.php?employees"> <!--action=path of another page to bring it there-->
        <label for="empId">Employee ID:</label><br>
        <input type="number" id="empId" name="empId"><br>
        <label for="fname">First name:</label><br>
        <input type="text" id="fname" name="fname"><br>
        <label for="lname">Last name:</label><br>
        <input type="text" id="lname" name="lname"><br>
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title"><br>
        <label for="depId">Department ID:</label><br>
        <input type="number" id="depId" name="depId"><br>
        <input type="submit" value="Create">
    </form>

    <?php


//I MOVED THIS TO THE INDEX PAGE

    // use models\Employee;
    // require(__DIR__ . '/Models/employee.php');

    // if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //     if (isset($_POST)) {
    //         echo $_POST['fname'] . "-" . $_POST['lname'] . "-" . $_POST['title'] . "-" . $_POST['empId'] . "-" . $_POST['depId'];
    //         $employee = new Employee();
    //         $employee->setEmpID($_POST['empId']);
    //         $employee->setFirstName((string) $_POST['fname']);
    //         $employee->setLastName((string)$_POST['lname']);
    //         $employee->setTitle((string)$_POST['title']);
    //         $employee->setDepID((int) $_POST['depId']);
    //         $employee->create();
    //         header("Location: " . $SERVER['PHP_SELF']);
    //     }
    // } else {
    //     echo "Request method is " . $_SERVER['REQUEST_METHOD'];
    // }
    ?>

</body>



</html>