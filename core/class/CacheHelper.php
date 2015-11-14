<?php

class CacheHelper {

    public static function getCacheManager($type = "") {

        global $container;
        
        if ($type !== "") {
            $container['cacheType'] = $type;
        }
        
        $cacheClass = $container['fastcache'];

        return $cacheClass;
    }

}
