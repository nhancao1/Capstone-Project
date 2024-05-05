<?php
require 'db_connection.php';

if (isset($_POST['del'])) {
    $id = sanitize(trim($_POST['id']));

    // Use proper parameter binding to avoid SQL injection
    $sql_del = "DELETE FROM books WHERE Title = ?";
    $stmt = $conn->prepare($sql_del);
    $stmt->bind_param("s", $id);

    // Initialize error variable
    $error = "";

    if ($stmt->execute()) {
        // Set success message if deletion was successful
        $error = "Record Deleted Successfully!";
    } else {
        // Set error message if deletion failed
        $error = "Error: " . $conn->error;
    }
}

?>

<div class="container">
    <?php include "nav.php"; ?>
    <!-- navbar ends -->
    <!-- info alert -->
    <div class="alert alert-warning col-lg-7 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-0 col-sm-offset-1 col-xs-offset-0" style="margin-top:70px">
        <span class="glyphicon glyphicon-book"></span>
        <strong>Books</strong> Table
    </div>

    <?php if (isset($error) && $error !== "") { ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>
                <?php echo $error; ?>
            </strong>
        </div>
    <?php } ?>

    <div class="container">
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <div class="row">
                    <a href="addbook.php"><button class="btn btn-success col-lg-3 col-md-4 col-sm-11 col-xs-11 button" style="margin-left: 15px;margin-bottom: 5px"><span class="glyphicon glyphicon-plus-sign"></span> Add Book</button></a>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">
                    </div><!-- /.col-lg-6 -->
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Creators</th>
                        <th>Identifier</th>
                        <th>Language</th>
                        <th>Publication_date</th>
                        <th>Publisher</th>
                        <th>Format</th>
                        <th>Keywords</th>
                        <th>Summary</th>
                        <th>Contributor</th>
                        <th>Requester_Id</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <?php
                if (isset($_POST['search'])) {
                    $text = sanitize(trim($_POST['text']));
                    $sql = "SELECT * FROM books WHERE Title = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $text);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()) { ?>
                        <tbody>
                            <td>
                                <?php echo $row['Title']; ?>
                            </td>
                            <td>
                                <?php echo $row['Creators']; ?>
                            </td>
                            <td>
                                <?php echo $row['Identifier']; ?>
                            </td>
                            <td>
                                <?php echo $row['Language']; ?>
                            </td>
                            <td>
                                <?php echo $row['Publication_date']; ?>
                            </td>
                            <td>
                                <?php echo $row['Publisher']; ?>
                            </td>
                            <td>
                                <?php echo $row['Format']; ?>
                            </td>
                            <td>
                                <?php echo $row['Keywords']; ?>
                            </td>
                            <td>
                                <?php echo $row['Summary']; ?>
                            </td>
                            <td>
                                <?php echo $row['Contributor']; ?>
                            </td>
                            <td>
                                <?php echo $row['Requester_Id']; ?>
                            </td>
                            <form method='post' action='bookstable.php'>
                                <input type='hidden' value="<?php echo $row['Title']; ?>" name='id'>
                                <td><button name='del' type='submit' value='Delete' class='btn btn-warning'>DELETE</button></td>
                            </form>
                        </tbody>
                    <?php }
                } else {
                    $sql2 = "SELECT * FROM books";
                    $result2 = mysqli_query($conn, $sql2);
                    while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                        <tbody>
                            <td>
                                <?php echo $row2['Title']; ?>
                            </td>
                            <td>
                                <?php echo $row2['Creators']; ?>
                            </td>
                            <td>
                                <?php echo $row2['Identifier']; ?>
                            </td>
                            <td>
                                <?php echo $row2['Language']; ?>
                            </td>
                            <td>
                                <?php echo $row2['Publication_date']; ?>
                            </td>
                            <td>
                                <?php echo $row2['Publisher']; ?>
                            </td>
                            <td>
                                <?php echo $row2['Format']; ?>
                            </td>
                            <td>
                                <?php echo $row2['Keywords']; ?>
                            </td>
                            <td>
                                <?php echo $row2['Summary']; ?>
                            </td>
                            <td>
                                <?php echo $row2['Contributor']; ?>
                            </td>
                            <td>
                                <?php echo $row2['Requester_Id']; ?>
                            </td>
                            <form method='post' action='bookstable.php'>
                                <input type='hidden' value="<?php echo $row2['Title']; ?>" name='id'>
                                <td><button name='del' type='submit' value='Delete' class='btn btn-warning'>DELETE</button></td>
                            </form>
                        </tbody>
                <?php }
                }
                ?>
            </table>
        </div>
    </div>
    <div class="modal fade" id="popUpWindow">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- header begins here -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title"> Warning</h3>
                </div>
                <!-- body begins here -->
                <div class="modal-body">
                    <p>Are you sure you want to delete this book?</p>
                </div>
                <!-- button -->
                <div class="modal-footer ">
                    <button class="col-lg-4 col-sm-4 col-xs-6 col-md-4 btn btn-warning pull-right" style="margin-left: 10px" class="close" data-dismiss="modal">No</button>&nbsp;
                    <button class="col-lg-4 col-sm-4 col-xs-6 col-md-4 btn btn-success pull-right" class="close" data-dismiss="modal" data-toggle="modal" data-target="#info">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="info">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- header begins here -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title"> Warning</h3>
                </div>
                <!-- body begins here -->
                <div class="modal-body">
                    <p>Book deleted <span class="glyphicon glyphicon-ok"></span></p>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    </body>

    </html>