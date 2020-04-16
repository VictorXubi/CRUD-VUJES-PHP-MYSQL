<?php

require_once 'DBPDO.php';
require_once 'Departamento.php';

class DepartamentoPDO {

    public static function buscarDepartamentoPorCodigo($CodDepartamento) {
        $departamento = null;
        $sql = 'select * from Departamento where CodDepartamento = ?';
        $consulta = DBPDO::ejecutarConsulta($sql, [$CodDepartamento]);
        if ($consulta->rowCount() == 1) {
            $datos = $consulta->fetchObject();
            $departamento = new Departamento($CodDepartamento, $datos->DescDepartamento, $datos->FechaBajaDepartamento, $datos->FechaCreacionDepartamento, $datos->VolumenNegocio);
        }
        return $departamento;
    }

    public static function buscarDepartamentoPorDescripcion($DescDepartamento) {
        $aDepartamento = [];
        $departamento = null;   
        
        $sql = 'select * from Departamento where DescDepartamento like ?';            
        
        $consulta = DBPDO::ejecutarConsulta($sql, ["%$DescDepartamento%"]);
        if ($consulta->rowCount() != 0) {
            for ($i = 0; $i < $consulta->rowCount(); $i++) {
                $datos = $consulta->fetchObject();
                $departamento = new Departamento($datos->CodDepartamento, $datos->DescDepartamento, $datos->FechaBajaDepartamento, $datos->FechaCreacionDepartamento, $datos->VolumenNegocio);
                array_push($aDepartamento, $departamento);
            }
        }
        return $aDepartamento;
    }   

    public static function validarCodNoExiste($CodDepartamento) {
        $existe = false;
        $sql = 'select * from Departamento where CodDepartamento = ?';
        $consulta = DBPDO::ejecutarConsulta($sql, [$CodDepartamento]);
        if ($consulta->rowCount() == 1) {
            $existe = true;
        }
        return $existe;
    }

       public static function mostrarDepartamento() {
        $aDepartamento = [];
        $departamento = null;   
        
        $sql = 'select * from Departamento where DescDepartamento like ?';            
        
        $consulta = DBPDO::ejecutarConsulta($sql,["%%"]);		
		
        if ($consulta->rowCount() != 0) {
            for ($i = 0; $i < $consulta->rowCount(); $i++) {
                $datos = $consulta->fetch(PDO::FETCH_ASSOC);                
                array_push($aDepartamento, $datos);
            }
        }
        return $aDepartamento;
    }

    public static function altaDepartamento($CodDepartamento, $DescDepartamento, $VolumenDeNegocio) {
        $sql = $sql = "insert into Departamento(CodDepartamento,DescDepartamento,VolumenNegocio) values (?,?,?)";
        DBPDO::ejecutarConsulta($sql, [$CodDepartamento, $DescDepartamento, $VolumenDeNegocio]);
    }
	
	 public static function modificaDepartamento($CodDepartamento, $DescDepartamento, $Volumen) {
        if ($DescDepartamento != NULL && $Volumen == NULL) {
            $sql = 'update Departamento set DescDepartamento=? where CodDepartamento=?';
            DBPDO::ejecutarConsulta($sql, [$DescDepartamento, $CodDepartamento]);
        } else {
            if ($Volumen != NULL && $DescDepartamento == NULL) {
                $sql = 'update Departamento set VolumenNegocio=? where CodDepartamento=?';
                DBPDO::ejecutarConsulta($sql, [$Volumen, $CodDepartamento]);
            } else {
                $sql = 'update Departamento set DescDepartamento=?, VolumenNegocio=? where CodDepartamento=?';
                DBPDO::ejecutarConsulta($sql, [$DescDepartamento, $Volumen, $CodDepartamento]);
            }
        }
    }
	
	    public static function eliminarDepartamento($CodDepartamento) {
        $sql = $sql = "delete from Departamento where CodDepartamento = ?";
        DBPDO::ejecutarConsulta($sql, [$CodDepartamento]);
    }

}
