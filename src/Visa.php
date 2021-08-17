<?php

namespace Genericmilk;

use stdClass;
use Exception;
use Elliptic\EC;

class Visa
{

    public $publicKey;
    public $jwt;

    public function __construct(){
         
    }
    public function validateJwt(){

        // Final
        $bitCloutPublicKeyDecoded = $this->base58_decode($this->publicKey);
        $ec = new EC('secp256k1');
        $key = $ec->keyFromPublic($bitCloutPublicKeyDecoded, 'hex');
        return $key->verify($msg, $this->jwt);

    }
    private function base58_decode($num) {
        $alphabet = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
        $len = strlen($num);
        $decoded = 0;
        $multi = 1;
     
        for ($i = $len - 1; $i >= 0; $i--) {
            $decoded += $multi * strpos($alphabet, $num[$i]);
            $multi = $multi * strlen($alphabet);
        }
     
        return $decoded;
    }
}