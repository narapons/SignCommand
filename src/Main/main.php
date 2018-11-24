<?php
namespace Main;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\block\SignChangeEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\block\Block;
use pocketmine\math\Vector3;
use pocketmine\tile\Sign;

class main extends PluginBase implements Listener{
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("§eSignCommandを読み込みました");
        }

	public function onTap(PlayerInteractEvent $event){
		$player = $event->getPlayer();
		$level = $player->getLevel();
		$block = $event->getBlock();
		$id = $block->getId();
		if($id === 63 or $id === 68){
			$tile = $player->getLevel()->getTile($block);
			if(isset($tile)){
				$text = $tile->getText();
				$string = $text[0].$text[1].$text[2].$text[3];
				if(strpos($string, '##') !== false){
					$event->setCancelled();
					$explode = explode('##', $string);
					$this->getServer()->dispatchCommand($player, $explode[1]);
				}
			}
		}
	}
}