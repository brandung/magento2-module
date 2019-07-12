<?php

declare(strict_types=1);

namespace Omikron\Factfinder\Model;

use Magento\Framework\App\Area;
use Magento\Store\Model\App\Emulation;

class StoreEmulation
{
    /** @var Emulation */
    private $emulation;

    public function __construct(Emulation $emulation)
    {
        $this->emulation = $emulation;
    }

    public function runInStore(int $storeId, callable $proceed)
    {
        $result = null;
        try {
            $this->emulation->startEnvironmentEmulation($storeId, Area::AREA_FRONTEND, true);
            $result = $proceed();
        } finally {
            $this->emulation->stopEnvironmentEmulation();
            return $result;
        }
    }
}
