<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Contact Form</title>
</head>
<body>
    <div class="container">
    <h1>Contact Form</h1>
        <form action="" method="post">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="text" name="phone" placeholder="Phone No." required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" placeholder="Your Message" required></textarea>

            <div class="g-recaptcha" data-sitekey="6LdzxDMmAAAAANmb7XaHT6ItBgCLogvhKlBpORU-"></div>

            <input type="submit" name="submit" value="Send Message" class="submit-btn">
        </form>
        <div class="status">
            <?php 
                if(isset($_POST['submit'])){
                    $username=$_POST['name'];
                    $phone=$_POST['phone'];
                    $useremail=$_POST['email'];
                    $usermessage=$_POST['message'];
                    
                    $array = array("username" => "$username", "phone" => "$phone", "email" => "$useremail", "message" => "$usermessage");
                    
                    $email_subject="New Form Submission";
                    $email_body="Name: {$array['username']}\nPhone number: {$array['phone']}\nEmail: {$array['email']}\nMessage: {$array['message']}\n";
                    
                    $to_email='patilakhileshr@gmail.com';
                    $headers = "From: {$array['username']} <{$array['email']}>\r\n\Reply-To: {$array['email']}";

                    $secretKey="6LdzxDMmAAAAAPn6Z_y7eq0-Nj8Lp8957RoC1Q7B";
                    $responseKey=$_POST['g-recaptcha-response'];
                    $UserIP=$_SERVER['REMOTE_ADDR'];
                    $url="https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$UserIP";

                    $response= file_get_contents($url);
                    $response= json_decode($response);

                    if($response->success){
                        echo "Message sent successfully";
                    }else{
                        echo "<span>Invalid captcha. Please try again</span>";
                    }
                }
            ?>
        </div>
    </div> 
</body>
</html>