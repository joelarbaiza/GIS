<?php
goto bgMnL;
oZgiN:
goto WzUPp;
goto XwAoP;
CgFIH:
goto jfQjo;
goto Gj0v4;
Ia9Ko:
$template = new inicioController();
goto CgFIH;
Um7l0:
WzUPp:
goto Q_DOI;
bgMnL:
goto g_8z9;
goto Um7l0;
qY2ci:
goto en_Hy;
goto BOzb2;
CV70C:
goto uDXU6;
goto KaDuH;
Q_DOI:
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
goto qY2ci;
Gj0v4:
jfQjo:
goto ln0Fk;
xVfEU:
require_once __DIR__ . "\x2f\56\56\57\x43\157\156\145\x78\x69\157\x6e\x2f\x63\x6f\156\145\x78\x69\157\156\x42\104\x2e\x70\150\x70";
goto oZgiN;
XwAoP:
uDXU6:
goto Ia9Ko;
KaDuH:
g_8z9:
goto xVfEU;
qqPJJ:
class inicioController
{
    public function ManejoAcciones()
    {
        $action = $_POST["\x66\151\154\164\162\141\162"] ?? '';
        switch ($action) {
            case "\141\x64\x64":
                $this->filtrarEmpresaGironegocioTodos();
                break;
            default:
                break;
        }
    }
    function obtenerGiros()
    {
        $pdo = obtenerConexion();
        $stmt = $pdo->query("\x53\105\x4c\x45\103\124\40\x2a\40\x20\106\122\117\115\x20\x67\151\162\x6f\137\156\145\147\157\x63\x69\x6f");
        return $stmt->fetchAll();
    }
    public function filtrarEmpresaGironegocioTodos()
    {
        $pdo = obtenerConexion();
        $idGiro = isset($_POST["\x67\151\162\157"]) ? $_POST["\147\x69\162\157"] : null;
        if (!empty($idGiro) && $idGiro != "\x6e\165\x6c\x6c") {
            $sql1 = "\x53\105\114\x45\103\x54\40\x65\56\156\165\x6d\145\x72\157\x5f\x72\x75\x63\40\x61\x73\x20\162\x75\143\54\40\x65\x2e\156\x6f\x6d\142\162\145\x5f\x63\x6f\155\145\x72\x63\151\x61\154\x20\141\163\40\x6e\157\155\x62\x72\x65\54\x20\147\156\56\x6e\157\155\142\x72\x65\137\147\151\162\x6f\x20\x61\x73\x20\156\x65\x67\157\x63\x69\x6f\x2c\40\147\x6e\56\143\157\x6c\157\x72\40\x61\x73\40\143\157\154\x6f\162\54\40\160\x31\54\40\x70\62\x2c\160\63\54\160\x34\x2c\165\142\x69\143\x61\x63\x69\x6f\156\137\x31\x2c\165\142\151\143\141\x63\x69\x6f\156\137\63\x20\xa\x20\40\x20\40\x20\x20\x20\40\x20\40\x20\x20\x20\x20\x20\40\40\x20\x20\40\106\122\x4f\115\x20\x50\157\154\151\x67\157\156\157\40\x70\x20\111\x4e\x4e\x45\122\40\112\x4f\111\x4e\x20\x45\155\x70\162\145\x73\x61\40\145\x20\157\156\40\x70\56\x69\x64\x5f\145\x6d\x70\162\x65\x73\x61\75\x65\x2e\x69\x64\x5f\145\x6d\x70\162\x65\x73\141\40\x69\x6e\x6e\x65\x72\x20\152\157\x69\x6e\40\x67\151\x72\x6f\137\x6e\x65\x67\x6f\143\151\157\x20\147\156\x20\157\x6e\40\x65\56\x69\144\x5f\147\x69\x72\157\40\75\40\147\156\56\x69\144\137\147\x69\162\157\40\x57\110\x45\122\x45\40\147\x6e\56\x69\x64\137\147\151\x72\x6f\40\75\40\47{$idGiro}\47";
            $stmt = $pdo->prepare($sql1);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            header("\114\x6f\143\141\x74\151\157\156\72\40\x2e\56\x2f\x49\x6e\151\143\x69\157");
            die;
        } else {
            $sql1 = "\x53\105\x4c\x45\x43\x54\40\x65\x2e\x6e\x75\155\145\x72\x6f\137\162\165\x63\x20\141\163\x20\162\165\x63\54\x20\145\56\x6e\157\x6d\x62\x72\x65\x5f\143\x6f\x6d\x65\162\143\151\x61\x6c\x20\x61\163\x20\x6e\x6f\155\142\162\145\x2c\x20\x67\156\56\156\157\155\142\x72\x65\137\x67\x69\x72\157\40\x61\x73\40\156\x65\x67\x6f\143\x69\157\x2c\x20\x67\x6e\56\143\x6f\x6c\x6f\x72\x20\x61\163\40\x63\x6f\154\157\x72\x2c\x20\160\x31\x2c\40\160\x32\x2c\x70\63\54\x70\x34\54\x75\x62\x69\143\141\143\151\157\x6e\x5f\61\x2c\x75\142\151\x63\x61\x63\x69\157\156\137\63\x20\xa\40\x20\40\x20\40\x20\x20\40\40\x20\40\x20\40\x20\40\x20\x20\x20\x20\40\106\122\x4f\x4d\x20\120\157\154\151\147\157\x6e\157\x20\160\x20\111\116\116\x45\x52\x20\x4a\x4f\x49\116\x20\x45\x6d\x70\x72\145\163\x61\40\145\40\x6f\156\x20\x70\56\151\x64\137\145\x6d\x70\162\x65\163\141\75\145\56\x69\144\137\145\x6d\x70\x72\x65\163\x61\40\151\x6e\x6e\145\162\x20\152\157\x69\156\x20\147\x69\162\157\137\x6e\x65\x67\x6f\x63\151\x6f\x20\x67\x6e\x20\157\x6e\x20\145\56\x69\x64\x5f\147\151\162\157\40\75\40\x67\156\56\x69\144\x5f\x67\151\x72\x6f";
            $stmt = $pdo->prepare($sql1);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
}
goto CV70C;
BOzb2:
en_Hy:
goto qqPJJ;
ln0Fk:
$template->ManejoAcciones();
