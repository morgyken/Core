Sync Library
=========

Usage
---------

Basic usage example:

```php
<?php

use Ignite\Core\Foundation\Sync\Rsync;

$origin = __DIR__;
$target = "/target/dir/";

$rsync = new Rsync;
$rsync->sync($origin, $target);
```

Change behaviour:

```php
<?php

use Ignite\Core\Foundation\Sync\Rsync;

$origin = __DIR__;
$target = "/target/dir";

$config = array(
    'delete_from_target' => true, 
    'ssh' => array(
        'host' => myhost.com, 
        'public_key' => '/my/key.pub'
    )
);

$rsync = new \Ignite\Core\Foundation\Sync\Rsync($config);

// change options programatically
$rsync->setFollowSymlinks(false);

$rsync->sync($origin, $target);
```