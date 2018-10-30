<?php

namespace Coolsms\message\Api;

use Coolsms\Coolsms;

class ImageFile extends Coolsms
{
	/**
	 * Coolsms REST V4를 이용해서 이미지를 업로드 하여 아이디를 생성.
	 * @param $options->image Base64으로 인코딩된 string
	 * @return mixed
	 */
	public static function createImageFile($options)
	{
		$args = new \stdClass();
		$args->image = $options->image;
		return self::request('POST', 'images/v4/images', $args);
	}

	/**
	 * 이미지 목록조회
	 * @return mixed
	 */
	public static function getImageList()
	{
		return self::request('GET', 'images/v4/images');
	}

	/**
	 * 이미지 정보 확인
	 * 반드시 ImageId 값이 필요.
	 * @param $imageId
	 * @return mixed
	 */
	public static function getImageInfo($imageId)
	{
		return self::request('GET', "images/v4/images/{$imageId}");
	}

	/**
	 * Coolsms에 저장된 이미지를 삭제
	 * 반드시 ImageId값이 필요.
	 * @param $imageId
	 * @return mixed
	 */
	public static function deleteImageFile($imageId)
	{
		return self::request('GET', "images/v4/images/{$imageId}");
	}
}
