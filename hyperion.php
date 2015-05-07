<?php
function ssh($host, $login, $mdp, $command)
{
    if (!function_exists("ssh2_connect")) die("function ssh2_connect doesn't exist");
    if(!($con = ssh2_connect($host, 22))){
        echo "échec connexion\n";
    } else {
        if(!ssh2_auth_password($con, $login, $mdp)) {
            echo "échec authentification\n";
        } else {
            // execute a command
            if (!($stream = ssh2_exec($con, $command ))) {
                echo "échec de l'exécution de la commande\n";
            } else {
                // collect returning data from command
                stream_set_blocking($stream, true);
                $data = "";
                while ($buf = fread($stream,4096)) {
                    $data .= $buf;
                }
                fclose($stream);
                return $data;
            }
        }
    }
}
// connexion SSH raspberry
$ip = "192.168.0.xx";
$login = "root";
$mdp = "openelec";

$command = "sh /storage/hyperion/bin/hyperion-remote.sh -p 50";

$effet = $_GET['effet']; 
$duree = $_GET['duree']; 

if ($duree > 0) {
	$duree = $duree * 1000;
} else {
	$duree = 5000;
}

switch($effet)
{
case 'kr':
	$param = "-e \"Knight rider\""; 
	break;
case 'bmb':
	$param = "-e \"Blue mood blobs\""; 
	break;
case 'gmb':
	$param = "-e \"Green mood blobs\""; 
	break;
case 'rmb':
	$param = "-e \"Red mood blobs\""; 
	break;
case 'rm':
	$param = "-e \"Rainbow mood\""; 
	break;
case 'rsf':
	$param = "-e \"Rainbow swirl fast\""; 
	break;
case 'rs':
	$param = "-e \"Rainbow swirl\""; 
	break;
case 'sb':
	$param = "-e \"Strobe blue\""; 
	break;
case 'sw':
	$param = "-e \"Strobe white\""; 
	break;
case 's':
	$param = "-e \"Snake\""; 
	break;
case 'g':
	$param = "-c green"; 
	break;
case 'b':
	$param = "-c blue"; 
	break;
case 'o':
	$param = "-c orange"; 
	break;
case 'r':
	$param = "-c red"; 
	break;
case 'W':
	$param = "-c white"; 
	break;
default:
	$param = "-x"; 
	break;
}

if ($effet == 'stop') {
     	$param = " -c black";
} else {
	$command .= " -d ".$duree." ";
}

$command .= $param;
$ret = ssh($ip, $login, $mdp, $command);
echo '<pre>' . $ret . '</pre>';
?>