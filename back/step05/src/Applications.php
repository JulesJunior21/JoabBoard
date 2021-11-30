<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="applications", uniqueConstraints={@ORM\UniqueConstraint(name="user_poll_unique", columns={"applyant_id", "advertisements_id"})})
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
     * @ORM\Column(type="text")
     */
    public $message;

    /**
     * @ORM\Column(type="datetime")
     */
    public $date;
    
    /**
     * @ORM\ManyToOne(targetEntity=Users::class, fetch="EAGER" ,inversedBy="applications")
     */
    public $applyant;


    /**
     * @ORM\ManyToOne(targetEntity=Advertisements::class, fetch="EAGER" ,inversedBy="applications")
     */
    public $advertisements;

    

    public function setApplyant(Users $users) {

        $this->applyant = $users;
    }

    public function setAdvertisements(Advertisements $advertisements) {

        $this->advertisements = $advertisements;
        
    }

}