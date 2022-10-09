# Mail System
[Webtrees](https://github.com/fisharebest/webtrees) module for sending newsletters at regular intervals.

> *Make sure to configure the cron job as described in the module settings.*

## APIs
* `/mail-sys/help`: lists the available endpoints.
* `/mail-sys/get`: lists all changes in JSON format.
* `/mail-sys/html`: a preview of the mail that will be sent.
* `/mail-sys/cron`: should be called regularly, it will check if a mail should be sent.
* `/mail-sys/send`: force the sending of the newsletter (requires administrator rights).


## Translation
All language files are located in `/ressouces/lang`. You can edit them with a po editor such as [Poedit](https://poedit.net/)
