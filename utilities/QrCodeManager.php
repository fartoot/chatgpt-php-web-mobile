<?php

use chillerlan\QRCode\{QRCode, QROptions};
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Output\QRGdImagePNG;

Class QrCodeManager {

    public object $options;
    public string $ipAddress; 
    public string $port;
    public string $dir;
    public string $filename;
    public string $extension;
    public object $qrcode;
    private static ?object $instance = null;
    
    private function __construct($dir,$filename,$extension) {
        $this->dir = $dir;
        $this->filename = $filename;
        $this->extension = $extension;
        $this->getIp();
        $this->getPort();
        $this->options = new QROptions;
        $this->options->version             = 2;
        $this->options->outputInterface     = QRGdImagePNG::class;
        $this->options->outputBase64        = false;
        $this->options->keepAsSquare        = [
            QRMatrix::M_FINDER_DARK,
            QRMatrix::M_FINDER_DOT,
            QRMatrix::M_ALIGNMENT_DARK,
        ];

        $this->qrcode = new QRCode($this->options);
        
    }
    
    public static function create($dir,$filename,$extension){
        if(is_null(self::$instance)){
            self::$instance = new QrCodeManager($dir,$filename,$extension);
        }
        return self::$instance;
    }
    

    public function write(){
        $this->qrcode->render("$this->ipAddress:$this->port","$this->dir/$this->filename.$this->extension");
        
    }

    public function getIp(){
        
        $this->ipAddress = trim(shell_exec("hostname -I | awk '{print $1}'"));
    }
    public function getPort(){
        $this->port = $_SERVER['SERVER_PORT'];
    }

}





