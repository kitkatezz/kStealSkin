<?php

declare(strict_types=1);

namespace kitkat\steal;

use pocketmine\plugin\PluginBase;

/**
 * @author kitkat. <https://github.com/kitkatezz>
 * @copyright 2024 kitkat. - Todos os direitos reservados
 */

final class Loader extends PluginBase
{

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        @mkdir($this->getDataFolder());
    }
}
