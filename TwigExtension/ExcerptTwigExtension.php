<?php

namespace KRSolutions\Bundle\KRCMSBundle\TwigExtension;

/**
 * Take a short extract from a text
 */
class ExcerptTwigExtension extends \Twig_Extension
{

    /**
     * Get filters
     *
     * @return array
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('excerpt', array($this, 'excerptFilter')),
        );
    }

    /**
     * Excerpt long text
     *
     * @param string $text             Text to shorten
     * @param int    $wordsreturned    Number of words to be returned
     * @param string $textAfterShorten Text to put after the shortened text
     *
     * @return string
     */
    public function excerptFilter($text, $wordsreturned, $textAfterShorten = ' ...')
    {
        $strippedText = strip_tags($text);
        $retval = $strippedText;

        $explodedText = explode(" ", $strippedText);
        if (count($explodedText) <= $wordsreturned) {
            $retval = $strippedText;
        } else {
            array_splice($explodedText, $wordsreturned);
            $retval = implode(" ", $explodedText).$textAfterShorten;
        }

        return $retval;
    }

    /**
     * Get name of twig extension
     *
     * @return string
     */
    public function getName()
    {
        return 'kr_solutions_krcms.excerpt_twig_extension';
    }
}
