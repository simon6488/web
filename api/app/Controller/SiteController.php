<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\User;

class SiteController extends Controller
{
    public function login()
    {
        return ['user' => User::all()->toArray()];
    }
}