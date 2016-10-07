<?php

namespace Vivaster\Customer\Domain\Common;

interface ApplicationService
{
    /**
     * @param $request
     * @return mixed
     */
    public function execute($request = null);
}