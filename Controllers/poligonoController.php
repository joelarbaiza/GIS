<?php
goto mt6Ai;
lKHiH:
E2zNp:
goto FCZ5_;
uUZYf:
goto E2zNp;
goto lKHiH;
VDICj:
class poligonoController
{
    public function ManejoAcciones()
    {
        $action = $_POST["\141\x63\x74\151\x6f\x6e"] ?? '';
        switch ($action) {
            case "\x61\x64\144":
                $this->agregarPoligono();
                break;
            case "\x75\160\144\x61\164\145":
                $this->actualizarPoligono();
                break;
            case "\144\145\154\x65\164\x65":
                $this->eliminarPoligono();
                break;
            default:
                break;
        }
    }
    function obtenerPoligonos()
    {
        $pdo = obtenerConexion();
        $stmt = $pdo->query("\123\x45\114\105\x43\124\40\x70\x2e\x69\x64\137\x70\x6f\154\x69\147\157\156\157\x2c\40\145\56\156\x6f\155\x62\x72\145\137\x63\x6f\155\x65\x72\x63\x69\x61\x6c\x2c\40\x70\x2e\160\61\54\x70\56\x70\x32\x20\x2c\160\56\160\63\x2c\160\x2e\x70\64\54\40\160\56\165\142\x69\143\141\x63\x69\x6f\x6e\137\61\40\x2c\40\x70\56\x75\142\151\x63\141\x63\x69\157\x6e\137\x32\x2c\40\160\56\x75\x62\x69\x63\x61\143\x69\x6f\156\x5f\63\40\40\xa\40\x20\40\x20\x20\40\x20\40\146\162\x6f\x6d\40\160\157\x6c\151\x67\x6f\156\157\x20\x70\40\x69\x6e\156\x65\162\x20\x6a\x6f\x69\x6e\x20\145\155\160\162\x65\x73\141\x20\145\40\157\156\40\160\56\x69\144\x5f\x65\x6d\x70\x72\x65\x73\141\x20\x3d\x65\56\x69\x64\137\x65\x6d\160\162\145\163\x61\40\157\162\144\x65\162\x20\x62\x79\40\x70\x2e\x69\x64\x5f\160\x6f\x6c\x69\x67\157\156\157");
        return $stmt->fetchAll();
    }
    function listarEmpresas()
    {
        $pdo = obtenerConexion();
        $stmt = $pdo->prepare("\123\x45\x4c\x45\x43\124\40\x69\x64\137\145\x6d\160\x72\x65\x73\x61\54\x20\156\x6f\x6d\x62\x72\145\x5f\143\x6f\155\145\x72\143\x69\x61\154\40\x46\122\x4f\x4d\40\105\115\120\x52\105\x53\101");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function separarCoordenadas($punto)
    {
        $coordenada = explode("\x2c", $punto);
        print_r($coordenada[0], $coordenada[1]);
        return array((float) $coordenada[0], (float) $coordenada[1]);
    }
    private function agregarPoligono()
    {
        $pdo = obtenerConexion();
        $id_empresa = (int) $_POST["\x69\x64\x5f\145\x6d\160\x72\145\163\141"];
        $p1 = $_POST["\160\61"];
        $p2 = $_POST["\160\62"];
        $p3 = $_POST["\x70\63"];
        $p4 = $_POST["\x70\x34"];
        $puntos = array($this->separarCoordenadas($p1), $this->separarCoordenadas($p2), $this->separarCoordenadas($p3), $this->separarCoordenadas($p4));
        $x = 0;
        $y = 0;
        $numpuntos = count($puntos);
        foreach ($puntos as $punto) {
            $x += $punto[0];
            $y += $punto[1];
        }
        $centrox = $x / $numpuntos;
        $centroy = $y / $numpuntos;
        $ubicacion = $centrox . "\x2c" . $centroy;
        $stmt = $pdo->prepare("\x49\x4e\123\x45\x52\124\x20\111\x4e\x54\117\40\x50\117\x4c\111\x47\117\116\117\40\50\151\144\x5f\145\x6d\x70\162\x65\163\x61\x2c\40\160\61\x2c\40\x70\62\54\x20\160\x33\54\x20\x70\x34\54\x20\x75\x62\x69\143\141\143\151\157\156\x5f\x31\54\40\165\142\x69\143\x61\x63\151\x6f\x6e\x5f\62\x2c\x20\165\x62\x69\143\141\x63\x69\x6f\156\x5f\x33\51\40\126\x41\114\125\105\x53\40\x28\77\54\40\77\54\x20\x3f\x2c\40\77\x2c\x20\x3f\x2c\x20\x3f\x2c\40\77\x2c\x20\77\x29");
        try {
            $stmt->execute(array($id_empresa, $p1, $p2, $p3, $p4, $ubicacion, $centrox, $centroy));
            $_SESSION["\x6d\x65\x73\163\x61\147\x65"] = "\x50\157\x6c\303\xad\x67\x6f\156\x6f\x20\141\x67\162\x65\x67\141\x64\x6f\x20\x63\157\162\x72\x65\x63\164\x61\155\145\156\x74\145\x2e";
            $_SESSION["\155\145\x73\x73\x61\x67\x65\x5f\x74\x79\x70\145"] = "\163\x75\143\x63\145\163\x73";
            header("\114\157\143\141\164\x69\157\x6e\x3a\x20\56\56\x2f\x70\x6f\154\x69\x67\x6f\156\x6f\163");
            die;
        } catch (PDOException $e) {
            $_SESSION["\155\x65\163\163\141\147\145"] = "\x45\162\162\x6f\x72\x20\x61\154\40\141\x67\162\145\147\141\162\x20\x70\x6f\x6c\303\xad\x67\x6f\156\157\x3a\40" . $e->getMessage();
            $_SESSION["\155\x65\163\163\141\147\145\x5f\x74\171\160\145"] = "\145\x72\x72\x6f\162";
            header("\x4c\157\143\x61\164\151\x6f\156\x3a\x20\x2e\56\57\160\157\x6c\x69\x67\157\x6e\157\x73");
            die;
        }
    }
    private function actualizarPoligono()
    {
        $pdo = obtenerConexion();
        $id = (int) $_POST["\151\x64\137\x70\x6f\x6c\x69\x67\x6f\156\157"] ?? '';
        $id_empresa = (int) $_POST["\151\144\137\145\155\160\x72\x65\x73\x61"] ?? '';
        $p1 = $_POST["\x70\x31"] ?? '';
        $p2 = $_POST["\x70\x32"] ?? '';
        $p3 = $_POST["\160\63"] ?? '';
        $p4 = $_POST["\x70\64"] ?? '';
        $puntos = array($this->separarCoordenadas($p1), $this->separarCoordenadas($p2), $this->separarCoordenadas($p3), $this->separarCoordenadas($p4));
        $x = 0;
        $y = 0;
        $numpuntos = count($puntos);
        foreach ($puntos as $punto) {
            $x += $punto[0];
            $y += $punto[1];
        }
        $centrox = $x / $numpuntos;
        $centroy = $y / $numpuntos;
        $ubicacion = $centrox . "\54" . $centroy;
        $stmt = $pdo->prepare("\125\x50\104\x41\124\x45\40\160\157\x6c\151\x67\x6f\156\157\x20\x53\105\x54\40\x69\144\x5f\x65\x6d\x70\x72\145\163\141\75{$id_empresa}\x2c\40\x70\x31\75\47{$p1}\x27\x2c\x20\x70\x32\75\x27{$p2}\47\x2c\x20\160\63\x3d\47{$p3}\47\x2c\x20\x70\64\x3d\x27{$p4}\47\x2c\x20\x75\x62\x69\x63\141\143\151\x6f\x6e\x5f\61\x3d\47{$ubicacion}\47\x2c\40\x75\x62\151\x63\141\x63\x69\157\x6e\137\62\75\47{$centrox}\x27\54\x20\165\x62\x69\x63\x61\143\151\157\x6e\x5f\63\75\x27{$centroy}\47\x20\127\110\105\x52\x45\x20\151\x64\x5f\160\157\x6c\x69\x67\157\x6e\x6f\x3d{$id}");
        try {
            $stmt->execute();
            $_SESSION["\x6d\x65\163\163\x61\147\x65"] = "\120\x6f\154\xc3\xad\147\157\x6e\157\40" . $id . "\x20\141\143\164\x75\141\x6c\x69\172\x61\x64\157\x20\x63\157\x72\x72\145\143\164\x61\x6d\145\x6e\x74\x65\56";
            $_SESSION["\155\145\163\x73\141\x67\145\x5f\x74\x79\160\145"] = "\163\165\x63\x63\x65\x73\x73";
            header("\114\157\x63\x61\164\151\x6f\156\72\x20\56\56\x2f\160\157\x6c\151\147\157\156\157\x73");
            die;
        } catch (PDOException $e) {
            $_SESSION["\155\x65\x73\x73\x61\147\x65"] = "\x45\x72\x72\x6f\x72\40\x61\x6c\x20\x61\143\164\x75\x61\154\x69\x7a\x61\162\40\145\x6c\x20\160\x6f\154\303\255\147\x6f\156\x6f\x3a\40" . $e->getMessage();
            $_SESSION["\x6d\145\x73\163\x61\147\145\x5f\x74\x79\160\145"] = "\145\x72\x72\x6f\x72";
            header("\114\157\143\141\x74\x69\157\156\x3a\40\56\x2e\57\x70\157\154\x69\x67\x6f\x6e\157\163");
            die;
        }
    }
    private function eliminarPoligono()
    {
        $pdo = obtenerConexion();
        $id = $_POST["\x69\144\137\x70\x6f\x6c\x69\x67\157\x6e\157"] ?? '';
        if (!empty($id)) {
            try {
                $stmt = $pdo->prepare("\104\x45\x4c\x45\124\x45\40\106\122\117\115\40\x70\157\x6c\151\147\157\156\157\x20\x57\110\105\x52\105\40\151\144\x5f\160\x6f\154\151\147\x6f\156\x6f\x3d{$id}");
                $stmt->execute();
                $_SESSION["\155\x65\163\x73\141\x67\145"] = "\120\157\x6c\xc3\255\147\x6f\x6e\x6f\x20{$id}\40\x65\154\x69\155\x69\156\x61\144\157\x20\143\157\x72\162\x65\143\x74\141\x6d\145\156\164\145\x2e";
                $_SESSION["\155\145\x73\163\141\x67\x65\x5f\164\x79\x70\x65"] = "\163\165\x63\143\145\163\163";
                header("\x4c\x6f\143\x61\x74\151\x6f\x6e\72\x20\x2e\x2e\x2f\160\157\x6c\x69\147\157\156\157\163");
                die;
            } catch (PDOException $e) {
                $_SESSION["\155\145\163\x73\x61\x67\x65"] = "\x45\162\162\157\162\x20\x61\x6c\x20\x65\x6c\x69\x6d\x69\156\x61\x72\x20\x65\154\40\160\x6f\x6c\xc3\xad\147\x6f\156\157\x3a\x20" . $e->getMessage();
                $_SESSION["\x6d\x65\163\x73\x61\x67\145\137\x74\171\x70\145"] = "\145\x72\x72\157\x72";
                header("\x4c\x6f\x63\x61\x74\x69\157\156\72\x20\x2e\x2e\x2f\160\157\154\151\x67\157\156\x6f\x73");
                die;
            }
        } else {
            $_SESSION["\155\x65\x73\x73\x61\147\145"] = "\x4e\157\x20\145\x78\151\163\x74\145\x20\x65\x6c\40\x70\157\x6c\151\x67\157\156\x6f\x2e";
            $_SESSION["\x6d\x65\x73\x73\141\147\x65\137\164\x79\160\x65"] = "\145\162\x72\x6f\x72";
            header("\x4c\157\143\x61\x74\151\157\x6e\72\x20\x2e\x2e\x2f\x70\157\x6c\151\x67\157\156\157\163");
            die;
        }
    }
}
goto uUZYf;
gA6l1:
pYO6q:
goto VDICj;
mt6Ai:
goto bEcn8;
goto gA6l1;
BumFH:
goto pYO6q;
goto EY5AQ;
pSo51:
goto y3gSM;
goto hRTvS;
FCZ5_:
$template = new poligonoController();
goto pSo51;
EY5AQ:
y3gSM:
goto z3ZJZ;
oq2Jg:
nc237:
goto cdjUH;
hRTvS:
bEcn8:
goto JpD0Z;
JpD0Z:
require_once __DIR__ . "\x2f\x2e\x2e\x2f\x43\x6f\x6e\x65\170\151\157\x6e\x2f\143\157\x6e\x65\170\151\x6f\156\x42\x44\56\x70\x68\160";
goto gTOQm;
gTOQm:
goto nc237;
goto oq2Jg;
cdjUH:
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
goto BumFH;
z3ZJZ:
$template->ManejoAcciones();
