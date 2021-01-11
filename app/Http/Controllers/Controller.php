<?php

namespace App\Http\Controllers;

use App\Core\Domain\Model\Entity\User;
use App\Transformer\UserTransformer;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @return User|null
     * @throws \App\Core\Domain\Exception\UserUnknownException
     */
    protected function getUser(): ?User
    {
        /** @var UserTransformer $userTransformer */
        $userTransformer = resolve(UserTransformer::class);

        if (!Auth::check()) {
            return null;
        }

        return $userTransformer->fromEloquent(Auth::user());
    }
}
