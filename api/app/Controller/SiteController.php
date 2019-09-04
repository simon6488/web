<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\User;
use Hyperf\Redis\Redis;

class SiteController extends Controller
{
    public function login()
    {
        $data = $this->request->all();
        $redis = $this->container->get(Redis::class);
        $redis->set('test', 1);
        return [
            'value' => $redis->get('test')
        ];
    }
}