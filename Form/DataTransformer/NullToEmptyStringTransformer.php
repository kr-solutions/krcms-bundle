<?php

namespace KRSolutions\Bundle\KRCMSBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

/**
 * Transforms an empty string to a null value
 */
class NullToEmptyStringTransformer implements DataTransformerInterface
{

    /**
     * Transforms an empty string to a null value
     *
     * @param string $text
     *
     * @return string|null
     */
    public function transform($text)
    {
        if (null === $text) {
            return '';
        }

        return $text;
    }

    /**
     * Transforms a null value to an empty string ''
     *
     * @param string|null $text
     *
     * @return string
     */
    public function reverseTransform($text)
    {
        if ('' === $text) {
            return null;
        }

        return $text;
    }
}
