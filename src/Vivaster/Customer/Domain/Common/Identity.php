<?php

namespace Vivaster\Customer\Domain\Common;

use Ramsey\Uuid\Uuid;

/**
 * Class Identity
 */
abstract class Identity
{
    /**
     * @var string
     */
    private $id;

    /**
     * @param string $id
     */
    public function __construct($id = null)
    {
        if ($id === null) {
            $this->id = $this->generateId();
            return;
        }

        $this->id = $id;
    }
    /**
     * @param Identity $identity
     *
     * @return bool
     */
    public function equals(Identity $identity)
    {
        return $this->id() === $identity->id();
    }

    /**
     * @return string
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->id();
    }

    /**
     * @return string
     */
    private function generateId()
    {
        return Uuid::uuid4()->toString();
    }
}