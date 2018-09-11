<?php

namespace Unite\Tags\Test;

use Unite\Tags\HasTags;
use Unite\UnisysApi\Models\Model;

class TestModel extends Model
{
    use HasTags;

    public $table = 'test_models';

    protected $guarded = [];

    public $timestamps = false;
}
