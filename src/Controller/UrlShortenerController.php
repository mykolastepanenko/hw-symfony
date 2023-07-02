<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use UrlShortener\UrlShortener;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('urlshortener')]
class UrlShortenerController extends AbstractController
{
    #[Route('/', name: 'app_url_shortener')]
    public function index(Request $request, UrlShortener $urlShortener): Response
    {
        $url = $request->get('url');
        $code = $urlShortener->encode($url);
        return $this->render('url_shortener/index.html.twig', [
            'controller_name' => 'UrlShortenerController',
            'url' => $url,
            'code' => $code
        ]);
    }
}
