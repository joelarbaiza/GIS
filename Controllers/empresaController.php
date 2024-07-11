<?php
goto owuIp;
CKgIT:
class empresaController
{
    public function ManejoAcciones()
    {
        $action = $_POST["\x61\143\164\x69\157\x6e"] ?? '';
        switch ($action) {
            case "\x61\x64\144":
                $this->agregarEmpresa();
                break;
            case "\x75\160\144\x61\x74\145":
                $this->actualizarEmpresa();
                break;
            case "\144\145\x6c\x65\164\x65":
                $this->eliminarEmpresa();
                break;
            default:
                break;
        }
    }
    function listar_giro_de_negocio()
    {
        $pdo = obtenerConexion();
        $stmt = $pdo->prepare("\x53\105\x4c\x45\x43\124\x20\x2a\40\x46\x52\x4f\x4d\40\147\151\162\x6f\137\156\145\x67\157\143\x69\157");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    function obtenerEmpresas()
    {
        $pdo = obtenerConexion();
        $stmt = $pdo->query("\x53\x45\x4c\105\103\124\40\x65\56\151\144\137\145\155\x70\162\x65\x73\x61\40\x2c\x20\x65\56\156\x75\155\x65\162\x6f\x5f\162\x75\143\x20\x2c\x20\145\x2e\x6e\157\155\x62\162\x65\137\x63\157\x6d\145\162\x63\151\x61\x6c\40\x2c\40\145\x2e\162\141\x7a\157\156\x5f\x73\157\143\151\x61\x6c\x20\54\147\x6e\x2e\x6e\157\155\142\x72\x65\137\147\151\162\157\x20\x66\x72\157\x6d\40\145\155\x70\x72\145\163\x61\40\145\40\x69\x6e\x6e\x65\x72\x20\152\x6f\151\x6e\x20\147\151\x72\157\x5f\156\x65\x67\x6f\143\x69\x6f\x20\147\156\40\157\x6e\40\x65\56\151\x64\137\147\x69\162\x6f\40\x3d\x67\x6e\56\151\144\137\147\x69\162\157\40\x6f\x72\144\145\x72\40\142\x79\x20\x65\x2e\151\144\137\145\155\x70\x72\x65\163\x61\x20");
        return $stmt->fetchAll();
    }
    private function agregarEmpresa()
    {
        $pdo = obtenerConexion();
        $numero_ruc = $_POST["\x6e\x75\155\x65\162\x6f\x5f\x72\165\143"] ?? '';
        $nombre_comercial = $_POST["\156\x6f\x6d\x62\162\x65\137\x63\x6f\x6d\145\162\143\x69\x61\154"] ?? '';
        $razon_social = $_POST["\x72\141\172\157\x6e\137\163\x6f\143\151\x61\x6c"] ?? '';
        $giro_de_negocio = (int) ($_POST["\x67\x69\162\x6f\137\144\145\x5f\x6e\145\147\157\143\x69\x6f"] ?? '');
        if (!empty($numero_ruc) && !empty($nombre_comercial) && !empty($razon_social) && !empty($giro_de_negocio)) {
            try {
                $stmt = $pdo->prepare("\x49\116\x53\x45\122\124\x20\111\116\124\x4f\40\145\x6d\160\x72\x65\x73\141\40\50\156\165\x6d\x65\x72\x6f\137\162\165\x63\54\40\156\x6f\x6d\142\162\x65\x5f\x63\x6f\155\x65\x72\x63\x69\x61\x6c\54\40\162\141\x7a\157\x6e\x5f\163\157\x63\151\x61\154\54\40\151\144\137\147\151\x72\157\x29\x20\x56\101\114\x55\x45\123\x20\x28\77\54\x3f\x2c\x3f\x2c\77\x29");
                $stmt->execute(array($numero_ruc, $nombre_comercial, $razon_social, $giro_de_negocio));
                $_SESSION["\x6d\145\163\x73\x61\147\x65"] = "\x45\x6d\x70\162\x65\163\x61\x20\x61\x67\x72\x65\x67\141\x64\141\x20\143\157\162\x72\145\143\x74\x61\x6d\145\156\164\x65\x2e";
                $_SESSION["\155\x65\163\163\141\147\145\x5f\164\171\160\145"] = "\x73\165\143\x63\145\x73\163";
                header("\114\x6f\x63\141\164\x69\157\x6e\x3a\x20\x2e\56\x2f\x65\x6d\160\162\x65\163\141\x73");
                die;
            } catch (PDOException $e) {
                $_SESSION["\x6d\x65\163\163\x61\147\145"] = "\x45\162\162\x6f\x72\x20\x61\x6c\40\x61\147\162\x65\x67\x61\x72\x20\154\x61\x20\x65\155\x70\162\145\x73\x61\72\x20" . $e->getMessage();
                $_SESSION["\x6d\145\163\x73\x61\x67\x65\137\164\x79\160\145"] = "\145\162\162\x6f\162";
                header("\114\157\143\x61\164\x69\x6f\x6e\x3a\x20\x2e\56\57\x65\x6d\x70\162\x65\163\141\163");
                die;
            }
        } else {
            $_SESSION["\155\x65\163\x73\141\x67\145"] = "\x50\x6f\162\40\x66\x61\x76\x6f\x72\40\143\x6f\x6d\x70\x6c\145\x74\145\40\x74\x6f\144\x6f\163\40\154\157\x73\x20\x63\141\155\160\x6f\163\56";
            $_SESSION["\155\x65\163\x73\141\147\145\137\x74\x79\x70\x65"] = "\x65\162\x72\157\162";
            header("\114\157\143\x61\164\151\x6f\x6e\x3a\40\x2e\56\x2f\x65\x6d\160\162\145\x73\x61\163");
            die;
        }
    }
    private function actualizarEmpresa()
    {
        $pdo = obtenerConexion();
        $id = $_POST["\x69\x64\x5f\x65\155\160\x72\x65\x73\141"] ?? '';
        $numero_ruc = $_POST["\156\165\x6d\145\x72\x6f\x5f\162\165\x63"] ?? '';
        $nombre_comercial = $_POST["\x6e\x6f\155\x62\x72\x65\137\143\x6f\155\x65\x72\x63\x69\141\x6c"] ?? '';
        $razon_social = $_POST["\x72\x61\x7a\x6f\x6e\x5f\x73\157\143\x69\141\x6c"] ?? '';
        $giro_de_negocio = (int) ($_POST["\147\151\x72\x6f\137\144\x65\137\156\145\x67\x6f\143\151\x6f"] ?? '');
        if (!empty($numero_ruc) && !empty($nombre_comercial) && !empty($razon_social) && !empty($giro_de_negocio)) {
            try {
                $stmt = $pdo->prepare("\x55\120\104\101\x54\x45\40\x65\x6d\160\x72\145\x73\x61\40\123\105\x54\x20\x6e\x75\155\x65\x72\157\137\162\x75\x63\x20\75\40\77\54\x20\x6e\157\155\142\162\145\x5f\x63\157\x6d\145\162\x63\x69\x61\154\40\75\x20\x3f\x2c\40\x72\141\172\x6f\156\137\x73\157\143\151\x61\154\40\75\x20\x3f\x2c\40\151\x64\137\x67\151\x72\157\40\75\x20\x3f\x20\127\x48\x45\x52\x45\40\151\144\x5f\145\155\x70\x72\145\163\141\x20\75\40\77");
                $stmt->execute(array($numero_ruc, $nombre_comercial, $razon_social, $giro_de_negocio, $id));
                $_SESSION["\155\145\x73\163\x61\147\x65"] = "\105\x6d\160\162\145\x73\141\x20\x61\x63\x74\165\141\154\x69\x7a\141\x64\141\x20\x63\157\162\x72\145\x63\164\x61\155\x65\x6e\164\145\x2e";
                $_SESSION["\155\145\x73\163\x61\147\145\x5f\x74\x79\x70\145"] = "\x73\x75\143\143\x65\x73\x73";
                header("\x4c\x6f\x63\x61\164\x69\157\156\x3a\40\56\56\x2f\x65\x6d\x70\x72\145\x73\141\x73");
                die;
            } catch (PDOException $e) {
                $_SESSION["\x6d\x65\163\163\141\147\145"] = "\105\x72\162\x6f\162\x20\141\154\x20\141\143\x74\165\x61\154\151\172\141\162\40\x6c\141\40\x65\155\160\162\x65\163\x61\72\40" . $e->getMessage();
                $_SESSION["\x6d\x65\163\163\141\147\145\x5f\x74\x79\160\145"] = "\145\x72\x72\157\x72";
                header("\x4c\x6f\143\141\164\x69\x6f\x6e\x3a\40\x2e\x2e\57\x65\x6d\160\162\145\x73\x61\163");
                die;
            }
        } else {
            $_SESSION["\x6d\x65\163\163\x61\147\145"] = "\x50\x6f\162\x20\x66\x61\x76\x6f\x72\40\143\157\x6d\x70\154\x65\x74\x65\x20\x74\x6f\x64\157\x73\40\x6c\x6f\x73\40\143\141\x6d\160\x6f\x73\56";
            $_SESSION["\x6d\145\163\163\x61\147\145\x5f\x74\x79\x70\x65"] = "\x65\x72\162\x6f\x72";
            header("\x4c\x6f\143\141\164\x69\x6f\x6e\72\x20\x2e\x2e\x2f\145\x6d\x70\x72\x65\163\x61\163");
            die;
        }
    }
    private function eliminarEmpresa()
    {
        $pdo = obtenerConexion();
        $id = $_POST["\151\x64\x5f\145\x6d\160\162\x65\163\x61"] ?? '';
        $ruc = $_POST["\x6e\165\x6d\x65\162\157\x5f\162\165\143"] ?? '';
        if (!empty($id)) {
            try {
                $pdo->beginTransaction();
                $tablas_relacionadas = array(array("\x6e\157\x6d\x62\x72\145" => "\160\157\x6c\151\x67\x6f\x6e\x6f", "\143\x61\155\x70\x6f" => "\151\x64\137\x65\155\x70\162\145\163\x61"));
                foreach ($tablas_relacionadas as $tabla) {
                    $stmt = $pdo->prepare("\123\105\114\x45\x43\x54\40\x43\117\x55\116\x54\50\x2a\x29\40\141\x73\40\x63\157\165\156\x74\40\106\x52\x4f\115\x20{$tabla["\x6e\157\x6d\142\162\x65"]}\40\x57\x48\105\x52\x45\40{$tabla["\143\x61\x6d\160\157"]}\40\75\40\77");
                    $stmt->execute(array($id));
                    $result = $stmt->fetch();
                    if ($result["\x63\x6f\x75\156\x74"] > 0) {
                        $_SESSION["\155\x65\163\x73\141\x67\x65"] = "\116\x6f\40\163\x65\x20\160\165\145\144\x65\40\x65\x6c\x69\155\151\x6e\x61\x72\40\x6c\x61\x20\145\x6d\x70\x72\145\163\x61\x20\160\157\x72\161\x75\145\40\164\151\x65\x6e\x65\40\162\x65\x67\151\163\164\162\x6f\x73\x20\162\145\154\x61\x63\x69\157\156\141\144\x6f\163\40\x65\x6e\40\x6c\141\x20\x74\x61\x62\154\141\40{$tabla["\156\x6f\155\x62\x72\145"]}\x2e";
                        $_SESSION["\155\x65\x73\x73\x61\147\x65\137\x74\x79\160\x65"] = "\x77\141\162\156\x69\x6e\x67";
                        $pdo->rollBack();
                        header("\114\x6f\143\141\x74\151\157\x6e\x3a\x20\x2e\56\x2f\x65\155\160\x72\145\163\141\163");
                        die;
                    }
                }
                $stmt = $pdo->prepare("\x44\x45\x4c\x45\124\105\40\106\x52\x4f\x4d\x20\145\x6d\160\x72\145\163\x61\40\127\x48\105\x52\105\40\151\144\137\x65\155\160\x72\145\163\141\40\75\40\x3f");
                $stmt->execute(array($id));
                $_SESSION["\x6d\145\163\x73\x61\147\145"] = "\x45\x6d\160\162\x65\163\141\40\145\x6c\x69\155\151\x6e\x61\144\141\40\x63\157\162\x72\145\x63\164\141\155\145\156\164\145\x2e\40\122\165\x63\x3a\40" . $ruc;
                $_SESSION["\x6d\145\x73\x73\x61\x67\x65\137\x74\x79\160\145"] = "\163\165\143\143\145\x73\x73";
                $pdo->commit();
                header("\x4c\157\143\141\164\x69\157\x6e\x3a\x20\x2e\56\57\145\x6d\x70\162\x65\x73\x61\x73");
                die;
            } catch (PDOException $e) {
                $pdo->rollBack();
                $_SESSION["\x6d\x65\163\163\141\x67\x65"] = "\x45\162\x72\x6f\x72\x20\141\154\40\x65\x6c\151\x6d\x69\x6e\141\x72\x20\154\141\40\145\x6d\x70\x72\x65\x73\x61\72\40" . $e->getMessage();
                $_SESSION["\155\145\163\163\141\x67\x65\137\x74\171\x70\145"] = "\x65\162\162\x6f\x72";
                header("\x4c\157\x63\141\164\x69\157\156\x3a\x20\56\x2e\57\x65\155\x70\162\145\163\141\163");
                die;
            }
        } else {
            $_SESSION["\x6d\x65\163\x73\x61\147\145"] = "\116\x6f\x20\x65\x78\151\163\164\x65\40\x6c\141\x20\x65\x6d\x70\162\x65\163\141\x2e";
            $_SESSION["\155\x65\x73\163\141\x67\x65\137\164\x79\x70\x65"] = "\145\162\x72\157\x72";
            header("\114\x6f\x63\x61\164\151\x6f\156\72\x20\56\x2e\x2f\x65\155\160\162\x65\x73\141\x73");
            die;
        }
    }
}
goto fT2BY;
owuIp:
require_once __DIR__ . "\x2f\56\56\57\x43\x6f\156\x65\x78\151\x6f\x6e\x2f\143\x6f\156\x65\x78\x69\157\x6e\102\x44\x2e\160\150\160";
goto eDMZM;
fT2BY:
$template = new empresaController();
goto owpop;
eDMZM:
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
goto CKgIT;
owpop:
$template->ManejoAcciones();
