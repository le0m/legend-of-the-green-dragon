# Legend of the Green Dragon

See [Dragonprime Reborn](https://dragonprime-reborn.ca) and [lotgd-archivist](https://github.com/lotgd-archivist?tab=repositories)
for the sources used in this project and much, much more (tons of modules and other versions/forks).

## Codebase

A fork of 1.1.2 Dragonprime made by the admin of lotgd.de, one of the few active community remaining (taken from [here](https://dragonprime-reborn.ca/viewtopic.php?p=1151&sid=16305d1c52fb49764e832a7460f9b1f7#p1151)).

It's mainly an upgrade to PHP 8.1 and MySQL 8, with a few QoL improvements like AJAX chat. Modules for 1.1.2 Dragonprime
are compatible.

## Database

The database is from version 1.1.2 Dragonprime, with fixes for:
- `drinks` and `riddles` modules (taken from [here](https://dragonprime-reborn.ca/viewtopic.php?f=10&t=5&sid=16305d1c52fb49764e832a7460f9b1f7))
- `module_hooks` table (implemented in the used codebase)

## Installation

Have a database with authorized user.

Go to `https://<domain>/installer.php` and follow the instructions. **Do not activate modules**, just install them.

Use this snippet to select all modules for installation:
```js
[...document.querySelectorAll('input[type=radio][value=install]')].forEach(e => e.click())
```

Login with admin account and check that all modules are there (**not** activated)

## Modules

Added `lovers` and `riddles` from [here](https://dragonprime-reborn.ca/viewtopic.php?f=10&t=5&sid=16305d1c52fb49764e832a7460f9b1f7).

The `todo` folder contains a ton of modules to try.
