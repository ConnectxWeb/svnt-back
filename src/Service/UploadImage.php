<?php
/**
 * This code is open source and licensed under the MIT License
 * Author: Benjamin Leveque <info@connectx.fr>
 * Copyright (c) - connectX
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace App\Service;

use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\JsonResponse;

class UploadImage
{
    private $path;

    public function __construct($pathUploadImg)
    {
        $this->path = $pathUploadImg;
    }

    public function uploadImage($baseUrl): JsonResponse
    {
        $fileSystem = new Filesystem();
        if (!$fileSystem->exists($this->path)) {
            try {
                $fileSystem->mkdir($this->path, 0777);
            } catch (IOExceptionInterface $exception) {
                return Utils::generateJsonResponse(false,
                    sprintf("An error occurred while creating your directory at: %s.", $exception->getPath()),
                    500);
            }
        }

        try {
            reset($_FILES);
            $temp = current($_FILES);
            if (is_uploaded_file($temp['tmp_name']) === false) {
                return Utils::generateJsonResponse(false, "Le fichier n'a pas été uploadé", 500);
            }
            // Sanitize input
            if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
                return Utils::generateJsonResponse(false, 'Nom de fichier invalide.', 400);
            }
            // Verify extension
            $extension = strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION));
            if (!in_array($extension,
                array("gif", "jpg", "png", "jpeg"))) {
                return Utils::generateJsonResponse(false, 'Extension invalide', 400);
            }
            $now = new \DateTime();
            $filetowrite = sprintf('%s/%s-%s.%s', $this->path, $now->getTimestamp(), rand(), $extension);
            if (file_exists($filetowrite)) {
                return Utils::generateJsonResponse(false,
                    sprintf('Le fichier existe deja : %s', $filetowrite),
                    400);
            }
            if (move_uploaded_file($temp['tmp_name'], $filetowrite) === false) {
                return Utils::generateJsonResponse(false, "Le fichier n'a pas pu être déplacé au bon endroit.", 400);
            }
            return Utils::generateJsonResponse(true, sprintf('%s/%s', $baseUrl, $filetowrite), 200);
        } catch (\Exception $exception) {
            return Utils::generateJsonResponse(false, $exception->getMessage(), $exception->getCode());
        }
    }
}