<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Bulk Mailer</title>
  </head>
  <body>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  


    <form class="container m-5" enctype="multipart/form-data" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
      <div class="form-group row">
        <label for="fromMail" class="col-sm-2 col-form-label">Form Mail</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name='fromMail' id="id_fromMail" value="" />
        </div>
      </div>

      <div class="form-group row">
        <label for="dName" class="col-sm-2 col-form-label">Display Name</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name='dName' id="id_dName" value="" />
        </div>
      </div>

      <div class="form-group row">
        <label for="userfile" class="col-sm-2 col-form-label">Emails file list</label>
        <div class="col-sm-8">
          <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
          <input type="file" name="userfile" id="id_userfile" class="form-control-plaintext" value="" />
        </div>
      </div>

      <div class="form-group row">
        <label for="subText" class="col-sm-2 col-form-label">Subject Text</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name='subText' id="id_subText" placeholder='Subject Text' value="" />
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-10">
          <button type="submit" class="btn btn-primary btn-lg btn-block" name='submit'>Send</button>
        </div>
      </div>


    </form>

    <?php
      header('Content-Type: text/html; charset=utf-8');
      //Load Composer's autoloader
      require 'vendor/autoload.php';
      // require_once ('vendor/autoload.php'); // if you use Composer
      
      
      //Import PHPMailer classes into the global namespace
      //These must be at the top of your script, not inside a function
      use PHPMailer\PHPMailer\PHPMailer;
      use PHPMailer\PHPMailer\SMTP;
      use PHPMailer\PHPMailer\Exception;
      
      use GuzzleHttp\Client;
      use GuzzleHttp\Exception\RequestException;
      use GuzzleHttp\Psr7\Request;
      

      // $target_dir = "uploads/";
      // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      // $uploadOk = 1;
      // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


      if (isset($_POST['submit'])) {
        # code...
        $bot_api_key  = '';
        $bot_username = '';

        try {
            // Create Telegram API object
            $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

            // Handle telegram webhook request
            $telegram->handle();
            echo $telegram;
        } catch (Longman\TelegramBot\Exception\TelegramException $e) {
            // Silence is golden!
            // log telegram errors
            echo $e->getMessage();
        }

        $params=array(
          'token' => '',
          'to' => '',
          'body' => 'Explorer Testing this!!!'
          );
          $curl = curl_init();
          curl_setopt_array($curl, array(
            CURLOPT_URL => "",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_HTTPHEADER => array(
              "content-type: application/x-www-form-urlencoded"
            ),
          ));
          
          $response = curl_exec($curl);
          $err = curl_error($curl);
          
          curl_close($curl);
          
          if ($err) {
            echo "cURL Error #:" . $err;
          } else {
            echo $response;
          }

        $uploaddir = 'uploads/';
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

        echo '<pre>';
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            echo "File is valid, and was successfully uploaded.\n";
            $fp = @fopen($uploadfile, "r");
            if (!$fp) {
              echo 'Could not open file somefile.txt';
            }
            while (!feof($fp)) {
              $buffer = fgets($fp, 4096);
              echo $buffer;
            }
            fclose ($fp);
          
        } else {
            echo "Possible file upload attack!\n";
        }

        print "</pre>";
            
      } else {
        # code...
        echo "Try the needful thing!!!";
      }
      
    
    ?>

</body>
</html>