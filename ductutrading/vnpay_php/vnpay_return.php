<?php
    ob_start();
    session_start();
    include './PHPMailer/src/PHPMailer.php';
    include './PHPMailer/src/Exception.php';
    include './PHPMailer/src/OAuth.php';
    include './PHPMailer/src/POP3.php';
    include './PHPMailer/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
//?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <title>VNPAY RESPONSE</title>
        <!-- Bootstrap core CSS -->
        <!-- Bootstrap core CSS -->
        <link href="assets/bootstrap.min.css" rel="stylesheet"/>
        <!-- Custom styles for this template -->
        <link href="assets/jumbotron-narrow.css" rel="stylesheet">
        <script type="text/javascript" src="assets/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="assets/VNPAY_RETURN.js"></script>
    </head>
    <body>
        <?php
        require_once("./config.php");
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        unset($inputData['vnp_SecureHashType']);
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . $key . "=" . $value;
            } else {
                $hashData = $hashData . $key . "=" . $value;
                $i = 1;
            }
        }
//        echo var_dump($inputData);

        //$secureHash = md5($vnp_HashSecret . $hashData);
        $vnp_HashSecret = "DTHXNFNBUMNKFKQOZVHTXUXNUQUUXMTV";;
        $secureHash = hash('sha256',$vnp_HashSecret . $hashData);
        ?>
        <!--Begin display -->
        <div class="container">
            <div class="header clearfix">
                <h3 class="text-muted">VNPAY RESPONSE</h3>
            </div>
            <div class="table-responsive">
                <div class="form-group">
                    <label >Email:</label>
                    <label><?php session_start();
                        echo $_SESSION['email'];

                        ?>
                    </label>
                </div>
                <div class="form-group">
                    <label >Invoice ID:</label>

                    <label><?php echo $_GET['vnp_TxnRef'] ?></label>
                </div>    
                <div class="form-group">

                    <label >Money:</label>
                    <label><?php echo substr($_GET['vnp_Amount'], 0, -2) ?></label>
                </div>  
                <div class="form-group">
                    <label >Pay for:</label>
                    <label><?php echo $_GET['vnp_OrderInfo'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Response Code (vnp_ResponseCode):</label>
                    <label><?php echo $_GET['vnp_ResponseCode'] ?></label>
                </div> 
                <div class="form-group">
                    <label >VNPAY checkout code:</label>
                    <label><?php echo $_GET['vnp_TransactionNo'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Bank Code:</label>
                    <label><?php echo $_GET['vnp_BankCode'] ?></label>
                </div> 
                <div class="form-group">
                    <label >During:</label>
                    <label><?php echo date('Y-m-d') ?></label>
                </div> 
                <div class="form-group">
                    <label >Result:</label>
                    <label>
                        <?php
                        $result = '';
                        if ($secureHash == $vnp_SecureHash) {
                            if ($_GET['vnp_ResponseCode'] == '00') {
                                $result = "Check out successfully";
                                echo $result;
                            } else {
                                $result = "Check out failed";
                                echo $result;
                            }
                        } else {
                            echo "Invalid sign";
                        }
                        ?>
                    </label>
                </div>
                <a class="btn btn-primary" href="http://localhost:63342/ductutrading/index.php">BACK</a>
            </div>
            <p>
                &nbsp;
            </p>
            <footer class="footer">
                <p>&copy; Thanh toán trong thương mại </p>
            </footer>
        </div>  
    </body>
</html>
<?php
$html = "   <div class='header clearfix'>
                <h3 class='text-muted'>VNPAY RESPONSE</h3>
            </div>
            <div class='table-responsive'>
                <div class='form-group'>
                    <label >Email:</label>
                    <label>". $_SESSION['email'] .
                    "</label>
                </div>
                <div class='form-group'>
                    <label >Invoice ID:</label>

                    <label>" .  $_GET['vnp_TxnRef'] . "</label>
                </div>
                <div class='form-group'>

                    <label >Money:</label>
                    <label> " . substr($_GET['vnp_Amount'], 0, -2) . "</label>
                </div>
                <div class='form-group'>
                    <label >Pay for:</label>
                    <label>" . $_GET['vnp_OrderInfo'] . "</label>
                </div>
                <div class='form-group'>
                    <label >Response Code (vnp_ResponseCode):</label>
                    <label>" . $_GET['vnp_ResponseCode'] . "</label>
                </div>
                <div class='form-group'>
                    <label >VNPAY checkout code:</label>
                    <label>" . $_GET['vnp_TransactionNo'] . "</label>
                </div>
                <div class='form-group'>
                    <label >Bank Code:</label>
                    <label>" . $_GET['vnp_BankCode'] . "</label>
                </div>
                <div class='form-group'>
                    <label >During:</label>
                    <label>" . date('Y-m-d') . "</label>
                </div> 
                <div class='form-group'>
                    <label >Result:</label>
                    <label>" .
                        $result
                        .
                    "</label>
                </div>";
$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'ssl://smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'ductuhp135@gmail.com';                 // SMTP username
    $mail->Password = 'buiductu12345';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('ductuhp135@gmail.com', 'Mailer');
    $mail->addAddress($_SESSION['email'], 'Customer Name');     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('ductuhp135@gmail.com', 'Replying Information');
//    $mail->addCC('cc@example.com');
//    $mail->addBCC('bcc@example.com');

    //Attachments
//    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Announcement of your newest invoice';
    $mail->Body    = $html;
    $mail->AltBody = '';

    $mail->send();
    echo '<h4 style="text-align: center"> Message has been sent to your email. Please check your email to know about your newest invoice </h4>';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}