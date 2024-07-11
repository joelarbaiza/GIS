<?php
goto J9EGq;
srmK6:
AydKZ:
goto z8Y39;
J9EGq:
goto ZQbZY;
goto Y1VPi;
qdumd:
goF3W:
goto RGhZI;
T9VpY:
goto AydKZ;
goto srmK6;
CfZTF:
a4YEj:
goto HZ7_V;
Y1VPi:
ZQbZY:
goto Jjbh9;
W3xY_:
Lahwz:
goto cqScG;
RGhZI:
class perfilController
{
    public function ManejoAcciones()
    {
        $action = $_POST["\x61\x63\164\x69\157\x6e"] ?? '';
        switch ($action) {
            case "\x75\160\x64\x61\x74\145":
                $this->actualizarPerfil();
                break;
            default:
                break;
        }
    }
    function obtenerUsuarios($id)
    {
        $pdo = obtenerConexion();
        $stmt = $pdo->query("\x53\x45\114\x45\x43\x54\x20\x2a\40\106\122\117\x4d\x20\165\163\x75\141\162\151\157\163\x20\x77\x68\x65\162\x65\x20\151\x64\137\165\163\165\141\162\151\157\75\x20\x27{$id}\47");
        return $stmt->fetch();
    }
    private function actualizarPerfil()
    {
        $pdo = obtenerConexion();
        $id = $_POST["\151\x64\x5f\x75\x73\x75\x61\x72\x69\x6f"] ?? '';
        $nombre = $_POST["\x6e\157\x6d\x62\x72\145"] ?? '';
        $apellido = $_POST["\x61\160\145\154\154\x69\144\x6f"] ?? '';
        $telefono = $_POST["\x74\145\154\145\x66\157\x6e\157"] ?? '';
        $correo = $_POST["\143\157\x72\162\145\157"] ?? '';
        $nombre_usuario = $_POST["\x6e\x6f\x6d\x62\x72\x65\137\x75\163\x75\141\x72\151\157"] ?? '';
        $password = $_POST["\160\x61\163\x73\x77\157\162\144"] ?? '';
        if (!empty($nombre) && !empty($apellido) && !empty($telefono) && !empty($correo) && !empty($nombre_usuario) && !empty($password)) {
            try {
                $stmt = $pdo->prepare("\x55\120\x44\101\x54\x45\x20\165\x73\165\x61\162\x69\x6f\x73\x20\x53\105\124\40\x6e\x6f\x6d\142\162\145\x20\75\x20\x3f\54\x20\141\160\x65\154\154\x69\x64\x6f\x20\x3d\x20\x3f\x2c\x20\x74\x65\x6c\x65\x66\157\156\x6f\x20\x3d\x20\x3f\54\x20\x63\x6f\162\162\x65\x6f\40\x3d\x20\x3f\x2c\40\156\157\x6d\x62\162\145\137\165\x73\x75\141\x72\x69\157\40\75\40\77\54\x20\42\160\141\x73\x73\167\157\x72\144\42\40\75\x20\x3f\40\x57\x48\105\x52\105\40\x69\x64\x5f\x75\x73\165\141\162\x69\x6f\40\x3d\40\x3f");
                $stmt->execute(array($nombre, $apellido, $telefono, $correo, $nombre_usuario, $password, $id));
                if ($_SESSION["\156\157\x6d\x62\x72\145\137\165\x73\x75\141\162\x69\157"] != $nombre_usuario || $_SESSION["\x70\x61\163\x73\x77\x6f\162\x64"] != $password) {
                    echo "\x3c\163\x63\162\x69\160\x74\76\xa\x20\x20\x20\40\x20\40\x20\40\40\x20\x20\40\x20\40\x20\40\x20\x20\x20\x20\x61\154\x65\162\x74\x28\x27\x45\154\40\156\157\x6d\x62\x72\145\x20\x64\x65\40\x75\163\x75\x61\162\x69\157\40\x6f\40\143\157\156\x74\x72\141\163\145\303\xb1\141\40\150\141\40\x63\141\x6d\x62\151\x61\x64\x6f\x2e\x20\104\x65\x62\x65\163\x20\151\156\x69\x63\151\x61\162\40\x73\x65\163\151\xc3\xb3\156\40\x6e\x75\145\x76\141\x6d\x65\x6e\x74\145\x2e\x27\x29\73\12\40\x20\x20\40\x20\x20\x20\x20\40\40\40\40\40\x20\40\x20\x20\x20\40\40\167\x69\x6e\x64\157\167\56\154\x6f\x63\141\164\x69\157\156\56\150\162\x65\146\40\75\x20\47\x2e\56\57\114\157\147\x69\156\x27\73\12\40\40\40\40\x20\40\x20\x20\40\x20\40\40\40\40\40\x20\74\57\163\x63\162\151\160\x74\76";
                    session_destroy();
                    die;
                }
                if ($_SESSION["\x69\x64\x5f\165\163\x75\x61\x72\x69\157"] == $id) {
                    $_SESSION["\x69\x64\137\165\x73\165\x61\162\x69\x6f"] = $id;
                    $_SESSION["\156\157\x6d\x62\162\x65"] = $nombre;
                    $nombreCompleto = explode("\x20", $nombre);
                    $primerNombre = $nombreCompleto[0];
                    $apellidoCompleto = explode("\40", $apellido);
                    $primerApellido = $apellidoCompleto[0];
                    $_SESSION["\x6e\157\x6d\x62\x72\x65"] = $primerNombre;
                    $_SESSION["\141\x70\x65\x6c\x6c\151\x64\x6f"] = $primerApellido;
                }
                $_SESSION["\x6d\145\x73\163\141\x67\x65"] = "\104\x61\164\157\163\40\144\x65\x6c\x20\165\x73\165\x61\x72\x69\x6f\40\x61\143\x74\x75\141\154\151\172\x61\144\157\x73\40\143\x6f\x72\162\x65\x63\164\141\155\145\x6e\164\145\56";
                $_SESSION["\155\145\163\163\x61\x67\x65\137\164\x79\160\145"] = "\x73\x75\x63\143\x65\x73\x73";
                header("\x4c\x6f\143\x61\x74\151\x6f\156\72\40\x2e\x2e\x2f\x49\156\151\x63\x69\157");
                die;
            } catch (PDOException $e) {
                $_SESSION["\x6d\x65\x73\x73\x61\x67\145"] = "\105\x72\x72\x6f\162\40\141\x6c\40\141\x63\x74\x75\x61\x6c\151\x7a\x61\162\x20\160\x65\162\146\x69\x6c\72\x20" . $e->getMessage();
                $_SESSION["\x6d\145\x73\163\x61\147\x65\x5f\164\x79\160\145"] = "\x65\x72\162\x6f\x72";
                header("\x4c\x6f\143\141\164\x69\x6f\x6e\72\40\x2e\x2e\x2f\111\x6e\x69\143\x69\157");
                die;
            }
        } else {
            $_SESSION["\x6d\145\163\x73\141\147\145"] = "\120\x6f\162\40\146\141\166\x6f\x72\x20\x63\x6f\155\x70\154\x65\164\x65\x20\164\x6f\x64\x6f\x73\40\x6c\x6f\163\40\x63\141\x6d\x70\157\163\56";
            $_SESSION["\155\x65\163\x73\x61\147\145\x5f\x74\171\x70\x65"] = "\x65\x72\x72\x6f\x72";
            header("\114\157\x63\141\x74\x69\157\x6e\72\40\56\56\57\160\145\x72\x66\x69\154");
            die;
        }
    }
}
goto t_tjJ;
iMkQc:
goto Lahwz;
goto qdumd;
HZ7_V:
$template = new perfilController();
goto T9VpY;
lL0Nc:
goto goF3W;
goto CfZTF;
cqScG:
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
goto lL0Nc;
t_tjJ:
goto a4YEj;
goto W3xY_;
Jjbh9:
require_once __DIR__ . "\57\56\x2e\57\x43\157\x6e\x65\170\x69\x6f\x6e\x2f\143\157\x6e\145\x78\151\x6f\x6e\102\104\x2e\160\150\160";
goto iMkQc;
z8Y39:
$template->ManejoAcciones();
