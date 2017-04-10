<?php
/**
 * @author Jonathon Wallen
 * @date 19/12/2016
 * @time 9:59 AM
 * @copyright (c) 2008-Present Monkii Digital Agency (http://monkii.com.au)
 */

namespace MonkiiBuilt\LaravelUrlAlias\Traits;


trait UrlAlias
{
    public function urlAlias()
    {
        return $this->morphOne('MonkiiBuilt\LaravelUrlAlias\UrlAlias', 'aliasable');
    }

    public function getSystemPathAttribute()
    {
        if ($this->urlAlias) {
            return $this->urlAlias->systemPath;
        }
        return null;
    }

    public function getPathAttribute()
    {
        if ($this->urlAlias) {
            return $this->urlAlias->path;
        }
        return null;
    }

}
