<?php
/*==========================*\
#   #
\*==========================*/
// Check download token
if (empty($_GET['mime']) OR empty($_GET['token'])) {
    exit('Invalid download token 8{');
}
// Set operation params
$mime  = filter_var($_GET['mime']);
$ext   = str_replace(array(
    '/',
    'x-'
), '', strstr($mime, '/'));
$url   = base64_decode(filter_var($_GET['token']));
$name  = urldecode($_GET['title']) . '.' . $ext;
$title = urldecode($_GET['title']);
// Fetch and serve
if ($url) {
    // Generate the server headers
    if (isset($_GET['type']) && $_GET['type'] == 'mp3') {
        # Download the video
        $title = str_replace('/', '_', $title);
        $title = $title . '.mp3';
        download($url, $name);
        # Include the CloudConvert class
        require_once 'lib/CloudConvert/CloudConvert.class.php';
        require_once 'includes/config.php';
        $converter = new CloudConvert('mp4', "mp3", $config['cloud_convert_api_key']);
        # Convert the file
        if ($converter->convert('temp/' . $name, "mp3", $path = 'temp/' . $name . '.mp3')) {
            # Send the file to the client
            header("Content-Type: audio/mpeg, audio/x-mpeg, audio/x-mpeg-3, audio/mpeg3");
            header('Content-Disposition: attachment; filename="' . $title . '"');
            header("Content-Transfer-Encoding: binary");
            header('Expires: 0');
            header('Pragma: no-cache');
            readfile($converter->data->output->url);
        } else {
            if (strpos($converter->error, 'exceed')) {
                echo 'The maximum MP3 downloads for today have been exceeded. Please try again tomorrow!';
            } else {
                echo $converter->error;
            }
        }
        if (is_writable(realpath('temp/' . $name))) {
            unlink(realpath('temp/' . $name));
        }
        exit;
    }
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE) {
        header('Content-Type: "' . $mime . '"');
        header('Content-Disposition: attachment; filename="' . $name . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header("Content-Transfer-Encoding: binary");
        header('Pragma: public');
    } else {
        header('Content-Type: "' . $mime . '"');
        header('Content-Disposition: attachment; filename="' . $name . '"');
        header("Content-Transfer-Encoding: binary");
        header('Expires: 0');
        header('Pragma: no-cache');
    }
    readfile($url);
    exit;
}
// Not found
exit('File not found 8');
function download($url, $target)
{
    $fp = fopen('temp/' . $target, 'w+');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    if (!curl_exec($ch)) {
        throw new Exception(curl_error($ch));
    }
    curl_close($ch);
    fclose($fp);
}
?>