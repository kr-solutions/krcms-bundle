<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

/**
 * File interface
 */
interface FileInterface
{

    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return FileInterface
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return FileInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return FileInterface
     */
    public function setUpdatedAt($updatedAt);

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * Set uri
     *
     * @param string $uri
     *
     * @return FileInterface
     */
    public function setUri($uri);

    /**
     * Get uri
     *
     * @return string
     */
    public function getUri();

    /**
     * Set title
     *
     * @param string $title
     *
     * @return FileInterface
     */
    public function setTitle($title);

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set description
     *
     * @param string $description
     *
     * @return FileInterface
     */
    public function setDescription($description);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set page
     *
     * @param PageInterface $page
     *
     * @return FileInterface
     */
    public function setPage(PageInterface $page);

    /**
     * Get page
     *
     * @return PageInterface
     */
    public function getPage();

    /**
     * Set orderId
     *
     * @param integer $orderId
     *
     * @return FileInterface
     */
    public function setOrderId($orderId);

    /**
     * Get orderId
     *
     * @return integer
     */
    public function getOrderId();

    /**
     * File title
     *
     * @return string
     */
    public function __toString();
}
