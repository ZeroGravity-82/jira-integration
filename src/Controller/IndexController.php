<?php

namespace JiraIntegration\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController
{
    #[Route('/', name: 'app_index', methods: ['GET'])]
    public function __invoke(): Response
    {
        return new Response(
            '<html><body>Index page</body></html>'
        );
    }
}
