<?php

namespace KRSolutions\Bundle\KRCMSBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

/**
 * Transforms an empty string to a null value
 */
class NullToEmptyNumberTransformer implements DataTransformerInterface
{

    /**
     * Transforms an empty string to a null value
     *
     * @param string $number
     *
     * @return string|null
     */
    public function transform($number)
    {
        if (0 === intval($number)) {
            return null;
        }

        return $number;
    }

    /**
     * Transforms a null value to an empty string ''
     *
     * @param string|int $number
     *
     * @return string
     */
    public function reverseTransform($number)
    {
        if (0 === intval($number)) {
            return '';
        }

        return $number;
    }
}
