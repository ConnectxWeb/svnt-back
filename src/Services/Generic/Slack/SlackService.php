<?php


namespace App\Services\Generic\Slack;


use App\Services\Generic\Symfony\SymfonyUtils;
use App\Services\Generic\Type\BootstrapType;
use Http\Client\Exception;
use Nexy\Slack\Client; //composer require nexylan/slack
use Throwable;

class SlackService
{
    /**
     * @var Client
     */
    private $slack;

    public function __construct(Client $slack)
    {
        $this->slack = $slack;
    }

    public function sendSlackMsg(string $msg, $bootstrapStyle = null)
    {
        $msg = $this->replaceSpecialChars($msg);
        if ($bootstrapStyle !== null) {
            $msg = sprintf(
                '%s %s',
                $this->bootstrapTypeToIcon(BootstrapType::WARNING),
                $msg
            );
        }
        $message = $this->slack->createMessage()
            ->from('Robot')
            ->withIcon(':ghost:')
            ->setText($msg);
        try {
            $this->slack->sendMessage($message);
        } catch (Exception $e) {
        }
    }

    public function sendSlackException(Throwable $e)
    {
        if (SymfonyUtils::isDev()) {
            return;
        }

        $msg = sprintf(
            "%s *Exception raised*\n %s\n```File: %s\nLine: %s\nCode: %s```\n```%s```",
            $this->bootstrapTypeToIcon(BootstrapType::WARNING),
            $this->replaceSpecialChars($e->getMessage()),
            $this->replaceSpecialChars($e->getFile()),
            $this->replaceSpecialChars($e->getLine()),
            $this->replaceSpecialChars($e->getCode()),
            $this->replaceSpecialChars($e->getTraceAsString())
        );

        $this->sendSlackMsg($msg);
    }

    private function replaceSpecialChars($txt)
    {
        $r = $txt;
        $r = str_replace('&', '&amp;', $r);
        $r = str_replace('<', '&lt;', $r);
        $r = str_replace('>', '&gt;', $r);

        return $r;
    }

    private function bootstrapTypeToIcon($bootstrapType)
    {
        switch ($bootstrapType) {
            case BootstrapType::INFO:
                return ':white_circle:';
                break;
            case BootstrapType::SUCCESS:
                return ':white_check_mark:';
                break;
            case BootstrapType::WARNING:
                return ':warning:';
                break;
            case BootstrapType::DANGER:
                return ':boom:';
                break;
            default:
                return ':ghost:';
        }
    }
}