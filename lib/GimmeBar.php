<?php

class GimmeBar
{
        private $_host = 'gimmebar.com';
        private $_token = null;
        private $_cliendId = null;
        private $_clientSecret = null;

        private function request($url,$data,$action='POST')
        {
                $response = '';
                $request = $action." ".$url." HTTP/1.1\r\n";
                foreach($data as $key => $r){
                        $request.=$key.'='.$r.'&';
                }
                $request.="\r\n";

                $fp = fsockopen($this->_host,80,$errno,$errstr);
                if($fp){
                        fputs($fp,$request);
                        while(!feof($fp)){
                                $response.=fread($fp,1024);
                        }
                }else{
                        throw new Exception('Error connecting to GimmeBar: '.$errstr.' ('.$errno.')');
                }
                return $response;
        }
        private function getRequestToken()
        {
                $url = '/api/v0/auth/reqtoken';
                $data = array(
                        'client_id'     => $this->getClientId(),
                        'client_secret' => $this->getClientSecret()
                );
                $response = $this->request($url,$data);
                var_dump($response);
        }
         public function query()
        {
                $this->getRequestToken();
        }
        public function setToken($token)
        {
                $this->_token = $token;
                return $this;
        }
        public function getToken()
        {
                return $this->_token;
        }
        public function setClientId($clientId)
        {
                $this->_clientId = $clientId;
                return $this;
        }
        public function getClientId()
        {
                return $this->_cliendId;
        }
        public function setClientSecret($clientSecret)
        {
                $this->_clientSecret = $clientSecret;
                return $this;
        }
        public function getClientSecret()
        {
                return $this->_clientSecret;
        }

        public function addAsset($title,$source,$desc,$sourceUrl)
        {
                $url = '/api/v0/asset';
                $data = array(
                        'title'         => $title,
                        'source'        => $source,
                        'description'   => $desc, 
                        'url'           => $sourceUrl
                );
                $response = $this->request($url,$data);
                var_dump($response);
        }
}

?>