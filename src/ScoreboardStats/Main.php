<?php

namespace ScoreboardStats;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\scheduler\CallbackTask;

class Main extends PluginBase implements Listener {
 	private $timer, $EconomyS; //$PurePerms;
 	
 
 	public function onEnable() {
 		$this->getServer()->getPluginManager()->registerEvents($this, $this);
 		$this->EconomyS = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
                //$this->PurePerms = $this->getServer()->getPluginManager()->getPlugin("PurePerms");
 		$this->getServer()->getScheduler()->scheduleRepeatingTask(new CallbackTask(array($this, "Status")), 20);
		$this->getLogger()->info("§a ปลักอิน แสดงสถานะ ถูกเปิด");
		$this->getLogger()->info("§e กรุณลง ปลักอิน Economy API ด้วย");
		$this->getLogger()->info("§9 เซิฟเวอร์ที่ใช้ปลักอินนี้ sgpk.ddns.net Port 19132");
 		$this->timer = 0;
 	}
 
 	public function Status() {
 		foreach($this->getServer()->getOnlinePlayers() as $players) {
 			$Name = $players->getPlayer()->getName();
 			$Money = $this->EconomyS->mymoney($Name);
                        $Group = $this->PurePerms->getUser($player)->getGroup($levelName); 
 			$Online = count(Server::getInstance()->getOnlinePlayers());
 			//$Full = $this->getServer()->getMaxPlayers();
 			//$TPS = $this->getServer()->getTicksPerSecond(); 
 			//$Load = $this->getServer()->getTickUsageAverage();
 			//$Time = intval($this->cfg["time"]) * 20;
			$Item = $players->getInventory()->getItemInHand();
 			$players->sendPopup(" §eไอดี:§b $Name §cออนไลน์:§d $Online §aเงินที่มี:§f $Money §2$ \n §9ไอเท็ม: $Item");
 		}
 	}

	public function onDisable() {
		$this->getLogger()->info("§4ปลักอิน แสดงสถานะถูกปิด !");
	}
}
