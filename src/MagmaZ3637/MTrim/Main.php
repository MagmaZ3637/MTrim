<?php

namespace MagmaZ3637\MTrim;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\item\Armor;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

use jojoe77777\FormAPI\CustomForm;

use KRUNCHSHooT\LibTrimArmor\LibTrimArmor;
use KRUNCHSHooT\LibTrimArmor\MaterialType;
use KRUNCHSHooT\LibTrimArmor\PatternType;

class Main extends PluginBase implements Listener
{
    public function onEnable(): void {
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        if ($this->getConfig()->get("message-type") == "TOAST" || $this->getConfig()->get("message-type") == "MESSAGE") {
            $this->getLogger()->info("message type is valid. Plugin Enabled!");
        } else {
            $this->getLogger()->error("Invalid message type! Use TOAST or MESSAGE. Plugin Disabled");
            $this->getServer()->getPluginManager()->disablePlugin($this);
        }
        if ($this->getConfig()->get("price") < 0) {
            $this->getLogger()->error("Invalid price! The price must be 0 or higher. Plugin Disabled");
            $this->getServer()->getPluginManager()->disablePlugin($this);
        }
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        if ($sender instanceof Player && $command->getName() == "trim") {
            $armor = $sender->getInventory()->getItemInHand();
            if ($armor instanceof Armor) {
                $this->getFormInput($sender);
            } else {
                $this->messageHandler($sender, $this->getConfig()->get("item-is-not-armor"));
            }
        } else {
            $sender->sendMessage("Only player can access this command");
        }
        return true;
    }

    public function getFormInput(Player $player): void
    {
        $form = new CustomForm(function (Player $player, array $data = null){
            if (is_null($data)) {
                return false;
            }
            $material = $data[0];
            $pattern = $data[1];
            $armor = $player->getInventory()->getItemInHand();
            if (!is_null($pattern) && !is_null($material)) {
                if ($player->getXpManager()->getXpLevel() >= $this->getConfig()->get("price")) {
                    if ($armor instanceof Armor) {
                        LibTrimArmor::create($armor, $this->getMaterial($material), $this->getPattern($pattern));
                        $player->getInventory()->setItemInHand($armor);
                        $this->messageHandler($player, $this->getConfig()->get("armor-trim-success"));
                        $player->getXpManager()->subtractXpLevels($this->getConfig()->get("price"));
                    }
                } else {
                    $this->messageHandler($player, $this->getConfig()->get("not-enough-xp"));
                }
            } else {
                $this->messageHandler($player, $this->getConfig()->get("item-is-not-armor"));
            }
            return true;
        });
        $form->setTitle($this->replaceHandler($player, $this->getConfig()->get("title-form")));
        $form->addDropdown($this->replaceHandler($player, $this->getConfig()->get("label-material")), ["Amethyst", "Copper", "Diamond", "Emerald", "Gold", "Iron", "Quartz", "Redstone", "Netherite", "Lapis Lazuli"], 0);
        $form->addDropdown($this->replaceHandler($player, $this->getConfig()->get("label-pattern")), ["Bolt", "Coast", "Dune", "Eye", "Flow", "Host", "Raiser", "Rib", "Sentry", "Shaper", "Silence", "Snout", "Spike", "Tide", "Vex", "Ward", "Wayfinder", "Wild"], 0);
        $player->sendForm($form);
    }

    public function getPattern(int $material): bool|string
    {
        return match ($material) {
            0 => PatternType::BOLT,
            1 => PatternType::COAST,
            2 => PatternType::DUNE,
            3 => PatternType::EYE,
            4 => PatternType::FLOW,
            5 => PatternType::HOST,
            6 => PatternType::RAISER,
            7 => PatternType::RIB,
            8 => PatternType::SENTRY,
            9 => PatternType::SHAPER,
            10 => PatternType::SILENCE,
            11 => PatternType::SNOUT,
            12 => PatternType::SPIRE,
            13 => PatternType::TIDE,
            14 => PatternType::VEX,
            15 => PatternType::WARD,
            16 => PatternType::WAYFINDER,
            17 => PatternType::WILD,
            default => true,
        };
    }

    public function getMaterial(int $pattern): bool|string
    {
        return match ($pattern) {
            0 => MaterialType::AMETHYST,
            1 => MaterialType::COPPER,
            2 => MaterialType::DIAMOND,
            3 => MaterialType::EMERALD,
            4 => MaterialType::GOLD,
            5 => MaterialType::IRON,
            6 => MaterialType::QUARTZ,
            7 => MaterialType::REDSTONE,
            8 => MaterialType::NETHERITE,
            9 => MaterialType::LAPIS,
            default => true,
        };
    }

    public function messageHandler(Player $player, $message): void
    {
        $msg = $this->getConfig()->get("message-type");
        $prefix = $this->getConfig()->get("prefix");
        if ($msg == "MESSAGE") {
            $player->sendMessage($this->replaceHandler($player, $message));
        } else if ($msg == "TOAST") {
            $player->sendToastNotification($this->replaceHandler($player, $prefix), $this->replaceHandler($player, $message));
        }
    }

    public function replaceHandler(Player $player, string $message): string
    {
        $replace = [
            "{player}" => $player->getName(),
            "{xp}" => $player->getXpManager()->getXpLevel(),
            "{prefix}" => str_replace(["&", "{player}", "{px}"], ["§", $player->getName(), $player->getXpManager()->getXpLevel()], $this->getConfig()->get("prefix")),
            "&" => "§"
        ];
        return strtr($message, $replace);
    }
}