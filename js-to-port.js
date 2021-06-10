
const jsonwebtoken = require("jsonwebtoken");
const EC = require("elliptic").ec;
const ec = new EC("secp256k1");
const KeyEncoder = require("key-encoder").default;
const bs58check = require("bs58check");


var myArgs = process.argv.slice(2);
let jwtToken = null;
let bitCloutPublicKey = null;

if (myArgs[0] && myArgs[1]) {
    bitCloutPublicKey = myArgs[0]
    jwtToken = myArgs[1]
} else {
    console.log('Required parameters missing')
    process.exit()
}

console.log(bitCloutPublicKey);
console.log(jwtToken);


const result = validateJwt(bitCloutPublicKey, jwtToken);
console.log(result);
return result;

function validateJwt(bitCloutPublicKey, jwtToken) {

    let result = null;
    try {
        const bitCloutPublicKeyDecoded = bs58check.decode(bitCloutPublicKey);
        const bitCloutPublicKeyDecodedArray = [...bitCloutPublicKeyDecoded];
        const rawPublicKeyArray = bitCloutPublicKeyDecodedArray.slice(3);
    
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
    } catch (e) {
        if (e instanceof Error) {
            result = "ERROR: Error";
        } else if (e instanceof Error) {
            result = "ERROR: Error";
        } else {
            result = "ERROR: Unknown";
        }
    }    
    return result;
}