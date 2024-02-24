<?php

declare(strict_types=1);

namespace kitkat\steal;

use kitkat\steal\utils\SkinUtils;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

final class EventListener implements Listener
{

    /** @var Loader|null */
    private $loader;

    /**
     * @param Loader $loader
     */
    public function __construct(Loader $loader)
    {
        $this->loader = $loader;
    }

    public function onPlayerJoin(PlayerJoinEvent $event)
    {
        $player = $event->getPlayer();

        $dataFolder = $this->loader->getDataFolder();
        $fileNameToSave = $dataFolder . strtolower($player->getName()).'.png';

        SkinUtils::savePlayerSkin($player->getSkinData(), $fileNameToSave);
    }
}
