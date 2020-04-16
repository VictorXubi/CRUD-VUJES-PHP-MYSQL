<?php

require_once 'DepartamentoPDO.php';

class Departamento {

    private $CodDepartamento;
    private $DescDepartamento;
    private $VolumenDeNegocio;

    public function __construct($CodDepartamento, $DescDepartamento, $VolumenDeNegocio) {
        $this->CodDepartamento = $CodDepartamento;
        $this->DescDepartamento = $DescDepartamento;
        $this->VolumenDeNegocio = $VolumenDeNegocio;
    }

}

?>
