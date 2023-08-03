<?php

namespace Phalcon\Models;

class Equipe extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Column(column="idChef", type="integer", nullable=true)
     */
    protected $idChef;

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="id", type="integer", nullable=false)
     */
    protected $id;

    /**
     *
     * @var string
     * @Column(column="libelle", type="string", length=45, nullable=true)
     */
    protected $libelle;

    protected $name;
    /**
     * Method to set the value of field idChef
     *
     * @param integer $idChef
     * @return $this
     */
    public function setIdChef($idChef)
    {
        $this->idChef = $idChef;

        return $this;
    }

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field libelle
     *
     * @param string $libelle
     * @return $this
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function setName($name)
    {
        $this->libelle = $name;

        return $this;
    }

    /**
     * Returns the value of field idChef
     *
     * @return integer
     */
    public function getIdChef()
    {
        return $this->idChef;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    public function getName()
    {
        return $this->name;
    }



    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("webappsaler");
        $this->setSource("equipe");
        $this->hasMany('idChef', 'Phalcon\Models\EquipeMembers', 'id', ['alias' => 'EquipeMembers']);
        $this->belongsTo('idChef', 'Phalcon\Models\Chefdeprojet', 'id', ['alias' => 'Chefdeprojet']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Equipe[]|Equipe|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Equipe|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
