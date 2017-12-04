<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 29/11/2017
 * Time: 00:15
 */

namespace app\classes;


use app\lib\FormHelper;

class FormLogin extends FormHelper
{
    /**
     * @var formName => Nom du Formulaire
     */
    private $formName;
    public $icon;

    /**
     * FormLogin constructor.
     * @param $formName
     */
    public function __construct($formName)
    {
        $this->formName = $formName;
    }

    /**
     * @return string :
     */

    public function getFormName()
    {
        return 'Form' . $this->formName;
    }

    /**
     * @return string : Renvoie le formulaire
     */

    public function formStart()
    {
        return $this->form_open('post', 'index.php?action=login', 'login-form');
    }

    /**
     * @return string fermeture balise formulaire
     */

    public function formClose()
    {
        return $this->form_close();
    }

    /**
     * @return string : renvoie l'input email pour le formulaire de connection
     */

    public function inputLogin()
    {
        return '<p class="logo-login"><i class="fa fa-envelope" id="envelope-login"></i>' .$this->input_email('email', 'Email', 'Email', 'email', '', false).'<span class="close-form"  id="close"><i class="fa fa-times-circle fa-2x"></i></span></p>';
    }

    /**
     * @return string : renvoie l'input password pour le formulaire de connection
     */

    public function inputPassLogin()
    {
        return '<p class="logo-password"><i class="fa fa-lock"></i>'. $this->input_pass('password', 'password', '', 'password', '', false).'</p>';
    }

    /**
     * @return string : renvoie le bouton de connection pour le formulaire de connection
     */

    public function inputSubmit()
    {
        return '<p id="submit-suscribe">' .$this->input_submit('submit_log', '', '', 'submit', '', false).'<i class="fa fa-arrow-right"></i></p>';
    }
}