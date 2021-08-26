<?php
/**
 * dont forgot to add gedmo.listener.timestampable listener in service.yaml
 */

namespace App\Service\Generic\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

//needed
use Gedmo\Timestampable\Traits\TimestampableEntity;

trait EntityBaseTrait
{
    use TimestampableEntity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function refreshUpdatedAt()
    {
        $this->updatedAt = new \DateTime();
    }
}