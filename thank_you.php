<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="images.css">
    <title>Thank You Page</title>
</head>

<body>
    <h1>Thank You Page</h1>
    <div class="navbar">
        <nav>
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
            <input type="text" placeholder="Search">
            <img src="../library/Images/search.svg" alt="logo">
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
            <a href="logout.php">Logout</a>
            <!--<img src="C:\Users\adida\OneDrive - Carleton University\Year 4\Semester 2\IRM4900A (IRM Capstone Project)\IRM Capstone Project Research Paper & Presentation\Work\Code\Toan\Images\search.svg" alt="logo">-->
        </nav>
    </div>
    <?php
    // https://www.geeksforgeeks.org/simple-contact-form-using-html-css-and-php/
    // https://www.w3schools.com/php/php_form_complete.asp
    // Email configuration 
    $toEmail = 'admin@example.com';
    $fromName = 'Sender Name'; // Change this to the sender's name
    $formEmail = 'sender@example.com'; // Change this to the sender's email

    $statusMsg = '';
    $headers = ''; // Define $headers to avoid undefined variable error

    // If the form is submitted 
    if (isset($_POST['submit'])) {
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        $email = trim($_POST['email']);
        $subject = trim($_POST['subject']);
        $Subject = trim($_POST['Subject']);

        // Validate form fields 
        if (empty($firstname)) {
            $statusMsg .= 'Please enter your first name.<br/>';
        }
        if (empty($lastname)) {
            $statusMsg .= 'Please enter your last name.<br/>';
        }
        if (empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $statusMsg .= 'Please enter a valid email.<br/>';
        }
        if (empty($subject)) {
            $statusMsg .= 'Please enter subject.<br/>';
        }

        if (empty($statusMsg)) {
            // Send email notification to the site admin 
            $subject = 'New contact request submitted';
            $htmlContent = " 
            <h2>Contact Request Details</h2> 
            <p><b>First Name: </b>" . $firstname . "</p> 
            <p><b>Last Name: </b>" . $lastname . "</p> 
            <p><b>Email: </b>" . $email . "</p> 
            <p><b>Subject: </b>" . $subject . "</p> 
            <p><b>Subject: </b>" . $Subject . "</p> 
        ";


            // Header for sender info 
            $headers .= 'From:' . $fromName . ' <' . $formEmail . '>' . "\r\n";

            // Send email 
            mail($toEmail, $subject, $htmlContent, $headers);

            $status = 'success';
            header("Location: thank_you.php"); // Redirect after successful submission
        }
    }
    ?>


    <div class="container">
        <p>Thank you! Your contact request has been submitted successfully. We will get back to you soon.</p>
        <button class="button" onclick="window.location.href='contact.php'">Back to Contact Form</button>
    </div>

</html>