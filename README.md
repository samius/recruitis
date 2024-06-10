# Milan Krupa - domáci úkol recruitis.io
### Funkční instalace
- funkční instalace aplikace běží na https://recruitis.krupa.link
- záměrně je v develop režimu a se zapnutým profilerem, aby bylo možné vidět rozdíly mezi voláním s cache hit a miss.
- Cache je nastavena na 60 sekund
### Spuštění na localhost
- předpokládá se PHP 8.1 a nainstalovaný globální composer, npm a symfony CLI
- vytvořit soubor `.env.local` a nastavit `RECRUITIS_API_TOKEN`
- `composer install`
- `npm install`
- `npm run dev`
- `symfony server:start`
### Spuštění testů
`vendor/bin/codecept run Unit`


### Poznámky k implementaci
- podle zadání není grafická stránka podstatná, takže jsem v seznamu nezobrazoval všechny atributy, které job má.
Namátkově jsem vybral některé z nich.
- kód by se dal ještě dále tunit a zobecňovat, samozřejmostí by bylo přidání i18n, v tomto rozsahu mi to přišlo nesmyslné
- v dokumentaci to není explicitně napsané, ale počítám, že veškeré časové údaje jsou v UTC. 
V testech je to i takto potvrzeno. 
- formátování čísel, měn, překlady salary units by se řešilo v rámci i18n
- je použito pouze jednoduché cachování pomocí filesystem app cache. Pro skutečný systém by se pro klienta vyčlenil
vlastní cache pool.
- součástí není deployment ani nic podobného, takže není použito např. Symfony Secrets. Způsob přenášení citlivých dat
by se zvolilo podle konkrétní devops politiky. V tomto případě jsou citlivá data obsažena v neverzovaném .env.local
- snažím se příliš neplýtvat komentáři v kódu a doufám, že je kód dostatečně sebedokumentující a přehledný 
i s tím mimimem který tam je.
Mám s komentáři špatné zkušenosti, že velmi rychle zastarávají a v okamžiku kdy si protiřečí s tím, co komentují, tak
přestává být jasné, zda je správný kód nebo komentář.
- běžně používám phpcsfixer a phpstan na precommit hook, ale v tomto rozsahu mi to přišlo zbytečné a předem se omlouvám
za případné chyby ve formátování :) 

### Poznámky k API
- Job id **413548** má nekonzistentní salary - `is_range=true`, ale `is_max_visible=false`.

**Dokumentace atributu `education` v objektu `Job`**: 
- v seznamu `GET /jobs` je to dokumentované jako pole objektů
- v detailu `GET /jobs/{id}` je to dokumentované jako jeden objekt
- v seznamu `GET /jobs` to server posílá jako jeden objekt

