<?php


namespace App\Helper\Orm;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\UuidV4;

/**
 * Trait IdTrait.
 */
trait IdTrait
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    protected ?int $id = null;

    /**
     * @var UuidV4
     * @ORM\Column(type="uuid", unique=true)
     */
    private UuidV4 $uuid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): UuidV4
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = UuidV4::fromString($uuid);

        return $this;
    }

    public function clearId(): self
    {
        $this->id = null;

        return $this;
    }
}