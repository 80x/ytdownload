<?php
/*
 * C
/*==========================*\
#   #
\*==========================*/

class CloudConvert
{
    /*
     * Maximum conversion timeout.
     * This should be adjusted based on your PHP configuraion (max_execution_time etc)
     * Only necesarry for server side conversions
     */
    const TIMEOUT = 180;
    private $apikey;
    private $url;
    /*
     * Constructor creates the Process ID.
     * see: https://cloudconvert.org/page/api#start
     *
     */
    public function __construct($inputformat, $outputformat, $apikey = null)
    {
        $this->apikey = $apikey;
        $data         = $this->req('https://api.cloudconvert.org/process', array(
            'inputformat' => $inputformat,
            'outputformat' => $outputformat,
            'apikey' => $apikey
        ));
        if ($data === false)
            return false;
        if (strpos($data->url, 'http') === false)
            $data->url = "https:" . $data->url;
        $this->url = $data->url;
    }
    /*
     * Does the actual conversion (server side)
     */
    public function convert($filepath, $outputformat, $target)
    {
        $file = pathinfo($filepath);
        $this->req($this->url, array(
            'input' => 'upload',
            'format' => $outputformat,
            'file' => '@' . $filepath
        ));
        $time = 0;
        /*
         * Check the status every second, up to timeout
         */
        while ($time <= self::TIMEOUT) {
            sleep(1);
            $time++;
            if ($this->req($this->url) === false)
                return false;
            $this->data = $this->req($this->url);
            if ($this->data->step == 'error') {
                throw new Exception($this->data->message);
                return false;
            } elseif ($this->data->step == 'finished' && isset($this->data->output) && isset($this->data->output->url)) {
                if (strpos($this->data->output->url, 'http') === false) {
                    $this->data->output->url = "https:" . $this->data->output->url;
                }
                return true;
            }
        }
        throw new Exception('Timeout');
        return false;
    }
    public function getURL()
    {
        return $this->url;
    }
    private function req($url, $post = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        /*
         * Remove this option for productive use!
         * Therefore it may be necessary to store the certificate locally.
         */
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        if (!empty($post)) {
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        $return = curl_exec($ch);
        if ($return === FALSE) {
            return false;
        } else {
            $json = json_decode($return);
            if (isset($json->error)) {
                $this->error = $json->error;
                return false;
            }
            return $json;
        }
        curl_close($ch);
    }
}
?>