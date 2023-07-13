<?php

namespace Phalcon\Models;

use Phalcon\Validation;

class Developpeur extends \Phalcon\Mvc\Model
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
     * @Column(column="competence", type="string", length='1','2','3', nullable=true)
     */
    protected $competence;

    /**
     *
     * @var integer
     * @Column(column="indice_production", type="integer", nullable=true)
     */
    protected $indice_production;

    /**
     *
     * @var string
     * @Column(column="composants", type="string", length=45, nullable=true)
     */
    protected $composants;

    /**
     *
     * @var string
     * @Column(column="modules", type="string", length=45, nullable=true)
     */
    protected $modules;

    /**
     *
     * @var string
     * @Column(column="applications", type="string", length=45, nullable=true)
     */
    protected $applications;

    /**
     *
     * @var integer
     * @Column(column="id_collaborateur", type="integer", nullable=true)
     */
    protected $id_collaborateur;

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
     * Method to set the value of field competence
     *
     * @param string $competence
     * @return $this
     */
    public function setCompetence($competence)
    {
        $this->competence = $competence;

        return $this;
    }

    /**
     * Method to set the value of field indice_production
     *
     * @param integer $indice_production
     * @return $this
     */
    public function setIndiceProduction($indice_production)
    {
        $this->indice_production = $indice_production;

        return $this;
    }

    /**
     * Method to set the value of field composants
     *
     * @param string $composants
     * @return $this
     */
    public function setComposants($composants)
    {
        $this->composants = $composants;

        return $this;
    }

    /**
     * Method to set the value of field modules
     *
     * @param string $modules
     * @return $this
     */
    public function setModules($modules)
    {
        $this->modules = $modules;

        return $this;
    }

    /**
     * Method to set the value of field applications
     *
     * @param string $applications
     * @return $this
     */
    public function setApplications($applications)
    {
        $this->applications = $applications;

        return $this;
    }

    /**
     * Method to set the value of field id_collaborateur
     *
     * @param integer $id_collaborateur
     * @return $this
     */
    public function setIdCollaborateur($id_collaborateur)
    {
        $this->id_collaborateur = $id_collaborateur;

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
     * Returns the value of field competence
     *
     * @return string
     */
    public function getCompetence()
    {
        return $this->competence;
    }

    /**
     * Returns the value of field indice_production
     *
     * @return integer
     */
    public function getIndiceProduction()
    {
        return $this->indice_production;
    }

    /**
     * Returns the value of field composants
     *
     * @return string
     */
    public function getComposants()
    {
        return $this->composants;
    }

    /**
     * Returns the value of field modules
     *
     * @return string
     */
    public function getModules()
    {
        return $this->modules;
    }

    /**
     * Returns the value of field applications
     *
     * @return string
     */
    public function getApplications()
    {
        return $this->applications;
    }

    /**
     * Returns the value of field id_collaborateur
     *
     * @return integer
     */
    public function getIdCollaborateur()
    {
        return $this->id_collaborateur;
    }

    const _COMPETENCE_1_FRONTEND_ = 1;
    const _COMPETENCE_2_BACKEND_ = 2;
    const _COMPETENCE_3_DATABASE_ = 3;

    /**
     * @return string
     */
    public function getCompetenceLibelle() {
        switch ($this->getCompetence()) {
            case self::_COMPETENCE_1_FRONTEND_ : return 'FRONTEND';
            case self::_COMPETENCE_2_BACKEND_ : return 'BACKEND';
            case self::_COMPETENCE_3_DATABASE_ : return 'DATABASE';
            default: return 'Compétence(s) inconnue(s)';

        }
    }

    /**
     * @return bool
     * Mecanisme de validation
     */
    public function validation() {
        $validator = new Validation();
        $validator->add('competence',
            new InclusionIn(
                [
                    'template' => 'Le champ :field doit avoir une valeur comprise entre 0 et 5 caractères',
                    'message' => 'Le champ :field doit avoir une valeur comprise entre 0 et 5 caractères',
                    'domain' => [
                        self::_COMPETENCE_1_FRONTEND_,
                        self::_COMPETENCE_2_BACKEND_,
                        self::_COMPETENCE_3_DATABASE_,
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
        $this->setSource("developpeur");
        $this->hasMany('id', 'Phalcon\Models\EquipeMembers', 'id_developpeur', ['alias' => 'EquipeMembers']);
        $this->belongsTo('id_collaborateur', 'Phalcon\Models\Collaborateur', 'id', ['alias' => 'Collaborateur']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Developpeur[]|Developpeur|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Developpeur|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
