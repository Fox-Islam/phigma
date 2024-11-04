<?php

namespace Phox\Phigma;

use Phox\Phigma\Requests\AuthenticatesRequest;
use Phox\Phigma\Requests\Comments;
use Phox\Phigma\Requests\DevResources;
use Phox\Phigma\Requests\Files;
use Phox\Phigma\Requests\Payments;
use Phox\Phigma\Requests\Projects;
use Phox\Phigma\Requests\Users;
use Phox\Phigma\Requests\Versions;
use Phox\Phigma\Requests\Webhooks;

final class Client extends AuthenticatesRequest
{
    public function users(): Users
    {
        return new Users($this);
    }

    public function files(): Files
    {
        return new Files($this);
    }

    public function versions(): Versions
    {
        return new Versions($this);
    }

    public function projects(): Projects
    {
        return new Projects($this);
    }

    public function comments(): Comments
    {
        return new Comments($this);
    }

    public function payments(): Payments
    {
        return new Payments($this);
    }

    public function devResources(): DevResources
    {
        return new DevResources($this);
    }

    public function webhooks(): Webhooks
    {
        return new Webhooks($this);
    }
}