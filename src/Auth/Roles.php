<?php

namespace Loo\Auth;

use Loo\Database\LooEntityManager;
use Loo\Core\AbstractEntityManagerModel;

/**
 * Handles roles. An user has access if his role is on the same level or higher than the order defined in the $hierarchy
 * array.
 */
class Roles extends AbstractEntityManagerModel
{
    /**
     * @var array
     */
    private $hierarchy;

    /**
     * @param LooEntityManager $entityManager
     * @param array            $hierarchy
     */
    public function __construct(LooEntityManager $entityManager, array $hierarchy)
    {
        parent::__construct($entityManager);

        $this->hierarchy = $hierarchy;
    }

    /**
     * @param string $currentRole
     * @param string $neededRole
     * @return bool
     */
    public function hasAccess($currentRole, $neededRole)
    {
        return $currentRole === $neededRole || $this->hasHigherRole($currentRole, $neededRole);
    }

    /**
     * @param string $currentRole
     * @param string $neededRole
     * @return bool
     */
    private function hasHigherRole($currentRole, $neededRole)
    {
        foreach ($this->hierarchy as $parentRole => $childRole) {
            if ($currentRole === $parentRole) {
                $currentRole = $childRole;

                if ($childRole === $neededRole) {
                    return true;
                }
            }
        }

        return false;
    }
}
