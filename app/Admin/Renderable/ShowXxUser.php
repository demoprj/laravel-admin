<?php

namespace App\Admin\Renderable;

use Illuminate\Contracts\Support\Renderable;
use App\Models\XxUser;

class ShowXxUser implements Renderable
{
    public function render($key = null)
    {
        return dump(XxUser::find($key)->toArray());
    }
}
