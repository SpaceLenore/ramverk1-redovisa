# ramverk1-redovisa

Weather part of my redovisa page as a separate module.

## Installation
* Add it to your composer.json
* Execute `composer update`
* Run postprocessing script (if not done by magic already) `bash vendor/spacelenore/ramverk1-redovisa/.anax/scaffhold/postprocess.d/100_init_ramverk_redovisa.bash`
* Add the api-token to the `config/ApiTokens.php`. The file should look like this:
```php
<?php

return [
    "darksky" => 'YourTokenGoesHere',
    ];
```
