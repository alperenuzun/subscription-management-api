<?php

namespace App\Modules\Register;

use App\Helper\RequestBodyResolver;
use App\Modules\Register\Parameters\RegisterParameters;
use App\Schema\TokenResponseSchema;
use Symfony\Component\HttpFoundation\Request;

class Register
{
    /** @var RegisterManager */
    private $registerManager;

    public function __construct(RegisterManager $registerManager)
    {
        $this->registerManager = $registerManager;
    }

    public function register(Request $request): ?TokenResponseSchema
    {
        $parameters = RequestBodyResolver::resolve($request);

        $chainParameters = (new RegisterParameters())->setParameters($parameters);

        /** @var RegisterParameters $chainParameters */
        $chainParameters = $this->registerManager->register($chainParameters);

        return $chainParameters->getResult();
    }
}