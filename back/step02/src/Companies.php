<?php

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="companies")
 */
class Companies
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
    public $name;

    /**
     * @ORM\Column(type="text")
     */
    public $activity;

    /**
     * @ORM\Column(type="text")
     */
    public $description;

    /**
     * @ORM\ManyToOne(targetEntity="Address")
     */
    public $address;

    /**
     * @ORM\Column(type="boolean")
     */
    public $state;

}