<?php

namespace SNicholson\IPFO\Parties;

abstract class PartyMember implements PartyMemberInterface
{
    protected $sequence;
    protected $name;
    protected $reference;
    protected $email;
    protected $phone;
    protected $fax;
    /** @var PartyMemberAddress */
    protected $address;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param mixed $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param mixed $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * @return PartyMemberAddress
     */
    public function getAddress()
    {
        if (is_null($this->address)) {
            $this->address = new PartyMemberAddress();
        }
        return $this->address;
    }

    /**
     * @param PartyMemberAddress $address
     */
    public function setAddress(PartyMemberAddress $address)
    {
        $this->address = $address;
    }

    public function toArray()
    {
        return [
            'name'      => $this->getName(),
            'sequence'  => $this->getSequence(),
            'reference' => $this->getReference(),
            'email'     => $this->getEmail(),
            'phone'     => $this->getPhone(),
            'fax'       => $this->getFax(),
            'address'   => $this->getAddress()->toArray(),
        ];
    }

    public function setSequence($sequence)
    {
        $this->sequence = $sequence;
    }

    public function getSequence()
    {
        return $this->sequence;
    }
}