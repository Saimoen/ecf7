<?php

namespace Phalcon\Models;

use Phalcon\Validation;

class Collaborateur extends \Phalcon\Mvc\Model
{

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
     * @Column(column="nom", type="string", length=45, nullable=true)
     */
    protected $nom;

    /**
     *
     * @var string
     * @Column(column="prenom", type="string", length=45, nullable=true)
     */
    protected $prenom;

    /**
     *
     * @var string
     * @Column(column="niveau_competence", type="string", length='1','2','3', nullable=true)
     */
    protected $niveau_competence;

    /**
     *
     * @var string
     * @Column(column="prime_embauche", type="string", length=45, nullable=true)
     */
    protected $prime_embauche;

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
     * Method to set the value of field nom
     *
     * @param string $nom
     * @return $this
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Method to set the value of field prenom
     *
     * @param string $prenom
     * @return $this
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Method to set the value of field niveau_competence
     *
     * @param string $niveau_competence
     * @return $this
     */
    public function setNiveauCompetence($niveau_competence)
    {
        $this->niveau_competence = $niveau_competence;

        return $this;
    }

    /**
     * Method to set the value of field prime_embauche
     *
     * @param string $prime_embauche
     * @return $this
     */
    public function setPrimeEmbauche($prime_embauche)
    {
        $this->prime_embauche = $prime_embauche;

        return $this;
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
     * Returns the value of field nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Returns the value of field prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Returns the value of field niveau_competence
     *
     * @return string
     */
    public function getNiveauCompetence()
    {
        return $this->niveau_competence;
    }

    /**
     * Returns the value of field prime_embauche
     *
     * @return string
     */
    public function getPrimeEmbauche()
    {
        return $this->prime_embauche;
    }

    const _NIVEAU_COMPETENCE_1_STAGIAIRE_ = 1;
    const _NIVEAU_COMPETENCE_2_JUNIOR_ = 2;
    const _NIVEAU_COMPETENCE_3_SENIOR_ = 3;

    public function getNiveauCompetenceLibelle() {
        switch ($this->getNiveauCompetence()) {
            case self::_NIVEAU_COMPETENCE_1_STAGIAIRE_ : return 'STAGIAIRE';
            case self::_NIVEAU_COMPETENCE_2_JUNIOR_ : return 'JUNIOR';
            case self::_NIVEAU_COMPETENCE_3_SENIOR_ : return 'SENIOR';
            default: return 'Niveau de compétence inconnu';

        }
    }

// Mecanisme de validation
    public function validation() {
        $validator = new Validation();
        $validator->add('niveau_competence',
            new Validation\Validator\InclusionIn(
                [
                    'template' => 'Le champ :field doit avoir une valeur comprise entre 0 et 5 caractères',
                    'message' => 'Le champ :field doit avoir une valeur comprise entre 0 et 5 caractères',
                    'domain' => [
                        self::_NIVEAU_COMPETENCE_1_STAGIAIRE_,
                        self::_NIVEAU_COMPETENCE_2_JUNIOR_,
                        self::_NIVEAU_COMPETENCE_3_SENIOR_
                    ]
                ]
            )
        );
        return $this->validate($validator);
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("webappsaler");
        $this->setSource("collaborateur");
        $this->hasMany('id', 'Phalcon\Models\Chefdeprojet', 'id_collaborateur', ['alias' => 'Chefdeprojet']);
        $this->hasMany('id', 'Phalcon\Models\Developpeur', 'id_collaborateur', ['alias' => 'Developpeur']);
    }



    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Collaborateur[]|Collaborateur|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Collaborateur|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
