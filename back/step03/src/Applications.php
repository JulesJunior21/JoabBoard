<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="applications")
 */
class Applications
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="date")
     */
    public $date;


    /**
     * @ORM\ManyToOne(targetEntity="Users")
     */
    public $applyant;


    /**
     * @ORM\ManyToOne(targetEntity="Advertisements")
     */
    public $advertisements;


    /**
     * @ORM\ManyToOne(targetEntity="Companies")
     */
    public $companies;

}