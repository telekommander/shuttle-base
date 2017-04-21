<?php

namespace App\Util;

/**
 * Class SwiftMailerService
 * @package App\Util
 */
class SwiftMailerService {

    private $mailer;

	/**
	 * SwiftMailerService constructor.
	 * @param $mode
	 * @param $transport
	 * @param $options
	 */
    public function __construct($mode, $transport, $options)
    {
        if ($mode == "dev") {
            $transport = \Swift_NullTransport::newInstance();
        } elseif ($transport == "smtp") {
            $transport = \Swift_SmtpTransport::newInstance($options["host"], $options["port"])
                ->setUsername($options["username"])
                ->setPassword($options["password"]);
        } elseif ($transport == "sendmail") {
            $transport = \Swift_SendmailTransport::newInstance($options["command"]);
        } elseif ($transport == "mail") {
            $transport = \Swift_MailTransport::newInstance();

        }
        $this->mailer = \Swift_Mailer::newInstance($transport);
    }

	/**
	 * @param $message
	 * @return int
	 */
    public function send($message)
    {
        return $this->mailer->send($message);
    }

	/**
	 * @param $subject
	 * @param $to
	 * @param $body
	 * @return int
	 */
    public function sendMail($subject, $to, $body)
    {
        $message = \Swift_Message::newInstance($subject)->setTo($to);
        if (is_array($body)) {
            $first = true;
            foreach ($body as $part) {
                if ($first) {
                    $message->setBody($part);
                    $first = false;
                } else {
                    $message->addPart($part);
                }
            }
        } else {
            $message->setBody($body);
        }
        return $this->send($message);
    }

	/**
	 * @return \Swift_Mailer
	 */
    public function getMailer()
    {
        return $this->mailer;
    }
}
