<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Riesgo;

class RiesgoTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        $this->conn = new \mysqli("localhost", "root", "", "riesgo");

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    protected function tearDown(): void
    {
        $this->conn->close();
    }

    public function testConstructorSinParametros()
    {
        $riesgo = new Riesgo();
        $this->assertInstanceOf(Riesgo::class, $riesgo);
    }

    public function testConstructorConParametros()
    {
        $riesgo = new Riesgo(1, "Propietario", 10, 20, 30, 1);
        $this->assertEquals(1, $riesgo->getId());
        $this->assertEquals("Propietario", $riesgo->getPropietario());
        $this->assertEquals(10, $riesgo->getValorImpacto());
        $this->assertEquals(20, $riesgo->getValorProbabilidad());
        $this->assertEquals(30, $riesgo->getValorRiesgo());
        $this->assertEquals(1, $riesgo->getIdUnidadOrganizacional());
    }

    public function testInsertar()
    {
        $riesgo = new Riesgo(null, "Propietario", 10, 20, 30, 1);
        $riesgo->insertar($this->conn);
        $this->assertNotNull($riesgo->getId());

        $riesgoLeido = Riesgo::leer($this->conn, $riesgo->getId());
        $this->assertEquals("Propietario", $riesgoLeido->getPropietario());
    }

    public function testActualizar()
    {
        $riesgo = new Riesgo(null, "Propietario", 10, 20, 30, 1);
        $riesgo->insertar($this->conn);
        $riesgo->setPropietario("Nuevo Propietario");
        $riesgo->actualizar($this->conn);

        $riesgoLeido = Riesgo::leer($this->conn, $riesgo->getId());
        $this->assertEquals("Nuevo Propietario", $riesgoLeido->getPropietario());
    }

    public function testEliminar()
    {
        $riesgo = new Riesgo(null, "Propietario", 10, 20, 30, 1);
        $riesgo->insertar($this->conn);
        $id = $riesgo->getId();
        $riesgo->eliminar($this->conn);

        $riesgoLeido = Riesgo::leer($this->conn, $id);
        $this->assertNull($riesgoLeido);
    }

    public function testLeer()
    {
        $riesgo = new Riesgo(null, "Propietario", 10, 20, 30, 1);
        $riesgo->insertar($this->conn);

        $riesgoLeido = Riesgo::leer($this->conn, $riesgo->getId());
        $this->assertEquals("Propietario", $riesgoLeido->getPropietario());
    }
}