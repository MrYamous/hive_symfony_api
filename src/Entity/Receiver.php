<?php

namespace App\Entity;

use App\Repository\ReceiverRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=ReceiverRepository::class)
 */
class Receiver
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $lastname;

    /**
     * @ORM\Column(type="string", length=2)
     */
    public $countryCode;

    public function __construct(Uuid $id, string $firstname, string $lastname, string $countryCode)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->countryCode = $countryCode;
    }
}
