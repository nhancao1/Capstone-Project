<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="journals.css">
    <title>Insert Video Page</title>
</head>

<body>
    <h1>Insert Video Page</h1>
    <div class="navbar">
        <nav>

            <img src="images/Ottawa Academic University's Library Management System Logo.png" alt="logo" width="155" height="65">

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
                <button class="dropbtn">Delete Items From Catalogue<i class="fa fa-caret-down"></i></button>
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
            <!-- Source of image: <a href="https://uxwing.com/video-icon/">Video</a>-->
            <a href="index.html"><img src="Images/video.png" alt="video icon" width="50" height="50"></a>
        </nav>
    </div>
    <?php
    // source: https://dev.to/anthonys1760/how-to-insert-form-data-into-a-database-using-html-php-2e8
    // servername => localhost
    // username => root
    // password => empty
    // database name => library
    $conn = mysqli_connect("localhost", "root", "", "library");

    // Check connection
    if ($conn === false) {
        die("ERROR: Could not connect. "
            . mysqli_connect_error());
    }

    // Taking all values from the form data (input)
    $title = $_REQUEST['title'];
    $directors = $_REQUEST['directors'];
    $producers = $_REQUEST['producers'];
    $actors = $_REQUEST['actors'];
    $release_year = $_REQUEST['release_year'];
    $identifier = $_REQUEST['identifier'];
    $description = $_REQUEST['description'];
    $language = $_REQUEST['language'];
    $contributor = $_REQUEST['contributor'];
    $genre = $_REQUEST['genre'];
    $rights = $_REQUEST['rights'];
    $type = $_REQUEST['type'];
    $format = $_REQUEST['format'];
    $keywords = $_REQUEST['keywords'];
    $summary = $_REQUEST['summary'];
    $requester_id = $_REQUEST['requester_id'];

    // Performing insert query execution
    // Here our table name is videos
    //$sql = "INSERT INTO videos VALUES ('$title', 
    //	'$creator' etc.)";

    // We are going to insert the data into our sampleDB table
    $sql = "INSERT INTO videos VALUES ('$title', '$directors', '$producers', '$actors', '$release_year',
		'$identifier', '$description', '$language', '$contributor', '$genre', '$rights', '$type', '$format', '$keywords', '$summary', '$requester_id')";

    // Check if the query is successful
    if (mysqli_query($conn, $sql)) {
        echo "<h3>Data stored in the database successfully. Click button below to go to Modify Videos Page. </h3>";
        echo "Title: $title<br>";
        echo "Director: $directors<br>";
        echo "Producers: $producers<br>";
        echo "Actors: $actors<br>";
        echo "Release Year: $release_year<br>";
        echo "Identifier: $identifier<br>";
        echo "Description: $description<br>";
        echo "Language: $language<br>";
        echo "Contributor: $contributor<br>";
        echo "Genre: $genre<br>";
        echo "Rights: $rights<br>";
        echo "Type: $type<br>";
        echo "Format: $format<br>";
        echo "Keywords: $keywords<br>";
        echo "Summary: $summary<br>";
        echo "Requester ID: $requester_id<br>";
    } else {
        echo "ERROR: Unable to execute statement. " . mysqli_error($conn);
    }
    // Close connection
    mysqli_close($conn);
    ?>

    <form action="modifyvideos.php" method="get">
        <input type="submit" class="button" value="Go to Modify Videos Page">
    </form>

    </center>
</body>

</html>