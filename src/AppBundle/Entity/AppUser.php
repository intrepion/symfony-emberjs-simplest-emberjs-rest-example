<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * AppUser
 *
 * @ORM\Table(name="app_user")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\AppUserRepository")
 */
class AppUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="screen_name", type="string", length=255)
     */
    private $screenName;

    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="appUser")
     **/
    private $message;


    public function __construct()
    {
        $this->message = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set screenName
     *
     * @param string $screenName
     * @return User
     */
    public function setScreenName($screenName)
    {
        $this->screenName = $screenName;

        return $this;
    }

    /**
     * Get screenName
     *
     * @return string 
     */
    public function getScreenName()
    {
        return $this->screenName;
    }

    /**
     * Add message
     *
     * @param \AppBundle\Entity\Message $message
     * @return AppUser
     */
    public function addMessage(\AppBundle\Entity\Message $message)
    {
        $this->message[] = $message;

        return $this;
    }

    /**
     * Remove message
     *
     * @param \AppBundle\Entity\Message $message
     */
    public function removeMessage(\AppBundle\Entity\Message $message)
    {
        $this->message->removeElement($message);
    }

    /**
     * Get message
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMessage()
    {
        return $this->message;
    }
}
