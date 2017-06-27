<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUSer;

/**
 * Class User
 * @ORM\Entity
 * @package AppBundle\Entity
 * @ORM\Table(name="User")
 */
class User extends BaseUSer
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Bonobo", cascade={"persist"})
     */
    protected $bonobos;

    /**
     * Add bonobo
     *
     * @param \AppBundle\Entity\Bonobo $bonobo
     *
     * @return User
     */
    public function addBonobo(\AppBundle\Entity\Bonobo $bonobo)
    {
        $this->bonobos[] = $bonobo;

        return $this;
    }

    /**
     * Remove bonobo
     *
     * @param \AppBundle\Entity\Bonobo $bonobo
     */
    public function removeBonobo(\AppBundle\Entity\Bonobo $bonobo)
    {
        $this->bonobos->removeElement($bonobo);
    }

    /**
     * Get bonobos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBonobos()
    {
        return $this->bonobos;
    }
}
