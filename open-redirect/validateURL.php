<?php
$blacklist = ['evilzone.com', 'attacker.com', 'myphishingsite.com'];
$whitelist = ['facebook.com' , 'oculus.com', 'thefacebook.net', '31.13.87.36'];

function validateURL($url, $blacklist = [], $whitelist = []) {
  // get hostname (domain or IP address)
  $host = parse_url($url, PHP_URL_HOST);
  echo $host.'<br>';

  if(preg_match("/^(([a-zA-Z]|[a-zA-Z][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z]|[A-Za-z][A-Za-z0-9\-]*[A-Za-z0-9])$/", $host)) {
    // if host is a domain
    $host = strtolower($host);
  } elseif(preg_match('/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/', $host)) {
    // if host is a proper IPv4
    // just fine
  } elseif(preg_match('/^(\[::ffff:|\[0:0:0:0:0:ffff:)(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\]$/', $host)) {
    // if host is IPv6/IPv4 embedding format
    // get the IPv4 part by separating using ":"
    $parts = explode(':', $host);
    $host = $parts[count($parts) - 1];
    // then remove ] in the right
    $host = rtrim($host, '] ');
  } else {
    return 'invalid';
  }

  // run against the blacklist
  for($i = 0; $i < count($blacklist); $i++) {
    // generate pattern to make sure that even the subdomains are handled
    $pattern = "/" . preg_quote($blacklist[$i], "/") . '$/';
    // check if the blacklist pattern matches the host
    if(preg_match($pattern, $host)) {
      return 'blacklisted';
    }
  }

  // run against the whitelist
  for($i = 0; $i < count($whitelist); $i++) {
    // generate pattern to make sure that even the subdomains are handled
    $pattern = "/" . preg_quote($whitelist[$i], "/") . '$/';
    // check if the whitelist pattern matches the host
    if(preg_match($pattern, $host)) {
      return 'whitelisted';
    }
  }

  // if its not blacklisted/whitelisted/invalid, it means the host is normal
  return 'normal';
}
?>
