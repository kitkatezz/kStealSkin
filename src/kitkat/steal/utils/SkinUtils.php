<?php

declare(strict_types=1);

namespace kitkat\steal\utils;

final class SkinUtils
{

    const ACCEPTED_SKIN_SIZES = [
        8192, // 64 * 32 * 4
        16384, // 64 * 64 * 4
        65536, // 128 * 128 * 4
    ];

    const SKIN_WIDTH_MAP = [
        8102 => 64,
        16384 => 64,
        65536 => 128
    ];

    const SKIN_HEIGHT_MAP = [
        8102 => 32,
        16384 => 64,
        65536 => 128
    ];

    /**
     * @param int $size
     * @return bool
     */
    private static function isValidSize(int $size): bool
    {
        return in_array($size, self::ACCEPTED_SKIN_SIZES);
    }

    /**
     * @param string $skinData
     */
    public static function skinDataToImage(string $skinData)
    {
        $size = strlen($skinData);
        if (!self::isValidSize($size)) {
            throw new \Exception(sprintf('Invalid skin size %s', $size));
        }

        $width = self::SKIN_WIDTH_MAP[$size];
        $height = self::SKIN_HEIGHT_MAP[$size];

        $image = imagecreatetruecolor($width, $height);
        if ($image === false) {
            throw new \Exception("Couldn't create image");
        }

        $pos = 0;
        imagefill($image, 0, 0, imagecolorallocatealpha($image, 0, 0, 0, 127));
        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                $r = ord($skinData[$pos]);
                $pos++;
                $g = ord($skinData[$pos]);
                $pos++;
                $b = ord($skinData[$pos]);
                $pos++;
                $a = 127 - intdiv(ord($skinData[$pos]), 2);
                $pos++;

                $color = imagecolorallocatealpha($image, $r, $g, $b, $a);
                imagesetpixel($image, $x, $y, $color);
            }
        }

        imagesavealpha($image, true);

        return $image;
    }

    /**
     * @param string $skinData
     * @param string $path
     */
    public static function savePlayerSkin(string $skinData, string $path)
    {
        $image = self::skinDataToImage($skinData);
        imagepng($image, $path);
        imagedestroy($image);
    }
}
