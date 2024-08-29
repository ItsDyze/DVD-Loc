<?php

namespace Utils;

class ImageUtils
{
    public static function getImageTypeFromSignature(string $byteArray)
    {
        $signature = bin2hex(substr($byteArray, 0, 8));

        // https://en.wikipedia.org/wiki/List_of_file_signatures
        return match ($signature)
        {
            "ffd8ff" => "image/jpeg",
            "89504e47" => "image/png",
            "47494638" => "image/gif",
            "424d" => "image/bmp",
            default => null,
        };
    }
}