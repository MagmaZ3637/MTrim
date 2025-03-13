# 🧥 MTrim

A PocketMine-MP plugin that allows players to add trims to their armor using a UI.

## 📷 Pictures!
![pictures\1.png](https://github.com/MagmaZ3637/MTrim/blob/main/pictures/1.png?raw=true)

![pictures\2.png](https://github.com/MagmaZ3637/MTrim/blob/main/pictures/2.png?raw=true)

![pictures\3.png](https://github.com/MagmaZ3637/MTrim/blob/main/pictures/3.png?raw=true)

![pictures\4.png](https://github.com/MagmaZ3637/MTrim/blob/main/pictures/4.png?raw=true)

## 🎮 Features
1. [x] Easily add trims to armor via UI.

2. [x] Compatible with all materials.
 
3. [x] Supports a variety of trim types.
 
4. [x] Uses player XP as currency for applying trims.

5. [x] Interact with the Smithing Table to access the trim UI.

## 📥 Installation
1. Download the `.phar` file from poggit.
2. Place the `MTrim.phar` file in the `plugins` folder of your server.
3. Restart the server, and the plugin is ready to use!

## 🔧 Commands
| Command  | Description |
|------------|-----------|
| `/trim` | Opens the armor trim UI for customization. |

## 🔑 Permissions
| Permission  | Default | Description |
|------------|---------|-----------|
| `trim.use` | true    | Allow player to use the /trim command. |

## ⚙️ Requirements
- [FormAPI](https://github.com/jojoe77777/FormAPI)
- [LibTrimArmor](https://github.com/KRUNCHSHooT/LibTrimArmor)

## 💾 Config
**config.yml**
```yaml
#
#  ███╗░░░███╗████████╗██████╗░██╗███╗░░░███╗
#  ████╗░████║╚══██╔══╝██╔══██╗██║████╗░████║
#  ██╔████╔██║░░░██║░░░██████╔╝██║██╔████╔██║
#  ██║╚██╔╝██║░░░██║░░░██╔══██╗██║██║╚██╔╝██║
#  ██║░╚═╝░██║░░░██║░░░██║░░██║██║██║░╚═╝░██║
#  ╚═╝░░░░░╚═╝░░░╚═╝░░░╚═╝░░╚═╝╚═╝╚═╝░░░░░╚═╝
#  Mtrim | Config file | MagmaZ3637

# Formats:
#  {player} = player name
#  {xp} = player xp
#  {prefix} = prefix
#  & = §

# The prefix that will appear in every plugin message.
prefix: "&e[ MTrim ] &r"

# The default price for trimming armor (you can change it as needed).
# If you want the price to be free, change it to 0.
price: 3

# The type of message used to notify the player.
# TOAST = small popup above the hotbar.
# MESSAGE = chat message.
message-type: "TOAST"


# FORM AREA
# The title displayed in the armor trim form.
title-form: "Trim Armor"

# Label for selecting the armor trim pattern.
label-pattern: "Choose Trim Pattern"

# Label for selecting the armor trim material.
label-material: "Choose Trim Material"


# MESSAGE AREA
# Message shown when the player tries to trim a non-armor item.
item-is-not-armor: "&cThis item is not an armor!"

# Message shown when the armor trim is successfully applied.
armor-trim-success: "&aArmor trimmed successfully!"

# Message shown when the player does not have enough XP to trim armor.
not-enough-xp: "&cYou don't have enough XP!"


```

## 📜 License
[Apache License 2.0](https://github.com/MagmaZ3637/MTrim/blob/main/LICENSE)
