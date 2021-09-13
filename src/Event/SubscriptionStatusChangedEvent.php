<?php

namespace App\Event;

class SubscriptionStatusChangedEvent
{
    /** @var int */
    public $status;

    /** @var int */
    public $appId;

    /** @var string */
    public $deviceId;

    /**
     * @param int $status
     * @param int $appId
     * @param string $deviceId
     */
    public function __construct(int $status, int $appId, string $deviceId)
    {
        $this->status = $status;
        $this->appId = $appId;
        $this->deviceId = $deviceId;
    }
}
