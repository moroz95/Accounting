<?php

/**
 * Class View
 */


class View {

    const VIEWS_BASEDIR = "../templates/";

    /**
     * @param $template
     * @param array $params
     * @return string
     */
    protected function fetchPartial($template, $params = array()){
        extract($params);
        ob_start();
        include self::VIEWS_BASEDIR.$template.'.php';
        return ob_get_clean();
    }

    /**
     * @param $template
     * @param array $params
     */
    public function renderPartial($template, $params = array()){
        echo $this->fetchPartial($template, $params);
    }

    /**
     * @param $template
     * @param array $params
     * @param $error
     * @return string
     */
    protected function fetch($template, $params = array(), $error){
        $content = $this->fetchPartial($template, $params);
        return $this->fetchPartial('main', array('content' => $content, 'error' => $error));
    }

    /**
     * @param $template
     * @param array $params
     * @param bool $error
     */
    public function render($template, $params = array(), $error = false){
        echo $this->fetch($template, $params, $error);
    }

}