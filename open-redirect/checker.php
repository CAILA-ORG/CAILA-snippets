<?php

echo validateURL('https://google.com/search?q=dog', $blacklist, $whitelist);  // return 'normal'
echo validateURL('https://google.com/', $blacklist, $whitelist);  // return 'normal'
echo validateURL('https://GOOgle.com', $blacklist, $whitelist);   // return 'normal'

echo validateURL('https://facebook.com', $blacklist, $whitelist);   // return 'whitelisted'
echo validateURL('http://facebook.com', $blacklist, $whitelist);   // return 'whitelisted'
echo validateURL('http://evilzone.com.facebook.com', $blacklist, $whitelist);   // return 'whitelisted'
echo validateURL('http://31.13.87.36', $blacklist, $whitelist);   // return 'whitelisted'
echo validateURL('http://[::ffff:31.13.87.36]', $blacklist, $whitelist);   // return 'whitelisted'
echo validateURL('http://[0:0:0:0:0:ffff:31.13.87.36]', $blacklist, $whitelist);   // return 'whitelisted

echo validateURL('http://evilzone.com', $blacklist, $whitelist);   // return 'blacklisted'
echo validateURL('http://subdomain.evilzone.com', $blacklist, $whitelist);   // return 'blacklisted'
echo validateURL('http://subdomain.eVILzonE.com', $blacklist, $whitelist);   // return 'blacklisted'

echo validateURL('http://2398799694', $blacklist, $whitelist);   // return 'invalid'
echo validateURL('http://021676543516', $blacklist, $whitelist);   // return 'invalid'
echo validateURL('http://0x8efac74e', $blacklist, $whitelist);   // return 'invalid'
echo validateURL('http://0x8e.0xfa.0xc7.0x4e', $blacklist, $whitelist);   // return 'invalid'
echo validateURL('http://0216.0372.0307.0116', $blacklist, $whitelist);   // return 'invalid'
echo validateURL('http://0216.0372.199.78', $blacklist, $whitelist);   // return 'invalid'
echo validateURL('http://0x8e.0372.199.78', $blacklist, $whitelist);   // return 'invalid'
echo validateURL('http://0x0008e.0x00000000fa.0x000c7.0x00000000000000000000000004e', $blacklist, $whitelist);   // return 'invalid'
echo validateURL('http://000000000000000000000216.00000372.00000000000000000000307.000000000000116', $blacklist, $whitelist);   // return 'invalid'
echo validateURL('http://1.1', $blacklist, $whitelist);   // return 'invalid'
echo validateURL('http://1.0.1', $blacklist, $whitelist);   // return 'invalid'
echo validateURL('http://142.250.51022', $blacklist, $whitelist);   // return 'invalid'
echo validateURL('https://ⒼⓄⓄⒼⓁⒺ.com', $blacklist, $whitelist)  // return 'invalid'

?>
