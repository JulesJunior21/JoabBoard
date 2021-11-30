<?php

use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\Column(type="string")
     */
    public $email;

    /**
     * @ORM\Column(type="string")
     */
    public $phone;

    /**
     * @ORM\Column(type="text")
     */
    public $activity;

    /**
     * @ORM\Column(type="text")
     */
    public $description;

    /**
     * @ORM\OneToOne(targetEntity=Address::class, fetch="EAGER", cascade={"persist", "remove"})
     */
    public $address;

    /**
     * @ORM\Column(type="boolean")
     */
    public $state;

    /**
     * @ORM\OneToMany(targetEntity=Advertisements::class, fetch="EAGER", cascade={"persist","remove"}, mappedBy="company")
     */
    public $advertisements;

    public function __construct()
    {
        $this->advertisements = new ArrayCollection();
    }

    public function addAdvertisements(Advertisements $advertisements) {
        $advertisements->setCompany($this);

        if(!$this->advertisements->contains($advertisements)){

            $this->advertisements->add($advertisements);
        }
    }

    



    /**
     * Get the value of advertisements
     */ 
    public function getAdvertisements()
    {
        return $this->advertisements->getValues();
    }
}