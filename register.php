<?php
session_start();

if (isset($_SESSION['logged_user_id'])) {
    header('Location: logout.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") :
    require_once __DIR__ . "/db_connection.php";
    require_once __DIR__ . "/on_register.php";
    if (
        isset($conn) &&
        isset($_POST["name"]) &&
        isset($_POST["email"]) &&
        isset($_POST["password"])
    ) {
        $result = on_register($conn);
    }
endif;

// If the user is registered successfully, don't show the post values.
$show = isset($result["form_reset"]) ? true : false;

function post_value($field)
{
    global $show;
    if (isset($_POST[$field]) && !$show) {
        echo 'value="' . trim(htmlspecialchars($_POST[$field])) . '"';
        return;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--source: https://www.devbabu.com/how-to-make-php-mysql-login-registration-system/-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="contact.css">
    <title>Register</title>
</head>

<body>
    <h1>Register</h1>
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
            <!--<img src="C:\Users\adida\OneDrive - Carleton University\Year 4\Semester 2\IRM4900A (IRM Capstone Project)\IRM Capstone Project Research Paper & Presentation\Work\Code\Toan\Images\search.svg" alt="logo">-->
        </nav>

    </div>
    </div>
    <div class="container">
        <form action="" method="POST" id="theForm">
            <label for="user_name">Name: <span></span></label>
            <input type="text" class="input" name="name" <?php post_value("name"); ?>-attr-name">


            <label for="user_email">Email: <span></span></label>
            <input type="email" class="input" name="email" <?php post_value("email"); ?>-attr-name">

            <label for="user_pass">Password: <span></span></label>
            <input type="password" class="input" name="password" <?php post_value("password"); ?>-attr-name">

            <?php if (isset($result["msg"])) { ?>
                <p class="msg<?php if ($result["ok"] === 0) {
                                    echo " error";
                                } ?>">
                    <?php echo $result["msg"]; ?>
                </p>
            <?php } ?>
            <div class="link"><a href="./login.php">Login</a></div>
            <input type="submit" value="Register">
        </form>
    </div>
    <?php
    // JS code to show errors
    if (isset($result["field_error"])) { ?>
        <script>
            let field_error = <?php echo json_encode($result["field_error"]); ?>;
            let el = null;
            let msg_el = null;
            for (let i in field_error) {
                el = document.querySelector(`input[name="${i}"]`);
                el.classList.add("error");
                msg_el = document.querySelector(`label[for="${el.getAttribute("id")}"] span`);
                msg_el.innerText = field_error[i];
            }
        </script>
    <?php } ?>
</body>


<footer>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    &copy; 2024 Ottawa Academic University. All Rights Reserved.
</footer>

</html>