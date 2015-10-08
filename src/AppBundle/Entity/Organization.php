<?php

/*
 * This file is part of the Truckee\Match package.
 * 
 * (c) George W. Brooks
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AppAssert;

/**
 * Organization
 *
 * @ORM\Table(name="organization")
 * @ORM\Entity
 * @UniqueEntity("orgName", message="Organization already exists")
 */
class Organization
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="orgName", type="string", length=65, nullable=true)
     * @Assert\NotBlank(message="Organization name is required")
     */
    protected $orgName;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=50, nullable=true)
     */
    protected $address;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=50, nullable=true)
     */
    protected $city;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=50, nullable=true)
     */
    protected $state;

    /**
     * @var string
     *
     * @ORM\Column(name="zip", type="string", length=10, nullable=true)
     */
    protected $zip;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=50, nullable=true)
     * @AppAssert\PhoneNumber
     */
    protected $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=50, nullable=true)
     */
    protected $website;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    protected $active;

    /**
     * @var boolean
     *
     * @ORM\Column(name="temp", type="boolean", nullable=false)
     */
    protected $temp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="add_date", type="datetime", nullable=true)
     */
    protected $addDate;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Opportunity", mappedBy="organization", cascade={"persist","remove"})
     */
    protected $opportunities;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Search", mappedBy="organization", cascade={"persist","remove","merge"})
     */
    protected $searches;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Staff", mappedBy="organization", cascade={"persist","remove","merge"})
     */
    protected $staff;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Focus", inversedBy="organizations", cascade={"persist"})
     * @ORM\JoinTable(name="org_focus",
     *      joinColumns={@ORM\JoinColumn(name="orgId", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="focusId", referencedColumnName="id")}
     *      ))
     * @Assert\NotNull(message="Please select at least one")
     */
    protected $focuses;
    
    /**
     *  @ORM\Column(name="background", type="boolean", nullable=true)
     */
    protected $background;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->opportunities = new ArrayCollection();
        $this->staff = new ArrayCollection();
        $this->searches = new ArrayCollection();
        $this->focuses = new ArrayCollection();
        $this->active = true;
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
     * Set organization
     *
     * @param string $organization
     * @return Organization
     */
    public function setOrgName($name)
    {
        $this->orgName = $name;
    
        return $this;
    }

    /**
     * Get organization
     *
     * @return string 
     */
    public function getOrgName()
    {
        return $this->orgName;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Organization
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Organization
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Organization
     */
    public function setState($state)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set zip
     *
     * @param string $zip
     * @return Organization
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    
        return $this;
    }

    /**
     * Get zip
     *
     * @return string 
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Organization
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return Organization
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    
        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Organization
     */
    public function setActive($active)
    {
        $this->active = $active;
    
        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set temp
     *
     * @param boolean $temp
     * @return Organization
     */
    public function setTemp($temp)
    {
        $this->temp = $temp;
    
    }

    /**
     * Get temp
     *
     * @return boolean 
     */
    public function getTemp()
    {
        return $this->temp;
    }

    /**
     * Set addDate
     *
     * @param \DateTime $addDate
     * @return Organization
     */
    public function setAddDate($addDate)
    {
        $this->addDate = $addDate;
    
        return $this;
    }

    /**
     * Get addDate
     *
     * @return \DateTime 
     */
    public function getAddDate()
    {
        return $this->addDate;
    }

    /**
     * Add opportunities
     *
     * @param \AppBundle\Entity\Opportunity $opportunities
     * @return Organization
     */
    public function addOpportunity(\AppBundle\Entity\Opportunity $opportunity)
    {
        $this->opportunities[] = $opportunity;
    
        return $this;
    }

    /**
     * Remove opportunities
     *
     * @param \AppBundle\Entity\Opportunity $opportunities
     */
    public function removeOpportunity(\AppBundle\Entity\Opportunity $opportunity)
    {
        $this->opportunities->removeElement($opportunity);
    }

    /**
     * Get opportunities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOpportunities()
    {
        return $this->opportunities;
    }

    public function getStaff()
    {
        return $this->staff;
    }

    /**
     * Add search
     *
     * @param \AppBundle\Entity\Search $search
     * @return Organization
     */
    public function addSearch(\AppBundle\Entity\Search $search)
    {
        $this->searches[] = $search;
    
        return $this;
    }

    /**
     * Remove search
     *
     * @param \AppBundle\Entity\Search $search
     */
    public function removeSearch(\AppBundle\Entity\Search $search)
    {
        $this->searches->removeElement($search);
    }

    /**
     * Get search
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * Add focuses
     *
     * @param \AppBundle\Entity\Focus $focuses
     * @return Organization
     */
    public function addFocus(\AppBundle\Entity\Focus $focus)
    {
        $this->focuses[] = $focus;
    
        return $this;
    }

    /**
     * Remove focuses
     *
     * @param \AppBundle\Entity\Focus $focuses
     */
    public function removeFocus(\AppBundle\Entity\Focus $focus)
    {
        $this->focuses->removeElement($focus);
    }

    /**
     * Get focuses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFocuses()
    {
        return $this->focuses;
    }

    /**
     * @var boolean
     *
     * @ORM\Column(name="email", type="string", nullable=true)
     */
    protected $email;

    /**
     * Set email
     *
     * @param boolean $email
     * @return email
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return boolean 
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @var boolean
     *
     * @ORM\Column(name="areacode", type="integer", nullable=true)
     * @AppAssert\AreaCode
     */
    protected $areacode;

    /**
     * Set areacode
     *
     * @param $areacode
     * @return areacode
     */
    public function setAreacode($areacode) {
        $this->areacode = $areacode;

        return $this;
    }

    /**
     * Get areacode
     *
     * @return boolean 
     */
    public function getAreacode() {
        return $this->areacode;
    }

    /**
     * Set background
     *
     * @param $background
     * @return background
     */
    public function setBackground($background) {
        $this->background = $background;

        return $this;
    }

    /**
     * Get background
     *
     * @return boolean 
     */
    public function getBackground() {
        return $this->background;
    }
}