<?php

class recaptchaVerifier {

    public function __construct($response) {
        $this->secret = '6LcOZOgUAAAAANfmKS5PvC9lKVFs1gjLjaBjsiox';
        $this->response = $response;
    }

    function getcurl($data) {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
       foreach ($data as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');

        $ch = curl_init();
        //$headers = array('User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 'Accept: text/plain, */*; q=0.01', 'Accept-Language: es-ES,es;q=0.8,en-US;q=0.5,en;q=0.3', 'Accept-Encoding: gzip, deflate', 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8', 'X-Requested-With: XMLHttpRequest', 'Referer: http://nuevacomprarelojes.festina.com/compra-relojes-war/Home.wg');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        return $result;
    }

    public function verify() {
        $data = array(
            'secret' => $this->secret,
            'response' => $this->response
        );
        $result = json_decode($this->getcurl($data));
        if ($result->score < 0.5) return false;
        return true;
    }

}
