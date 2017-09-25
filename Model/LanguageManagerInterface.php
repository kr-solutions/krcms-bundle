<?php

namespace KRSolutions\Bundle\KRCMSBundle\Model;

use Doctrine\ORM\QueryBuilder;
use KRSolutions\Bundle\KRCMSBundle\Entity\LanguageInterface;

/**
 * Language manager interface
 */
interface LanguageManagerInterface
{

    /**
     * Create a new language
     *
     * @return LanguageInterface
     */
    public function createLanguage();

    /**
     * Returns the languages fully qualified class name.
     *
     * @return string
     */
    public function getClass();

    /**
     * Get all languages
     *
     * @return array
     */
    public function findAll();

    /**
     * Get all Languages
     *
     * @return array
     */
    public function getAllLanguages();

    /**
     * Get Language Entity by id
     *
     * @param integer $languageId
     *
     * @return LanguageInterface
     */
    public function getLanguageById($languageId);

    /**
     * Get Languages
     *
     * @return QueryBuilder
     */
    public function getLanguagesQB();
}
