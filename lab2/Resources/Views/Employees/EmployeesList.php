<?php
// The view can be written as HTML + PHP or we can use OOP and make it a class


namespace views;

class EmployeeList
{

    function buildHtml($data)
    {

        // "/Applications/XAMPP/xamppfiles/htdocs/lab2/resources/Templates/header.php";

        require(dirname(__DIR__) . "/../Templates/header.php");
        $html = "
        <table>
            <thead>
                <tr>
                    <th>EmployeeID</th>
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th>Position</th>
                </tr>
            </thead>";

        foreach ($data as $employee) {
            $html .= "<tr>";
            $html .= "<td>{$employee["employeeID"]}</td>";
            $html .= "<td>{$employee["firstName"]}</td>";
            $html .= "<td>{$employee["lastName"]}</td>";
            $html .= "<td>{$employee["title"]}</td>";
            $html .= "</tr>";
        }

        $html .= "</table>";


        //return $html;
        echo $html;
        require(dirname(__DIR__) . "/../Templates/footer.php");
    }
}
