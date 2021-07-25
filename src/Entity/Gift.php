<?php

namespace App\Entity;

use App\Repository\GiftRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=GiftRepository::class)
 */
class Gift
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $description;

    /**
     * @ORM\Column(type="float")
     */
    public $price;

    /**
     * @ORM\OneToOne(targetEntity=Receiver::class, inversedBy="gift", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    public $receiver;

    public function __construct(Uuid $id, string $code, string $description, float $price, Receiver $receiver)
    {
        $this->id = $id;
        $this->code = $code;
        $this->description = $description;
        $this->price = $price;
        $this->receiver = $receiver;
    }
}
