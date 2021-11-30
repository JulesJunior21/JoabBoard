<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="address")
 */
class Address
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
    public $street;

    /**
     * @ORM\Column(type="string", length=100)
     */
    public $city;

    /**
     * @ORM\Column(type="string", length=100)
     */
    public $state;

    /**
     * @ORM\Column(type="integer")
     */
    public $postalcode;

    /**
     * @ORM\Column(type="string", length=10)
     */
    public $country;
}