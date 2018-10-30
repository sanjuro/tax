<?php

namespace App\Entity;

use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity
 * @ORM\Table(name="state")
 * @ORM\HasLifecycleCallbacks
 */
class State
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="title", type="string")
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(name="short_code", type="string")
     */
    private $short_code;

    /**
     * Many States have One Country.
     * @ManyToOne(targetEntity="Country", inversedBy="states")
     * @JoinColumn(name="country_id", referencedColumnName="id")
     */
    private $country;

    /**
     * One State has Many Counties.
     * @OneToMany(targetEntity="County", mappedBy="state")
     */
    private $counties;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updated_at;

    public function __construct() {
        $this->counties = new ArrayCollection();
    }

    /**
     * @ORM\PrePersist
     * @return void
     */
    public function onPrePersist(): void
    {
        $this->created_at = Carbon::now();
    }

    /**
     * @ORM\PreUpdate
     * @return void
     */
    public function onPreUpdate(): void
    {
        $this->updated_at = Carbon::now();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getShortCode(): string
    {
        return $this->short_code;
    }

    /**
     * @param string $short_code
     * @return void
     */
    public function setShortCode(string $short_code): void
    {
        $this->short_code = $short_code;
    }

    /**
     * @return Collection|County[]
     */
    public function getCounties(): Collection
    {
        return $this->counties;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updated_at;
    }
}