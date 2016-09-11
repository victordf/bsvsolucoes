<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 11/09/16
 * Time: 11:57
 */

require_once "../../vendor/phpmailer/phpmailer/PHPMailerAutoload.php";

class Email {

    protected $mailer;

    /**
     * Email constructor.
     * @param null $user
     * @param null $pass
     */
    public function __construct($user = null, $pass = null)
    {
        $this->mailer = new PHPMailer();

        $this->mailer->isSMTP();
        $this->mailer->Host = '';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = !empty($user) ? $user : '';
        $this->mailer->Password = !empty($pass) ? $pass : '';
        $this->mailer->SMTPSecure = '!tls';
        $this->mailer->Port = 587;
        $this->setFormato();
    }

    /**
     * Altera o formato do email, para ser enviado em html ou não.
     *
     * @param bool $isHtml (Default = false)
     */
    public function setFormato($isHtml = false){
        $this->mailer->isHTML($isHtml);
    }

    /**
     * Adiciona um anexo ao email.
     *
     * @param $arquivo
     * @throws phpmailerException
     */
    public function addAnexo($arquivo){
        $this->mailer->addAttachment($arquivo);
    }
}