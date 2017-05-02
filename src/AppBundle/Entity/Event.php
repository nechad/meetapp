<?php
/**
 * Created by PhpStorm.
 * User: rim
 * Date: 25/03/17
 * Time: 09:02
 */

namespace AppBundle\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Group;
use User;


/**
 * Class Event
 * @ApiResource
 * @ORM\Entity
 */

class Event
{

    /**
     * @var int
     *
     * @ORM\Column(type="integer", unique=true, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @ORM\Column(type="string", nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @Assert\Type(type="string")
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @var \DateTime
     * @Assert\Date
     * @Assert\NotNull
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $date_start;

    /**
     * @var \DateTime
     * @Assert\Date
     * @Assert\NotNull
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $date_end;


    /**
     *
     * @ORM\ManyToOne(targetEntity="MeetingGroup")
     */
    private $group;


    /**
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinTable(name="users_events",
     *      joinColumns={@ORM\JoinColumn(name="event_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     * )
     */
    private $participants;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->date_start;
    }

    /**
     * @param \DateTime $date_start
     */
    public function setDateStart($date_start)
    {
        $this->date_start = $date_start;
    }

    /**
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->date_end;
    }

    /**
     * @param \DateTime $date_end
     */
    public function setDateEnd($date_end)
    {
        $this->date_end = $date_end;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param mixed $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
    }

    /**
     * @return mixed
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * @param mixed $participants
     */
    public function setParticipants($participants)
    {
        $this->participants = $participants;
    }



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->participants = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add participant
     *
     * @param \AppBundle\Entity\User $participant
     *
     * @return Event
     */
    public function addParticipant(\AppBundle\Entity\User $participant)
    {
        $this->participants[] = $participant;

        return $this;
    }

    /**
     * Remove participant
     *
     * @param \AppBundle\Entity\User $participant
     */
    public function removeParticipant(\AppBundle\Entity\User $participant)
    {
        $this->participants->removeElement($participant);
    }
}
