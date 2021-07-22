<?php


declare(strict_types=1);

namespace App\Helper\Orm;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Trait LibelleTrait.
 */
trait LibelleTrait
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $libelle = null;

    /**
     * @Gedmo\Slug(fields={"libelle"})
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private ?string $slug;

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }
}