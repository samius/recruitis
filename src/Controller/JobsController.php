<?php
declare(strict_types=1);

namespace App\Controller;

use App\Integrations\Recruitis\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/jobs')]
class JobsController extends AbstractController
{
    #[Route('/', 'jobs_all', methods: ['GET'])]
    public function all(Client $recruitisClient): Response
    {
        $jobsCollection = $recruitisClient->getAllJobs();

        return $this->render('jobs/all.html.twig', ['jobsCollection'=>$jobsCollection]);
    }
}
