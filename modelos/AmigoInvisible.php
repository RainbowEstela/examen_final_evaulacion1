<?php

namespace AmigoInvisible\modelos;

class AmigoInvisible
{
    private $id;
    private $nombre;
    private $estado;
    private $maximoDinero;
    private $fecha;
    private $lugar;
    private $observaciones;
    private $emoji;

    public function __construct($id = "", $nombre = "", $estado = "", $maximoDinero = "", $fecha = "", $lugar = "", $observaciones = "", $emoji = "")
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->estado = $estado;
        $this->maximoDinero = $maximoDinero;
        $this->fecha = $fecha;
        $this->lugar = $lugar;
        $this->observaciones = $observaciones;
        $this->emoji = $emoji;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get the value of maximoDinero
     */
    public function getMaximoDinero()
    {
        return $this->maximoDinero;
    }

    /**
     * Set the value of maximoDinero
     *
     * @return  self
     */
    public function setMaximoDinero($maximoDinero)
    {
        $this->maximoDinero = $maximoDinero;

        return $this;
    }

    /**
     * Get the value of fecha
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of lugar
     */
    public function getLugar()
    {
        return $this->lugar;
    }

    /**
     * Set the value of lugar
     *
     * @return  self
     */
    public function setLugar($lugar)
    {
        $this->lugar = $lugar;

        return $this;
    }

    /**
     * Get the value of observaciones
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set the value of observaciones
     *
     * @return  self
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get the value of emoji
     */
    public function getEmoji()
    {
        return $this->emoji;
    }

    /**
     * Set the value of emoji
     *
     * @return  self
     */
    public function setEmoji($emoji)
    {
        $this->emoji = $emoji;

        return $this;
    }
}
