<?php

namespace App\Service\Generic\Flash;

use App\Service\Generic\Type\BootstrapType;
use App\Service\Generic\Utils\StringUtils;
use Symfony\Component\HttpFoundation\Session\Session;

class FlashMsg
{
    /**
     * @var Session
     */
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function addFlash(string $type, string $msg): void
    {
        if (!BootstrapType::isValidType($type)) {
            throw new \InvalidArgumentException(sprintf('Invalid flash message type: %s', $type));
        }
        $this->session->getFlashBag()->add($type, StringUtils::javascriptEscape($msg));
    }
}