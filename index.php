<?php
/*==========================*\
#  Created by Sasha Puzikov (www.puzikov.org)
\*==========================*/
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!--
        
    -->
 
    <meta charset="utf-8">
    <meta name="generator" content="project - Youtube Converter" />
    <title>Youtube Converter</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

    <!--
    Update 2.0 (text.css)
     <link href="css/font-awesome.css" rel="stylesheet"> 
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/pages/signin.css" rel="stylesheet" type="text/css">  
    -->
     
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet"> <!-- Open Sans font - googleapis.com -->
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/pages/signin.css" rel="stylesheet" type="text/css"> <!-- oepn signin.css -->
</head>

<body>



<div class="account-container register">
    <div class="content clearfix">
        <form action="get_file.php" method="post">
            <h1 style="text-align: center">Youtube Download</h1>
            <div class="alert alert-info">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <strong>Notice!</strong> This is so easy as 1, 2, 3 to download Mp4, Mp3, 3gp, FLV and other formats.
            </div>

            <div class="login-fields">
                <p><strong>Just put in the video-ID the part after ?v=</strong><br/>
                  <strong>Example:</strong><br/> http://www.youtube.com/watch?v=<strong>tBmIiy68leg</strong>
                </p>

                <div class="field">
                <label for="videoid">First Name:</label>
                    <input required type="text" id="videoid" name="videoid" value="" placeholder="Video ID"/>
                </div>
            </div>

            <div class="login-actions">
                <button class="button btn btn-primary btn-large" style="text-align: center">Start download</button>
            </div>
            <p><center>
<!-- Your Ads here 300X250  -->
<script type='text/javascript'>
var cpma_rnd=Math.floor(Math.random()*99999999999);
document.write("<scr"+"ipt type='text/javascript' src='http://www.cpmaffiliation.com/21564-300x250.js?rnd="+cpma_rnd+"'></scr"+"ipt>");
</script>
<!-- End Ads here -->
</center></p>
        </form>
    </div>
</div>

<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/bootstrap.js"></script>

</body>

</html>
