<?php
/**
 * @author Jonathon Wallen
 * @date 16/12/2016
 * @time 11:05 AM
 * @copyright (c) 2008-Present Monkii Digital Agency (http://monkii.com.au)
 */

namespace MonkiiBuilt\LaravelUrlAlias;

use Eloquent;

class UrlAlias extends Eloquent
{
    protected $table = 'url_alias';

    protected $fillable = [
        'path',
        'system_path',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function aliasable()
    {
        return $this->morphTo();
    }
}
