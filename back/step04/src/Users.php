<?php

use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\OneToOne(targetEntity=Address::class, fetch="EAGER" ,cascade={"persist", "remove"})
     */
    public $address;

    /**
     * @var ArrayCollection $applications
     * @ORM\OneToMany(targetEntity=Applications::class, mappedBy="applyant")
     */
    public $applications;

    /**
     * @ORM\Column(type="integer", length=1)
     */
    public $type;


    public function __construct()
    {
        $this->applications = new ArrayCollection();
    }

    public function addApplications(Applications $application) {
        $application->setApplyant($this);

        if(!$this->applications->contains($application)) {
            $this->applications->add($application);
        }
    }

    public function getApplications() {
        
        return $this->applications->getValues();
    }

}