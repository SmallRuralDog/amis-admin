<?php
namespace SmallRuralDog\AmisAdmin\Extensions;

interface SettingStorage
{
    public function all($fresh = false);

    public function get($key, $default = null, $fresh = false);

    public function has($key);

    public function set($key, $val = null);

    public function remove($key);

    public function flushCache();

}
