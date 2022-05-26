<?php 
include ('../vendor/autoload.php'); 
use \Firebase\JWT\JWT; 
use \Firebase\JWT\Key; 
$key = "JSPHPWORKS4ever&ever!"; 
if (isset($_GET['email'])) {
    if (getEmail($_GET['email']) == "uts.edu.co")
    {
        $token = array(
            $_GET['email']
        );
        $jwt = JWT::encode($token, $key, 'HS256');
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "http://172.16.7.85:9091/endpoint/carnet/{$jwt}",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$data = curl_exec($curl);
curl_close($curl);
        $json = json_decode($data, true);
        $rta = $json["data"];
        if (strlen($rta) >= 180)
        {
            $decoded = JWT::decode($rta, new Key($key, 'HS256'));
            $position = $decoded->resp[0];
            $sede = $position->C_UNID_NOMBRE;
            $carrera = $position->C_PROG_NOMBRE;
            $myMail = $position->C_PENG_EMAILINSTITUCIONAL;
            $firstname = $position->C_PENG_PRIMERNOMBRE . " " . $position->C_PENG_SEGUNDONOMBRE;
            $lastname = $position->C_PENG_PRIMERAPELLIDO . " " . $position->C_PENG_SEGUNDOAPELLIDO;
            $fullname = $firstname . " " . $lastname;
            $cedula = $position->C_PEGE_DOCUMENTOIDENTIDAD;
            if ($myMail == $_GET['email'])
            {
                $ans = "{$fullname} identificado con {$cedula} se encuentra cursando {$carrera} en {$sede}";
            }
        }
        else
        {
            $ans = "El usuario con {$_GET['email']} no tiene una matricula vigente";
        }
    }
    else
    {
        $ans = "El usuario consultado no está en este dominio";
    }
}else{
header("Location: index.php");
}
function getEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $explode = explode('@', $email);
        $domain = array_pop($explode);
    }
    return $domain;
}
?> 
<!DOCTYPE html> <html lang="en"> <head> <?php include ("header.php"); ?> </head> <body>
        <div class="limiter">
                <div class="container-login100">
                        <div class="wrap-login100" id="form_container">
                                <div class="login100-pic js-tilt" data-tilt>
                                        <img src="images/uts.png" alt="IMG">
                                </div>
                                <!-- Form -->
                                <?php echo $ans; ?>
                        </div>
                </div>
        </div>
        <!--===============================================================================================-->
        <script src="imp/jquery/jquery-3.2.1.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!--===============================================================================================-->
        <script src="imp/bootstrap/js/popper.js"></script>
        <script src="imp/bootstrap/js/bootstrap.min.js"></script>
        <!--===============================================================================================-->
        <script src="imp/tilt/tilt.jquery.min.js"></script>
        <script>
                $('.js-tilt').tilt({
                        scale: 1.1
                })
        </script>
        <!--===============================================================================================-->
        <script src="js/main.js"></script> </body> </html>
