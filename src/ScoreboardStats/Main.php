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
 		$this->eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
 		$this->getServer()->getScheduler()->scheduleRepeatingTask(new CallbackTask(array($this, "Status")), 20);
		$this->getLogger()->info("§a ปลักอิน แสดงสถานะ ถูกเปิด");
		$this->getLogger()->info("§e กรุณลง ปลักอิน Economy API ด้วย");
		$this->getLogger()->info("§9 เซิฟเวอร์ที่ใช้ปลักอินนี้ sgpk.ddns.net Port 19132");
 	}
 
 	public function Status() {
 		foreach($this->getServer()->getOnlinePlayers() as $p) {
 			$name = $p->getPlayer()->getName();
 			$money = $this->eco->mymoney($name);
 			$online = count(Server::getInstance()->getOnlinePlayers());	
			$item = $p->getInventory()->getItemInHand()->getId();
			$damage = $p->getInventory()->getItemInHand()->getDamage();
 			$p->sendPopup(" §eไอดี:§b $name §cออนไลน์:§d $online §aเงินที่มี:§f $money §2$ \n §9ไอเท็ม: $item §f:§9 $damage");
 		}
 	}

	public function onDisable() {
		$this->getLogger()->info("§4ปลักอิน แสดงสถานะถูกปิด !");
	}
}
