<?php

class CYiiMailerLogRoute extends CEmailLogRoute
{
    protected function sendEmail($email, $subject, $message)
    {
        $mail = new YiiMailer(
            'error', 
            array(
                'subject' => $subject, 
                'message' => $message, 
            )
        );

        $mail->setFrom('diego@qwavee.com', 'Diego Qwavee');
        $mail->setSubject('ERROR DE APLICACIÓN');
        //$mail->setTo(Yii::app()->params['adminEmail']);
        $mail->setTo($email);

        $mail->send();
        
    }
}