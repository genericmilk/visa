<?php

namespace Genericmilk;

use stdClass;
use Exception;
use Elliptic\EC;

class Visa
{

    public $publicKey;

    public function __construct(){
         
    }
    public function validateJwt(){

            // Final
            $bitCloutPublicKeyDecoded = $this->base58_decode($this->publicKey);
            
            $ec = new EC('secp256k1');
            $key = $ec->keyFromPublic($bitCloutPublicKeyDecoded, 'hex');

            $sig = '30450220233f8bab3f5df09e3d02f45914b0b519d2c04d13ac6964495623806a015df1cd022100c0c279c989b79885b3cc0f117643317bc59414bfb581f38e03557b8532f06603';

            return $key->verify($msg, $sig);

            
            /*
                const rawPublicKeyHex = ec
                    .keyFromPublic(rawPublicKeyArray, "hex")
                    .getPublic()
                    .encode("hex", true);  
                const keyEncoder = new KeyEncoder("secp256k1");
                const rawPublicKeyEncoded = keyEncoder.encodePublic(
                    rawPublicKeyHex,
                    "raw",
                    "pem"
                );
        
                result = jsonwebtoken.verify(jwtToken, rawPublicKeyEncoded, {
                    algorithms: ["ES256"],
                });
        
                result = "OK";
            */

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