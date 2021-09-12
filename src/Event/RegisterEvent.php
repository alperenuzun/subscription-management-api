<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class RegisterEvent extends Event
{
    /** @var string */
    public $uid;

    /** @var int */
    public $appId;

    /** @var string */
    public $language;

    /** @var string */
    public $operatingSystem;

    /**
     * @param string $uid
     * @param int $appId
     * @param string $language
     * @param string $operatingSystem
     */
    public function __construct(string $uid, int $appId, string $language, string $operatingSystem)
    {
        $this->uid = $uid;
        $this->appId = $appId;
        $this->language = $language;
        $this->operatingSystem = $operatingSystem;
    }
}
