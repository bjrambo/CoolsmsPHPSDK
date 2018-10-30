<?php

namespace Coolsms\message\Api;

use Coolsms\Coolsms;

class ImageFile extends Coolsms
{
	public static function createImageFile($options)
	{
		$args = new \stdClass();
		$args->image = $options->image;
		return self::request('POST', 'images/v4/images', $args);
	}

	public static function getImageList()
	{
		return self::request('GET', 'images/v4/images');
	}

	public static function getImageInfo($imageId)
	{
		return self::request('GET', "images/v4/images/{$imageId}");
	}

	public static function deleteImageFile($imageId)
	{
		return self::request('GET', "images/v4/images/{$imageId}");
	}
}
