<?php

namespace App\Controller;

use App\Entity\Carte;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GetImageController extends AbstractController
{
    public function __invoke(Carte $data): Response
    {
        $image = $data->getImage();

        return new Response(
            stream_get_contents($image, -1, 0),
            Response::HTTP_OK,
            ['content-type' => 'image/png']);
    }
}
