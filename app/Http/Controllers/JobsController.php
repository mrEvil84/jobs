<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AddJobPositionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use JobsApp\Jobs\Application\JobsService;
use JobsApp\Jobs\Commands\AddJobPosition;
use JobsApp\Jobs\ReadModel\JobsReadModel;

class JobsController extends Controller
{
    /**
     * @var JobsReadModel
     */
    private $jobsReadModel;
    /**
     * @var JobsService
     */
    private $jobsService;

    public function __construct(JobsReadModel $jobsReadModel, JobsService $jobsService)
    {
        $this->jobsReadModel = $jobsReadModel;
        $this->jobsService = $jobsService;
    }

    public function showJobs(): View
    {
        return view(
            'welcome',
            [
                'jobs' => $this->jobsReadModel->findAllJobPositions(),
            ]);
    }

    public function addJobPosition(AddJobPositionRequest $request): RedirectResponse
    {
        $this->jobsService->addJobPosition(
            new AddJobPosition(
                $request->get('title'),
                $request->get('jobDescription'),
                $request->get('email'),
                $request->get('companyName')
            )
        );

        return redirect()->action('JobsController@showJobs');
    }

}

