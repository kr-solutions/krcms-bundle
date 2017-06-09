<?php

namespace KRSolutions\Bundle\KRCMSBundle\Model;

use Doctrine\ORM\QueryBuilder;
use KRSolutions\Bundle\KRCMSBundle\Entity\CategoryInterface;

/**
 * Category manager interface
 */
interface CategoryManagerInterface
{

    /**
     * Create a new category
     *
     * @return CategoryInterface
     */
    public function createCategory();

    /**
     * Returns the category's fully qualified class name.
     *
     * @return string
     */
    public function getClass();

    /**
     * Get all categories
     *
     * @return array
     */
    public function findAll();

    /**
     * Get all Category entities
     *
     * @return array
     */
    public function getAllCategories();

    /**
     * Get Category Entity by id
     *
     * @param integer $categoryId
     *
     * @return CategoryInterface
     */
    public function getCategoryById($categoryId);

    /**
     * Get Category Entity by name
     *
     * @param string $categoryName
     *
     * @return CategoryInterface
     */
    public function getCategoryByName($categoryName);

    /**
     * Get Categoties
     *
     * @return QueryBuilder
     */
    public function getCategoriesQB();
}
