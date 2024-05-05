<?php
require 'db_connection.php';

function sanitize($input)
{
    return htmlspecialchars($input);
}

$error = "";

if (isset($_POST['del'])) {
    $id = sanitize(trim($_POST['id']));
    $sql_del = "DELETE FROM dissertations WHERE Title = ?";
    $stmt = $conn->prepare($sql_del);
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        // Deletion successful, no need for a success message here
    } else {
        $error = "Error: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="modifydissertations.css">
    <title>Modify Page (Dissertations)</title>
</head>


<body>
    <h1>Modify Page (Dissertations)</h1>
    <div class="navbar">
        <nav>

            <img src="Images/Ottawa Academic University's Library Management System Logo.png" alt="logo" width="155" height="65">

            <a href="index.html">Home</a>
            <a href="about.html">About</a>
            <a href="contact.php">Contact</a>
            <div class="dropdown">
                <button class="dropbtn">Insert Into Catalogue<i class="fa fa-caret-down"></i></button>
                <div class="dropdown-content">
                    <a href="books.html">Books</a>
                    <a href="journals.html">Journals</a>
                    <a href="dissertations.html">Dissertations</a>
                    <a href="images.html">Images</a>
                    <a href="videos.html">Videos</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Modify Catalogue<i class="fa fa-caret-down"></i></button>
                <div class="dropdown-content">
                    <a href="modifybooks.php">Modify Books</a>
                    <a href="modifyjournals.php">Modify Journals</a>
                    <a href="modifydissertations.php">Modify Dissertations</a>
                    <a href="modifyimages.php">Modify Images</a>
                    <a href="modifyvideos.php">Modify Videos</a>
                </div>
            </div>
            <form method="post">
                <select name="keywords">
                    <option value="">All Fields</option>
                    <option value="">Keywords</option>
                    <option value="title">Title</option>
                    <option value="author">Author</option>
                    <option value="creator">Creator</option>
                    <option value="publication_date">Publication Date</option>
                    <option value="subject">Subject</option>
                </select>
            </form>
            <input type="text" placeholder="Search">
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
            <a href="logout.php">Logout</a>
            <!-- Source of image: <a href="https://icons8.com/icon/M9GRuG4p90hG/thesis">Thesis</a>-->
            <a href="index.html"><img src="Images/dissertations.png" alt="dissertations icon" width="50" height="50"></a>
        </nav>
    </div>

    <?php if (isset($error) && $error !== "") { ?>
        <div class="alert">
            <strong>
                <?php echo $error; ?>
            </strong>
        </div>
    <?php } ?>

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Creators</th>
                <th>Identifier</th>
                <th>Publisher</th>
                <th>Publication Date</th>
                <th>Description</th>
                <th>Language</th>
                <th>Contributor</th>
                <th>Sources</th>
                <th>Relation</th>
                <th>Subject</th>
                <th>Rights</th>
                <th>Type</th>
                <th>Coverage</th>
                <th>Format</th>
                <th>Keywords</th>
                <th>Summary</th>
                <th>Requester ID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM dissertations";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
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
                        <?php echo $row['Publisher']; ?>
                    </td>
                    <td>
                        <?php echo $row['Publication_date']; ?>
                    </td>
                    <td>
                        <?php echo $row['Description']; ?>
                    </td>
                    <td>
                        <?php echo $row['Language']; ?>
                    </td>
                    <td>
                        <?php echo $row['Contributor']; ?>
                    </td>
                    <td>
                        <?php echo $row['Sources']; ?>
                    </td>
                    <td>
                        <?php echo $row['Relation']; ?>
                    </td>
                    <td>
                        <?php echo $row['Subject']; ?>
                    </td>
                    <td>
                        <?php echo $row['Rights']; ?>
                    </td>
                    <td>
                        <?php echo $row['Type']; ?>
                    </td>
                    <td>
                        <?php echo $row['Coverage']; ?>
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
                        <?php echo $row['Requester_Id']; ?>
                    </td>
                    <td>
                        <form method='post' action='modifydissertations.php'>
                            <input type='hidden' value="<?php echo $row['Title']; ?>" name='id'>
                            <input type='submit' name='del' value='Delete'>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <form action="dissertations.html">
        <button type="submit">Go to Dissertations Page</button>
    </form>

</body>

<footer>
    &copy; 2024 Ottawa Academic University. All Rights Reserved.
</footer>

</html>
