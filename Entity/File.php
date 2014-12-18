<?php

namespace KRSolutions\Bundle\KRCMSBundle\Entity;

use DateTime;
use KRSolutions\Bundle\KRUserBundle\Entity\User;


/**
 * File
 */
class File
{

	/**
	 * @var integer
	 */
	private $id;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var DateTime
	 */
	private $createdAt;

	/**
	 * @var DateTime
	 */
	private $updatedAt;

	/**
	 * @var string
	 */
	private $uri;

	/**
	 * @var string
	 */
	private $title;

	/**
	 * @var string
	 */
	private $description;

	/**
	 * @var integer
	 */
	private $orderId;

	/**
	 * @var User
	 */
	private $createdBy;

	/**
	 * @var User
	 */
	private $updatedBy;

	/**
	 * @var Page
	 */
	private $page;

	/**
	 * File constructor
	 */
	public function __construct()
	{
		$this->createdAt = new \DateTime('now');
		$this->updatedAt = new \DateTime('now');
		$this->orderId = 0;
	}

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set name
	 *
	 * @param string $name
	 *
	 * @return File
	 */
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set createdAt
	 *
	 * @param DateTime $createdAt
	 *
	 * @return File
	 */
	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;

		return $this;
	}

	/**
	 * Get createdAt
	 *
	 * @return DateTime
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	/**
	 * Set updatedAt
	 *
	 * @param DateTime $updatedAt
	 *
	 * @return File
	 */
	public function setUpdatedAt($updatedAt)
	{
		$this->updatedAt = $updatedAt;

		return $this;
	}

	/**
	 * Get updatedAt
	 *
	 * @return DateTime
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}

	/**
	 * Set uri
	 *
	 * @param string $uri
	 *
	 * @return File
	 */
	public function setUri($uri)
	{
		$this->uri = $uri;

		return $this;
	}

	/**
	 * Get uri
	 *
	 * @return string
	 */
	public function getUri()
	{
		return $this->uri;
	}

	/**
	 * Set title
	 *
	 * @param string $title
	 *
	 * @return File
	 */
	public function setTitle($title)
	{
		$this->title = $title;

		return $this;
	}

	/**
	 * Get title
	 *
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Set description
	 *
	 * @param string $description
	 *
	 * @return File
	 */
	public function setDescription($description)
	{
		$this->description = $description;

		return $this;
	}

	/**
	 * Get description
	 *
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Set orderId
	 *
	 * @param integer $orderId
	 *
	 * @return File
	 */
	public function setOrderId($orderId)
	{
		$this->orderId = $orderId;

		return $this;
	}

	/**
	 * Get orderId
	 *
	 * @return integer
	 */
	public function getOrderId()
	{
		return $this->orderId;
	}

	/**
	 * Set createdBy
	 *
	 * @param User $createdBy
	 *
	 * @return File
	 */
	public function setCreatedBy(User $createdBy = null)
	{
		$this->createdBy = $createdBy;

		return $this;
	}

	/**
	 * Get createdBy
	 *
	 * @return User
	 */
	public function getCreatedBy()
	{
		return $this->createdBy;
	}

	/**
	 * Set updatedBy
	 *
	 * @param User $updatedBy
	 *
	 * @return File
	 */
	public function setUpdatedBy(User $updatedBy = null)
	{
		$this->updatedBy = $updatedBy;

		return $this;
	}

	/**
	 * Get updatedBy
	 *
	 * @return User
	 */
	public function getUpdatedBy()
	{
		return $this->updatedBy;
	}

	/**
	 * Set page
	 *
	 * @param Page $page
	 *
	 * @return File
	 */
	public function setPage(Page $page = null)
	{
		$this->page = $page;

		return $this;
	}

	/**
	 * Get page
	 *
	 * @return Page
	 */
	public function getPage()
	{
		return $this->page;
	}

	/**
	 * Resize the image
	 *
	 * @param int    $maxWidth  Maximum width of image
	 * @param int    $maxHeight Maximum height of image
	 * @param string $uploadDir Upload directory
	 *
	 * @return string
	 */
	public function resize($maxWidth, $maxHeight, $uploadDir = 'uploads')
	{
		$srcImage = dirname(__FILE__) . '/../../../../web/' . $uploadDir . $this->uri;
		$image = null;

		if (!file_exists($srcImage)) {
			return $this->uri;
		}

		$resizeDir = dirname(__FILE__) . '/../../../../web/' . $uploadDir . '/_resized';

		// Set the maximum height and width
		$width = $maxWidth;
		$height = $maxHeight;

		// Get new dimensions
		list($widthOrig, $heightOrig) = getimagesize($srcImage);

		$ratioOrig = $widthOrig / $heightOrig;

		if ($width / $height > $ratioOrig) {
			$width = ceil($height * $ratioOrig);
			$dirByRatio = 'm' . $width;
		} else {
			$height = ceil($width / $ratioOrig);
			$dirByRatio = 'h' . $height;
		}

		$thumbDir = $resizeDir . '/' . $dirByRatio;

		$fileDir = $thumbDir . dirname($this->uri);
		if (!file_exists($fileDir)) {
			mkdir($fileDir, 0755, true);
		}
		$destImage = $thumbDir . $this->uri;
		$destImageUrl = '/_resized/' . $dirByRatio . $this->uri;

		if (file_exists($destImage)) {
			return $destImageUrl;
		}

		$imageInfo = getimagesize($srcImage);
		$imageType = $imageInfo[2];

		if ($imageType == IMAGETYPE_JPEG) {
			$image = imagecreatefromjpeg($srcImage);
		} elseif ($imageType == IMAGETYPE_GIF) {
			$image = imagecreatefromgif($srcImage);
		} elseif ($imageType == IMAGETYPE_PNG) {
			$image = imagecreatefrompng($srcImage);
		}

		// Resample
		$imageP = imagecreatetruecolor($width, $height);

		// saving resampled image
		if ($imageType == IMAGETYPE_JPEG) {
			imagecopyresampled($imageP, $image, 0, 0, 0, 0, $width, $height, $widthOrig, $heightOrig);
			imagejpeg($imageP, $destImage, 90);
		} elseif ($imageType == IMAGETYPE_GIF) {
			imagealphablending($imageP, false);
			imagesavealpha($imageP, true);
			$transparent = imagecolorallocatealpha($imageP, 255, 255, 255, 127);
			imagefilledrectangle($imageP, 0, 0, $width, $height, $transparent);

			imagecopyresampled($imageP, $image, 0, 0, 0, 0, $width, $height, $widthOrig, $heightOrig);
			imagegif($imageP, $destImage);
		} elseif ($imageType == IMAGETYPE_PNG) {
			imagealphablending($imageP, false);
			imagesavealpha($imageP, true);
			$transparent = imagecolorallocatealpha($imageP, 255, 255, 255, 127);
			imagefilledrectangle($imageP, 0, 0, $width, $height, $transparent);

			imagecopyresampled($imageP, $image, 0, 0, 0, 0, $width, $height, $widthOrig, $heightOrig);
			imagepng($imageP, $destImage);
		}

		return $destImageUrl;
	}

	/**
	 * Square crop the image
	 *
	 * @param string $uploadDir  Upload directory
	 * @param int    $thumbSize  Square size of thumbnail
	 * @param int    $jpgQuality Jpg quality
	 *
	 * @return string
	 */
	public function squareCrop($uploadDir = 'uploads', $thumbSize = 64, $jpgQuality = 90)
	{
		$srcImage = dirname(__FILE__) . '/../../../../web/' . $uploadDir . $this->uri;

		if (!file_exists($srcImage)) {
			return $this->uri;
		}

		$squareCropDir = dirname(__FILE__) . '/../../../../web/' . $uploadDir . '/_square_crop';

		$thumbDir = $squareCropDir . '/' . $thumbSize;

		$fileDir = $thumbDir . dirname($this->uri);
		if (!file_exists($fileDir)) {
			mkdir($fileDir, 0750, true);
		}
		$destImage = $thumbDir . $this->uri;
		$destImageUrl = '/_square_crop/' . $thumbSize . $this->uri;

		if (file_exists($destImage)) {
			return $destImageUrl;
		}

		// Get dimensions of existing image
		$image = getimagesize($srcImage);

		// Check for valid dimensions
		if ($image[0] <= 0 || $image[1] <= 0) {
			return $this->uri;
		}

		// Determine format from MIME-Type
		$image['format'] = strtolower(preg_replace('/^.*?\//', '', $image['mime']));

		// Import image
		switch ($image['format']) {
			case 'jpg':
			case 'jpeg':
				$imageData = imagecreatefromjpeg($srcImage);
				break;
			case 'png':
				$imageData = imagecreatefrompng($srcImage);
				break;
			case 'gif':
				$imageData = imagecreatefromgif($srcImage);
				break;
			default:
				// Unsupported format
				return $this->uri;
		}

		// Verify import
		if ($imageData == false) {
			return $this->uri;
		}

		// Calculate measurements
		if ($image[0] > $image[1]) {
			// For landscape images
			$xOffset = ($image[0] - $image[1]) / 2;
			$yOffset = 0;
			$squareSize = $image[0] - ($xOffset * 2);
		} else {
			// For portrait and square images
			$xOffset = 0;
			$yOffset = ($image[1] - $image[0]) / 2;
			$squareSize = $image[1] - ($yOffset * 2);
		}

		// Resize and crop
		$canvas = imagecreatetruecolor($thumbSize, $thumbSize);

		if (imagecopyresampled($canvas, $imageData, 0, 0, $xOffset, $yOffset, $thumbSize, $thumbSize, $squareSize, $squareSize)) {
			// Create thumbnail
			switch (strtolower(preg_replace('/^.*\./', '', $destImage))) {
				case 'jpg':
				case 'jpeg':
					if (imagejpeg($canvas, $destImage, $jpgQuality)) {
						return $destImageUrl;
					}
					break;
				case 'png':
					if (imagepng($canvas, $destImage)) {
						return $destImageUrl;
					}
					break;
				case 'gif':
					if (imagegif($canvas, $destImage)) {
						return $destImageUrl;
					}
					break;
				default:
					// Unsupported format
					return $this->uri;
			}
		} else {
			return $this->uri;
		}
	}

	/**
	 * File title
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->title;
	}

}
