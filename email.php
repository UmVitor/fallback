<?php
        $aux = 0;
        while(true){
           $clients  = shell_exec('curl --user login:password "PATH OF XML ICECAST OF STREAMING" | xmlstarlet sel -t -m "icestats" -v "clients"');
           $fallback = shell_exec('curl --user login:password  "PATH OF XML ICECAST OF STREAMING" | xmlstarlet sel -t -m "icestats" -m "source" -v "title"');

            echo $clients;
            echo $fallback;

            if($clients == 0 && $aux == 0){
                $to = "E-Mail to send a mensage";
                $subject = "SYSTEM DROPED";
                $txt = "The system of streaming(liquidsoap) not execute";
                $headers = "From: " . "\r\n";
                mail($to,$subject,$txt,$headers);
                $aux = 1;
                echo "Send email";
            }
            if($fallback == "Unknown" && $aux == 0){
                 $to = "E-Mail to send a mensage";
                 $subject = "SYSTEM DROPED";
                 $txt = "Drop in link of streaming, pĺaylist of fallback in execution";
                 $headers = "From: " . "\r\n";
                 mail($to,$subject,$txt,$headers);
                 $aux = 1;
                 echo "Send email";

            }
            if ($clients == ""  && $fallback == "" && $aux == 0){
                $to = "E-Mail to send a mensage";
                $subject = "SYSTEM DROPED";
                $txt = "Error to connect in icecast or internet is gone";
                $headers = "From:" . "\r\n";
                mail($to,$subject,$txt,$headers);
                $aux = 1;
                echo "Send email";

            }
            if ($clients > 0 && $fallback != "Unknown"){
                $aux = 0;
            }
                sleep(1);
        }
?>
