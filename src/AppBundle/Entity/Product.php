<?php

// src/AppBundle/Entity/Product.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 * @ORM\Table(name="product")
 */
class Product {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @ORM\Column(type="text")
     */
    protected $longDescription;

    /**
     * @ORM\Column(type="text")
     */
    protected $specs;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    protected $isImportant;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media",cascade={"persist"})
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="picture", referencedColumnName="id")
     * })
     */
    private $picture;
    
    /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media",cascade={"persist"})
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="catalogue", referencedColumnName="id")
     * })
     */
    private $catalogue;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Product
     */
    public function setCategory(\AppBundle\Entity\Category $category = null) {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set longDescription
     *
     * @param string $longDescription
     *
     * @return Product
     */
    public function setLongDescription($longDescription) {
        $this->longDescription = $longDescription;

        return $this;
    }

    /**
     * Get longDescription
     *
     * @return string
     */
    public function getLongDescription() {
        return $this->longDescription;
    }

    /**
     * Set specs
     *
     * @param string $specs
     *
     * @return Product
     */
    public function setSpecs($specs) {
        $this->specs = $specs;

        return $this;
    }

    /**
     * Get longDescription
     *
     * @return string
     */
    public function getSpecs() {
        return $this->specs;
    }

    /**
     * 
     * @param type $isImportant
     */
    public function setIsImportant($isImportant) {
        $this->isImportant = $isImportant;
    }

    /**
     * 
     * @return type
     */
    public function getIsImportant() {
        return $this->isImportant;
    }

    /**
     * Set picture
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $picture
     *
     * @return Product
     */
    public function setPicture(\Application\Sonata\MediaBundle\Entity\Media $picture = null) {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getPicture() {
        return $this->picture;
    }
    
      /**
     * Set catalogue
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $catalogue
     *
     * @return Product
     */
    public function setCatalogue(\Application\Sonata\MediaBundle\Entity\Media $catalogue = null) {
        $this->catalogue = $catalogue;

        return $this;
    }

    /**
     * Get catalogue
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getCatalogue() {
        return $this->catalogue;
    }

}
