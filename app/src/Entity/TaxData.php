<?php

namespace App\Entity;

use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * @ORM\Entity
 * @ORM\Table(name="tax_data")
 * @ORM\HasLifecycleCallbacks
 */
class TaxData
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="TaxData", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="TaxData", mappedBy="parent")
     */
    private $children;

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
     * @var decimal
     * @ORM\Column(name="total_amount", type="decimal", precision=20, scale=2)
     */
    private $total_amount;

    /**
     * @var decimal
     * @ORM\Column(name="average_total_amount", type="decimal", precision=20, scale=2)
     */
    private $average_total_amount;

    /**
     * @var decimal
     * @ORM\Column(name="average_rate", type="decimal", precision=4, scale=2)
     */
    private $average_rate;

    /**
     * @var \Date
     * @ORM\Column(name="period", type="date", nullable=false)
     */
    private $period;

    /**
     * @var string
     * @ORM\Column(name="entity_type", type="string")
     */
    private $entity_type;

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

    /**
     * @ORM\PrePersist
     * @return void
     */
    public function onPrePersist(): void
    {
        $this->average_total_amount = 0.00;
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

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param TaxData $parent
     * @return void
     */
    public function setParent(TaxData $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @return TaxData []
     */
    public function getChildren()
    {
        return $this->children;
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
     * @return float
     */
    public function getTotalAmount(): float
    {
        return $this->total_amount;
    }

    /**
     * @param float $total_amount
     * @return void
     */
    public function setTotalAmount(float $total_amount): void
    {
        $this->total_amount = $total_amount;
    }

    /**
     * @return float
     */
    public function getAverageTotalAmount(): float
    {
        return $this->average_total_amount;
    }

    /**
     * @param float $average_total_amount
     * @return void
     */
    public function setAverageTotalAmount(float $average_total_amount): void
    {
        $this->average_total_amount = $average_total_amount;
    }

    /**
     * @return float
     */
    public function getAverageRate(): float
    {
        return $this->average_rate;
    }

    /**
     * @param float $average_rate
     * @return void
     */
    public function setAverageRate(float $average_rate): void
    {
        $this->average_rate = $average_rate;
    }

    /**
     * @return string
     */
    public function getEntityType(): string
    {
        return $this->entity_type;
    }

    /**
     * @param string $entity_type
     * @return void
     */
    public function setEntityType(string $entity_type): void
    {
        $this->entity_type = $entity_type;
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
