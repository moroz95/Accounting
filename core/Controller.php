<?php

/**
 * Class Controller
 *
 * @package Core
 * @subpackage Controller
 *
 * @author phrlog <phrlog@gmail.com>
 *
 */


class Controller
{
    /**
     * @var object $model  model of right entity
     */
    protected $model;


    /**
     * @var object $view  object of core View
     */
    protected $view;

    /**
     * Controller constructor.
     *
     * Constructor sets up {@link $model} and {@link $view}
     * @param string $model_name name of right model
     */
    function __construct($model_name)
    {
        $this->model = new $model_name;
        $this->view = new View;
    }
    


}