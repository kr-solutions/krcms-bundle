<?php

namespace KRSolutions\Bundle\KRCMSBundle\TwigExtension;

use Twig_Extension;
use Twig_Filter_Method;


/**
 * Take a short extract from a text
 */
class ExcerptTwigExtension extends Twig_Extension
{

	/**
	 * Get filters
	 *
	 * @return array
	 */
	public function getFilters()
	{
		return array(
			'excerpt' => new Twig_Filter_Method($this, 'excerpt'),
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
	public function excerpt($text, $wordsreturned, $textAfterShorten = ' ...')
	{
		$strippedText = strip_tags($text);
		$retval = $strippedText;

		$explodedText = explode(" ", $strippedText);
		if (count($explodedText) <= $wordsreturned) {
			$retval = $strippedText;
		} else {
			array_splice($explodedText, $wordsreturned);
			$retval = implode(" ", $explodedText) . $textAfterShorten;
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
