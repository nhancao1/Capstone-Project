<?php
// Define variables and set to empty values
$firstnameErr = $lastnameErr = $emailErr = $subjectErr = "";
$firstName = $lastName = $subject = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate First Name
    if (empty($_POST["firstname"])) {
        $firstnameErr = "First name is required";
    } else {
        $firstName = test_input($_POST["firstname"]);
        // Check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $firstName)) {
            $firstnameErr = "Only letters and white space allowed";
        }
    }

    // Validate Last Name
    if (empty($_POST["lastname"])) {
        $lastnameErr = "Last name is required";
    } else {
        $lastName = test_input($_POST["lastname"]);
        // Check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lastName)) {
            $lastnameErr = "Only letters and white space allowed";
        }
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // Check if email address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Check if the subject field is empty
    if (empty($_POST["subject"])) {
        $subjectErr = "Subject is required";
    } else {
        $subject = test_input($_POST["subject"]);
    }


    // No errors, proceed with form submission
    if (empty($firstnameErr) && empty($lastnameErr) && empty($emailErr) && empty($subjectErr)) {
        // Process your form submission here
        // You can redirect to thank_you.php or handle the submission in this block
        // For simplicity, let's redirect to thank_you.php
        header("Location: thank_you.php");
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="contact.css">
    <!--source: https://www.w3schools.com/howto/howto_css_contact_form.asp-->
    <title>Contact Page</title>
</head>


<body>
    <h1>Contact Us</h1>
    <div class="navbar">
        <nav>

            <img src="images/Ottawa Academic University's Library Management System Logo.png" alt="logo" width="156" height="90">

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
            <!-- Source of image: https://www.freepik.com/icons/contact From FreePik-->
            <a href="contact.php"><img src="images/email.png" alt="email icon" width="50" height="50"></a>
        </nav>
    </div>

    <p>Contact us if you need help searching for items.</p>

    <div class="container">
        <!-- https://www.w3schools.com/php/php_forms.asp-->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="fname">First Name</label>
            <input type="text" id="fname" name="firstname" placeholder="First Name">
            <span class="error"><?php echo $firstnameErr; ?></span><br><br>

            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="lastname" placeholder="Last Name">
            <span class="error"><?php echo $lastnameErr; ?></span><br><br>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Email">
            <span class="error"><?php echo $emailErr; ?></span><br><br>

            <label for="subject">Subject</label>
            <textarea id="subject" name="subject" placeholder="Write your message here..."></textarea><br><br>
            <span class="error"><?php echo $subjectErr; ?></span><br><br>

            <button type="submit" class="button">Submit</button>
        </form>
    </div>

    <footer>
        <div class="icon-bar">
            <a href="https://www.facebook.com" class="fa fa-facebook"></a>
            <a href="https://www.x.com" class="fa fa-twitter"></a>
            <a href="https://www.instagram.com" class="fa fa-instagram"></a>
        </div>
        &copy; 2024 Ottawa Academic University. All Rights Reserved.
    </footer>
</body>

</html>