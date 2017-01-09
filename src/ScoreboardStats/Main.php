<?php

namespace ScoreboardStats;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\scheduler\CallbackTask;

class Main extends PluginBase implements Listener {
 	private $timer, $EconomyS;
 	
 
 	public function onEnable() {
 		$this->getServer()->getPluginManager()->registerEvents($this, $this);
 		$this->EconomyS = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
 		$this->getServer()->getScheduler()->scheduleRepeatingTask(new CallbackTask(array($this, "Status")), 20);
		$this->getLogger()->info("§a ปลักอิน แสดงสถานะ ถูกเปิด");
		$this->getLogger()->info("§e กรุณลง ปลักอิน Economy API ด้วย");
		$this->getLogger()->info("§9 เซิฟเวอร์ที่ใช้ปลักอินนี้ sgpk.ddns.net Port 19132");
 	}
 
 	public function Status() {
 		foreach($this->getServer()->getOnlinePlayers() as $players) {
 			$Name = $players->getPlayer()->getName();
 			$Money = $this->EconomyS->mymoney($Name);
 			$Online = count(Server::getInstance()->getOnlinePlayers());	
			$Item = $players->getInventory()->getItemInHand()->getId();
			$da = $players->getInventory()->getItemInHand()->getDamage();
 			$players->sendPopup(" §eไอดี:§b $Name §cออนไลน์:§d $Online §aเงินที่มี:§f $Money §2$ \n §9ไอเท็ม: $Item §f:§9 $da");
 		}
 	}

	public function onDisable() {
		$this->getLogger()->info("§4ปลักอิน แสดงสถานะถูกปิด !");
	}
}
