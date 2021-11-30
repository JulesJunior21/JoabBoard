<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class Users
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    public $firstname;

    /**
     * @ORM\Column(type="string", length=100)
     */
    public $lastname;

    /**
     * @ORM\Column(type="string", length=100)
     */
    public $email;

    /**
     * @ORM\Column(type="string", length=20)
     */
    public $phone;

    /**
     * @ORM\ManyToOne(targetEntity="Address")
     */
    public $address;

    /**
     * @ORM\Column(type="integer", length=1)
     */
    public $type;

}