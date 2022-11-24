<?php
include 'connection.php';
// Show All Records with Ajax jQuery
if (isset($_GET['show'])) {
    $sql = "SELECT * FROM `students`";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        $output = '';
        while ($row = $result->fetch_assoc()) {
            $output .= '
            <tr>
                <td>' . $row['id'] . '</td>
                <td>' . $row['name'] . '</td>
                <td>' . $row['email'] . '</td>
                <td>' . $row['phone'] . '</td>
                <td>
                    <a href="#" class="btn btn-danger btn-sm deleteBtn" id="' . $row['id'] . '">Delete</a>
                    <a href="#" class="btn btn-info btn-sm editBtn" id="' . $row['id'] . '">Edit</a>
                </td>
            </tr>
            ';
        }
        echo $output;
    } else {
        echo '<h3 class="text-center text-danger">No Record Found</h3>';
    }
}
?>
