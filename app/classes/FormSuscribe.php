<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 29/11/2017
 * Time: 00:22
 */

namespace app\classes;


use app\lib\FormHelper;

class FormSuscribe extends FormHelper
{
    private $formName;
    public $icon;

    /**
     * FormSuscribe constructor.
     * @param $formName
     */

    public function __construct($formName)
    {
        $this->formName = $formName;
    }

    /**
     * @return string
     */

    public function getFormName()
    {
        return 'Form' . $this->formName;
    }

    /**
     * @return string Renvoie le formulaire ainsi que l'action pour le formulaire d'inscription
     */

    public function formStart()
    {
        return $this->form_open('post', 'index.php?action=register', 'suscribe-form');
    }

    /**
     * @return string : renvoie la balise de fermeture du formulaire
     */

    public function formClose()
    {
        return $this->form_close();
    }

    /**
     * @return string : input email pour formulaire d'inscription
     */

    public function inputEmailSuscribe()
    {
        return '<p class="logo-email"><i class="fa fa-envelope" id="envelope-suscribe"></i>
                                <span class="close-form"  id="close"><i class="fa fa-times-circle fa-2x"></i></span>
                                <span class="check_ok"></span>
                                <span class="regex-mail"></span>
                                <span class="regex-mail-valide"></span>'.$this->input_email('email_suscribe', 'email@email.com', '', 'email_suscribe', 'required', false).'</p>';
    }

    /**
     * @return string : input text pour le formulaire d'inscription
     */

    public function inputTxtSuscribe()
    {
        return '<p class="logo-login"><i class="fa fa-user"></i> ' .$this->input_txt('login', 'Pseudonyme', '', 'login', 'required', false).'</p>';
    }

    /**
     * @return string : input password pour le formulaire d'inscription
     */

    public function inputPassSuscribe()
    {
        return ' <p class="logo-password"><i class="fa fa-lock"></i><span class="regex-password"></span>'. $this->input_pass('password', 'password', '', 'password_suscribe', 'required', false).'</p>';
    }

    /**
     * @return string : bouton d'envoie du formulaire d'inscription
     */

    public function inputSubmitSuscribe()
    {
        return '<p id="submit-suscribe-ko"><span class="check_ko"></span></p>
                            <p id="submit-suscribe-ok">' .$this->input_submit('submit', '', '', 'submit_suscribe_btn', 'disabled', false).'<i class="fa fa-arrow-right"></i></p>';
    }
}