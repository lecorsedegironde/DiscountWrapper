<?php
/**
 * Creator: @lecorsedegironde
 *
 * Date: 18/01/2016
 * Time: 21:45
 */

namespace CDiscount;


class Image
{
    /**
     * @var string, the image url
     */
    private $_imageUrl;

    /**
     * @var string, the thumbnail of the image url
     */
    private $_thumbnailUrl;

    /**
     * Image constructor.
     * @param $image, the iamge array
     */
    public function __construct($image)
    {
        $this->_imageUrl = $image["ImageUrl"];

        $this->_thumbnailUrl = $image["ThumbnailUrl"];
    }

    /**
     * @return string, the image url
     */
    public function getImageUrl()
    {
        return $this->_imageUrl;
    }

    /**
     * @return string, the thumbnail url
     */
    public function getThumbnailUrl()
    {
        return $this->_thumbnailUrl;
    }
}