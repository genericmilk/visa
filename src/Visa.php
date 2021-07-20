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
            $bitCloutPublicKeyDecoded = base58_decode($this->publicKey);
            $bitCloutPublicKeyDecodedArray = [...$bitCloutPublicKeyDecoded];
            $rawPublicKeyArray = array_slice($bitCloutPublicKeyDecodedArray,3);
            
            dd(
                $bitCloutPublicKeyDecoded,
                $bitCloutPublicKeyDecodedArray,
                $rawPublicKeyArray,
            );

            // PHP
            $ec = new EC('secp256k1');

            $pub = "049a1eedae838f2f8ad94597dc4368899ecc751342b464862da80c280d841875ab4607fb6ce14100e71dd7648dd6b417c7872a6ff1ff29195dabd99f15eff023e5";

            // Signature MUST be either:
            // 1) hex-string of DER-encoded signature; or
            // 2) DER-encoded signature as byte array; or
            // 3) object with two hex-string properties (r and s)

            // case 1
            $sig = '30450220233f8bab3f5df09e3d02f45914b0b519d2c04d13ac6964495623806a015df1cd022100c0c279c989b79885b3cc0f117643317bc59414bfb581f38e03557b8532f06603';

            // case 2
            $sig = [48,69,2,32,35,63,139,171,63,93,240,158,61,2,244,89,20,176,181,25,210,192,77,19,172,105,100,73,86,35,128,106,1,93,241,205,2,33,0,192,194,121,201,137,183,152,133,179,204,15,17,118,67,49,123,197,148,20,191,181,129,243,142,3,85,123,133,50,240,102,3];

            // case 3
            $sig = ['r' => '233f8bab3f5df09e3d02f45914b0b519d2c04d13ac6964495623806a015df1cd', 's' => 'c0c279c989b79885b3cc0f117643317bc59414bfb581f38e03557b8532f06603'];


            // Import public key
            $key = $ec->keyFromPublic($pub, 'hex');

            // Verify signature
            echo "Verified: " . (($key->verify($msg, $sig) == TRUE) ? "true" : "false") . "\n";



    
                //const bitCloutPublicKeyDecoded = bs58check.decode(bitCloutPublicKey);
                //const bitCloutPublicKeyDecodedArray = [...bitCloutPublicKeyDecoded];
                //const rawPublicKeyArray = bitCloutPublicKeyDecodedArray.slice(3);
            
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
}