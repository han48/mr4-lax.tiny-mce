<?php

namespace Mr4Lax\TinyMce;

use Encore\Admin\Extension;

class TinyMce extends Extension
{
    public $name = 'tiny-mce';

    public $views = __DIR__ . '/../resources/views';

    public $assets = __DIR__ . '/../resources/assets';

    public $lang = __DIR__ . '/../resources/lang';
}
