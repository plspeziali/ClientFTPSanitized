<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClientFTP
 *
 * @author paolo
 */
class ClientFTP {
    
    private $ftp_server;
    private $port;
    private $username;
    private $password;
    private $rem_file;
    private $loc_file;
    private $conn;
    
    function __construct($ftp_server, $port, $username, $password, $rem_file, $loc_file) {
        $this->ftp_server = $ftp_server;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
        $this->rem_file = $rem_file;
        $this->loc_file = $loc_file;
    }
    
    public function open(){
        $this->conn = ftp_connect($this->ftp_server, $this->port) or die ('Impossibile connettersi al server');
        ftp_login($this->conn, $this->username, $this->password) or die ('username o password errati');
        ftp_pasv($this->conn, true);
    }
    
    public function send(){
        $this->invia = ftp_put($this->conn, $this->rem_file, $this->loc_file, FTP_BINARY);
        return (!$this->invia) ? 'Upload fallito' : 'Upload completato';
    }
    
    public function close(){
        ftp_close($this->conn);
    }
    
}
