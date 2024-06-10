<?php
declare(strict_types=1);

namespace App\Controller;

use App\Integrations\Recruitis\Client;
use App\Integrations\Recruitis\ClientException;
use App\Integrations\Recruitis\Model\Jobs\JobCollection;
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
        $page = $request->query->getInt('page', 1);

        if ($page < 1) {
            return $this->redirectToRoute('jobs_all', ['page' => 1]);
        }

        try {
            $jobsCollection = $recruitisClient->getAllJobs($page);
        } catch (ClientException $e) {
            $this->addFlash('error', $e->getMessage());
            $jobsCollection = new JobCollection();
        }

        return $this->render('jobs/all.html.twig', ['jobs' => $jobsCollection]);
    }
}
