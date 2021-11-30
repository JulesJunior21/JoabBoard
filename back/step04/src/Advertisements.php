<?php

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="advertisements")
 */
class Advertisements {


    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $id;


    /**
     * @ORM\Column(type="string")
     */
    public $title;


    /**
     * @ORM\Column(type="text")
     */
    public $description;


    /**
     * @ORM\Column(type="integer")
     */
    public $salary;

    /**
     * @ORM\Column(type="integer")
     */
    public $duration;


    /**
     * @ORM\Column(type="text")
     */
    public $objectives;


    /**
     * @ORM\Column(type="text")
     */
    public $responsabilities;


    /**
     * @ORM\Column(type="text")
     */
    public $requirements;

    /**
     * @ORM\Column(type="boolean")
     */
    public $state;

    /**
     * @ORM\Column(type="datetime")
     */
    public $creatAt;

    /**
     * @ORM\Column(type="datetime")
     */
    public $modifiedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Companies::class, fetch="EAGER", inversedBy="advertisements")
     */
    public $company;

    /**
     * @var ArrayCollection $applications
     * @ORM\OneToMany(targetEntity=Applications::class, mappedBy="advertisements")
     */
    public $applications;


    public function __construct()
    {
        $this->applications = new ArrayCollection();
    }

    public function addApplications(Applications $applications) {

        $applications->setAdvertisements($this);

        if(!$this->applications->contains($applications)) {
            $this->applications->add($applications);
        }
    }

    public function setCompany(Companies $company)
    {
        $this->company = $company;
    }
    }
 
?>