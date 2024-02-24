<?php

declare(strict_types=1);

namespace kitkat\steal;

use pocketmine\plugin\PluginBase;

final class Loader extends PluginBase
{

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        @mkdir($this->getDataFolder());
    }
}
