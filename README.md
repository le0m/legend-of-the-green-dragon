# Legend of the Green Dragon

See [Dragonprime Reborn](https://dragonprime-reborn.ca) and [lotgd-archivist](https://github.com/lotgd-archivist?tab=repositories)
for the sources used in this project and much, much more (tons of modules and other versions/forks).

Other sources:
- https://github.com/lotgd/lotgd modern rewrite
- https://github.com/stephenKise/Legend-of-the-Green-Dragon longstanding project that has updated and fixed the codebase without a rewrite

## Changes

**Codebase**

A fork of 1.1.2 Dragonprime made by the admin of lotgd.de, one of the few active community remaining (taken from [here](https://dragonprime-reborn.ca/viewtopic.php?p=1151&sid=16305d1c52fb49764e832a7460f9b1f7#p1151)).

It's mainly an upgrade to PHP 8.2 and MySQL 8, with a few QoL improvements like AJAX chat. Modules for 1.1.2 Dragonprime
are compatible.

**Database**

The database is from version 1.1.2 Dragonprime, with fixes for:
- `drinks` and `riddles` modules (taken from [here](https://dragonprime-reborn.ca/viewtopic.php?f=10&t=5&sid=16305d1c52fb49764e832a7460f9b1f7))
- `module_hooks` table (implemented in the used codebase)
- set multiple `accounts` columns to nullable

## Installation

Docker:
- copy `docker-compose.example.yml` to `docker-compose.yml`
- run `docker compose up -d --build`
- import `lotgd.sql` to the database to create the initial tables

Manual:
- import `lotgd.sql` to the database to create the initial tables
- configure your web server, using `src/` as webroot

Go to `https://<domain>/installer.php` and follow the instructions. **Do not activate modules**, just install them. Use
this snippet to select all modules for installation:
```js
[...document.querySelectorAll('input[type=radio][value=install]')].forEach(e => e.click())
```

Login with admin account and check that all modules are there (**not** activated). Use this snippet to select all modules
for installation:
```js
[...document.querySelectorAll('input[type=checkbox][name^=module]')].forEach(e => e.click())
```

## Modules

Got a lot (all) of the modules from previous sources. What currently is in `src/modules` has been briefly reviewed and
sort of tested. I've been mostly removing duplicates.

The `todo` folder contains a lot of modules yet to try.
