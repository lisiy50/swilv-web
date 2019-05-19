<?php
namespace App\EventListener\Doctrine;

use App\Entity\SchoolClass;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping\PrePersist;

/**
 * Class SchoolClassListener
 * @package App\EventListener\Doctrine
 *
 * @link https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/events.html#entity-listeners
 */
class SchoolClassListener {

    /**
     * @PrePersist
     *
     * @param SchoolClass $schoolClass
     * @param LifecycleEventArgs $event
     *
     * @throws \Exception
     */
    public function prePersistHandler(SchoolClass $schoolClass, LifecycleEventArgs $event)
    {
        if (!$schoolClass->getId()) {
            $schoolClass->setCreatedAt(new \DateTime());
        }
    }

}