<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

abstract class Controller extends AbstractController
{
    protected function _replaceRequestData(Request $request)
    {
        $content = $request->getContent();

        if ($request->getContentType() !== 'json' || empty($content)) {
            throw new BadRequestHttpException('Invalid data.');
        }
        try {
            $data = json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new BadRequestHttpException('Could not parse json.');
        }
        if (is_array($data)) {
            $request->request->replace($data);
        }
    }
}
