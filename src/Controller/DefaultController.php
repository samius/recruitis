<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/', 'homepage', methods: ['GET'])]
    public function default(): Response
    {
        return $this->redirectToRoute('jobs_all');
    }
}
