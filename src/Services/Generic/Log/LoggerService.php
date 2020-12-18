<?php


namespace App\Service\Generic\Log;

use App\Service\Generic\Flash\FlashMsg;
use App\Service\Generic\Mail\MailerService;
use App\Service\Generic\Slack\SlackService;
use App\Service\Generic\Type\BootstrapType;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class LoggerService
{
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var FlashMsg
     */
    private $flashMsg;
    /**
     * @var MailerService
     */
    private $mailerService;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var SlackService
     */
    private $slackService;

    public function __construct(
        LoggerInterface $logger,
        FlashMsg $flashMsg,
        MailerService $mailerService,
        SlackService $slackService,
        RequestStack $requestStack
    ) {

        $this->logger = $logger;
        $this->flashMsg = $flashMsg;
        $this->mailerService = $mailerService;
        $this->slackService = $slackService;
        $this->request = $requestStack->getCurrentRequest();
    }

    /**
     * @param LogLevel|string $logLevel
     * @param string $message
     * @param array $context
     * @param bool $writeInFile
     * @param bool $emailNotification
     * @param bool $flashMsg
     * @param bool $pushSlack
     */
    public function log(
        $logLevel,
        string $message,
        array $context = array(),
        bool $writeInFile = true,
        bool $emailNotification = false,
        bool $flashMsg = false,
        bool $pushSlack = false
    ) {
        if (in_array($logLevel, [LogLevel::ALERT, LogLevel::WARNING])) {
            $type = BootstrapType::WARNING;
        } elseif (in_array($logLevel, [LogLevel::EMERGENCY, LogLevel::CRITICAL, LogLevel::ERROR])) {
            $type = BootstrapType::DANGER;
        } elseif (in_array($logLevel, [LogLevel::INFO, LogLevel::NOTICE, LogLevel::DEBUG])) {
            $type = BootstrapType::INFO;
        } else {
            $type = 'unknown';
        }

        if ($writeInFile) {
            $this->logger->log($logLevel, $message, $context);
        }

        if ($emailNotification) {
            $this->mailerService->sendEmailPhp(
                sprintf('%s: symfony log report > %s', $this->request->getHost(), $logLevel),
                'info@connectx.fr',
                'info@connectx.fr',
                'ConnectX',
                $message
            );
        }
        if ($flashMsg) {
            $this->flashMsg->addFlash($type, $message);
        }

        if ($pushSlack) {
            $this->slackService->sendSlackMsg($message, $type);
        }
    }

    static public function buildMessage($method, string $message)
    {
        return sprintf('%s > %s', $method, $message);
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    /**
     * @return FlashMsg
     */
    public function getFlashMsg(): FlashMsg
    {
        return $this->flashMsg;
    }

    /**
     * @return MailerService
     */
    public function getMailerService(): MailerService
    {
        return $this->mailerService;
    }

    /**
     * @return SlackService
     */
    public function getSlackService(): SlackService
    {
        return $this->slackService;
    }

    public function addException(?\Exception $exception, $addFlash = true, $addSlack = true)
    {
        if ($exception === null) {
            return false;
        }

        if ($addFlash) {
            $this->getFlashMsg()->addFlash(
                BootstrapType::DANGER,
                $exception->getMessage()
            );
            if ($addSlack) {
                $this->getSlackService()->sendSlackException($exception);
            }
        }

        return true;
    }
}