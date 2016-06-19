<?php

namespace ScoreboardStats;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\scheduler\CallbackTask;

class Main extends PluginBase implements Listener {
 	private $timer, $EconomyS;
 	
 	//public $cfg;
 
 	public function onEnable() {
 		$this->getServer()->getPluginManager()->registerEvents($this, $this);
 		$this->EconomyS = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
 		$this->getServer()->getScheduler()->scheduleRepeatingTask(new CallbackTask(array($this, "ScoreboardStats")), 10);
		$this->getLogger()->info("§a Plugin Status Runing");
 		$this->timer = 0;
 	}
 
 	public function ScoreboardStats() {
 		foreach($this->getServer()->getOnlinePlayers() as $players) {
 			$Name = $players->getPlayer()->getName();
 			$Money = $this->EconomyS->mymoney($Name);
 			//$Online = count(Server::getInstance()->getOnlinePlayers());
 			//$Full = $this->getServer()->getMaxPlayers();
 			//$TPS = $this->getServer()->getTicksPerSecond(); 
 			//$Load = $this->getServer()->getTickUsageAverage();
 			//$Time = intval($this->cfg["time"]) * 20;
 			$players->sendPopup(" §eID:§b $Name  §aCoin:§f $Money §2$ ");
 		}
 	}

	public function onDisable() {
		$this->getLogger()->info("§4Disabled !");
	}
}
