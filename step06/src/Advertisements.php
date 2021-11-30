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
     * @ORM\Column(type="text")
     */
    public $content;

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
     * @ORM\OneToMany(targetEntity=Applications::class, fetch="EAGER" ,mappedBy="advertisements", cascade={"remove"})
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


    public function json_serializer() {
        return array(
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "content" => $this->content,
            "creatAt" => $this->creatAt,
            "modifiedAt" => $this->modifiedAt,
            "company" => $this->company,
            "applications" => $this->applications->toArray()
        );
    }

    }
