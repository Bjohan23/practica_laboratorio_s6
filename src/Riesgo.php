<?php

namespace App;

class Riesgo
{
    private $id;
    private $propietario;
    private $valor_impacto;
    private $valor_probabilidad;
    private $valor_riesgo;
    private $id_unidad_organizacional;

    public function __construct($id = null, $propietario = null, $valor_impacto = null, $valor_probabilidad = null, $valor_riesgo = null, $id_unidad_organizacional = null)
    {
        $this->id = $id;
        $this->propietario = $propietario;
        $this->valor_impacto = $valor_impacto;
        $this->valor_probabilidad = $valor_probabilidad;
        $this->valor_riesgo = $valor_riesgo;
        $this->id_unidad_organizacional = $id_unidad_organizacional;
    }

    // Getters and Setters
    public function getId() { return $this->id; }
    public function getPropietario() { return $this->propietario; }
    public function getValorImpacto() { return $this->valor_impacto; }
    public function getValorProbabilidad() { return $this->valor_probabilidad; }
    public function getValorRiesgo() { return $this->valor_riesgo; }
    public function getIdUnidadOrganizacional() { return $this->id_unidad_organizacional; }

    public function setId($id) { $this->id = $id; }
    public function setPropietario($propietario) { $this->propietario = $propietario; }
    public function setValorImpacto($valor_impacto) { $this->valor_impacto = $valor_impacto; }
    public function setValorProbabilidad($valor_probabilidad) { $this->valor_probabilidad = $valor_probabilidad; }
    public function setValorRiesgo($valor_riesgo) { $this->valor_riesgo = $valor_riesgo; }
    public function setIdUnidadOrganizacional($id_unidad_organizacional) { $this->id_unidad_organizacional = $id_unidad_organizacional; }

    // CRUD operations
    public function insertar($conn)
    {
        $stmt = $conn->prepare("INSERT INTO riesgo (propietario, valor_impacto, valor_probabilidad, valor_riesgo, id_unidad_organizacional) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("siiii", $this->propietario, $this->valor_impacto, $this->valor_probabilidad, $this->valor_riesgo, $this->id_unidad_organizacional);
        $stmt->execute();
        $this->id = $conn->insert_id;
        $stmt->close();
    }

    public function actualizar($conn)
    {
        $stmt = $conn->prepare("UPDATE riesgo SET propietario = ?, valor_impacto = ?, valor_probabilidad = ?, valor_riesgo = ?, id_unidad_organizacional = ? WHERE id = ?");
        $stmt->bind_param("siiiii", $this->propietario, $this->valor_impacto, $this->valor_probabilidad, $this->valor_riesgo, $this->id_unidad_organizacional, $this->id);
        $stmt->execute();
        $stmt->close();
    }

    public function eliminar($conn)
    {
        $stmt = $conn->prepare("DELETE FROM riesgo WHERE id = ?");
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $stmt->close();
    }

    public static function leer($conn, $id)
    {
        $stmt = $conn->prepare("SELECT * FROM riesgo WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();
        if ($data) {
            return new self($data['id'], $data['propietario'], $data['valor_impacto'], $data['valor_probabilidad'], $data['valor_riesgo'], $data['id_unidad_organizacional']);
        }
        return null;
    }
}