<?php

class Application {

    private $oRota;
    private $request;

    function __construct() {
        $this->oRota = new Rota();
        $this->request = $this->currentRequest();
    }

    function init() {
        $id_valid = $this->oRota->isValid($this->request);
        if ($id_valid) {

                if (!$this->isPublicRequest()) {

                    $logged = $this->isLogged();
                    /**
                     * SE ESTIVER LOGADO
                     */
                    if ($logged) {
                        return $this->renderPrivateRequest();
                    } else {
                        $this->request = "login";
                        return $this->renderPublicRequest();
                    }
                } else {
                    return $this->renderPublicRequest();
                }
        } else {
            $this->request = "not_found";
            return $this->renderPublicRequest();
        }
    }

    function isPublicRequest() {
        $publicas = $this->oRota->getRotasPublicas();
        if (in_array($this->request, $publicas)) {
            return true;
        } else {
            return false;
        }
    }

    function isLogged() {
        if (!empty($_SESSION['USER']['ID_USUARIO'])) {
            return true;
        } else {
            return false;
        }
    }

    function currentRequest() {
        $page = explode('/', $_SERVER['REQUEST_URI']);
        $page = $page[count($page) - 1];
        $page = explode('?', $page);
        $request = $page[0] ? $page[0] : 'main';
        return $request;
    }

    function renderPrivateRequest() {
        $this->oRota->setRota($this->request);
        $arquivo = $this->oRota->userHasPermission();
        return !empty($arquivo) ? $arquivo : false;
    }

    function renderPublicRequest() {
        $this->oRota->setRota($this->request);
        $arquivo = $this->oRota->loadView();
        return !empty($arquivo) ? $arquivo : false;
    }

}
