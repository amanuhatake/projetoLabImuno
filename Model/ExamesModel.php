<?php

class ExamesSolicitados {
    private $respostaMicrobio;
    private $respostaParasito;
    private $respostaHemato;
    private $respostaUrina;
    private $respostaBioquimica;
    private $jejum;

    public function __construct() {
        $this->respostaMicrobio = "";
        $this->respostaParasito = "";
        $this->respostaHemato = "";
        $this->respostaUrina = "";
        $this->respostaBioquimica = "";
        $this->jejum = false;
    }

    public function getRespostaMicrobio() {
        return $this->respostaMicrobio;
    }

    public function setRespostaMicrobio($respostaMicrobio) {
        $this->respostaMicrobio = $respostaMicrobio;
    }

    public function getRespostaParasito() {
        return $this->respostaParasito;
    }

    public function setRespostaParasito($respostaParasito) {
        $this->respostaParasito = $respostaParasito;
    }

    public function getRespostaHemato() {
        return $this->respostaHemato;
    }

    public function setRespostaHemato($respostaHemato) {
        $this->respostaHemato = $respostaHemato;
    }

    public function getRespostaUrina() {
        return $this->respostaUrina;
    }

    public function setRespostaUrina($respostaUrina) {
        $this->respostaUrina = $respostaUrina;
    }

    public function getRespostaBioquimica() {
        return $this->respostaBioquimica;
    }

    public function setRespostaBioquimica($respostaBioquimica) {
        $this->respostaBioquimica = $respostaBioquimica;
    }

    public function getJejum() {
        return $this->jejum;
    }

    public function setJejum($jejum) {
        $this->jejum = $jejum;
    }

    public function __toString() {
        return "ExamesSolicitados{" .
            "respostaMicrobio='" . $this->respostaMicrobio . "', " .
            "respostaParasito='" . $this->respostaParasito . "', " .
            "respostaHemato='" . $this->respostaHemato . "', " .
            "respostaUrina='" . $this->respostaUrina . "', " .
            "respostaBioquimica='" . $this->respostaBioquimica . "', " .
            "jejum=" . ($this->jejum ? 'true' : 'false') .
            "}";
    }
}
