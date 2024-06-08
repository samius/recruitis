<?php
declare(strict_types=1);

namespace App\Controller;

use App\Integrations\Recruitis\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/jobs')]
class JobsController extends AbstractController
{
    #[Route('/', 'jobs_all', methods: ['GET'])]
    public function all(Request $request, Client $recruitisClient): Response
    {
        $page = $request->query->get('page', 1);
        $jobsCollection = $recruitisClient->getAllJobs($page);

        return $this->render('jobs/all.html.twig', ['jobs'=>$jobsCollection]);
    }
}
