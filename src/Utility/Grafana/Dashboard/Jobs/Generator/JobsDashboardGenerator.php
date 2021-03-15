<?php
declare(strict_types=1);

namespace Utility\Grafana\Dashboard\Jobs\Generator;

use Utility\Grafana\Dashboard\Jobs\Factory\DashboardFactory;
use Utility\Grafana\Dashboard\Jobs\Factory\PanelFactory;
use Utility\Grafana\Dashboard\Jobs\Factory\SubPanelFactory;

class JobsDashboardGenerator
{
    private const JOB_NAME_PATTERN = 'test-job-.*';
    private const ACTIVE_JOBS_QUERY = 'sum(kube_job_status_active{namespace=~"$namespace", job_name=~"%s"})';
    private const FAILED_JOBS_QUERY = 'sum(kube_job_status_failed{namespace=~"$namespace", job_name=~"%s"})';
    private const SUCCEEDED_JOBS_QUERY = 'sum(kube_job_status_succeeded{namespace=~"$namespace", job_name=~"%s"})';

    private PanelFactory $panelFactory;
    private SubPanelFactory $subPanelFactory;
    private DashboardFactory $dashboardFactory;

    public function __construct()
    {
        $this->panelFactory = new PanelFactory();
        $this->subPanelFactory = new SubPanelFactory();
        $this->dashboardFactory = new DashboardFactory();
    }

    public function generate(array $jobs): string
    {
        $overviewPanels = $this->generateOverViewPanels();

        $jobPanels = $this->generateJobPanels($jobs);

        $dashboardPanels = array_merge($overviewPanels, $jobPanels);

        try {
            $dashboard = $this->dashboardFactory->build($dashboardPanels);
        } catch (\JsonException $exception) {
            $dashboard = '';
        }

        return $dashboard;
    }

    private function generateOverViewPanels(): array
    {
        return [
            $this->panelFactory->build(
                1,
                false,
                'Jobs overview',
                1,
                24,
                0,
                0
            ),
            $this->subPanelFactory->buildJobOverviewSubpanel(
                2,
                'Jobs Active',
                'Number of Active Jobs',
                sprintf(static::ACTIVE_JOBS_QUERY, static::JOB_NAME_PATTERN),
                4,
                8,
                0,
                1
            ),
            $this->subPanelFactory->buildJobOverviewSubpanel(
                3,
                'Jobs Failed',
                'Number of Failed Jobs',
                sprintf(static::FAILED_JOBS_QUERY, static::JOB_NAME_PATTERN),
                4,
                8,
                8,
                1
            ),
            $this->subPanelFactory->buildJobOverviewSubpanel(
                4,
                'Jobs Succeeded',
                'Number of Succeeded Jobs',
                sprintf(static::SUCCEEDED_JOBS_QUERY, static::JOB_NAME_PATTERN),
                4,
                8,
                16,
                1
            ),
        ];
    }

    private function generateJobPanels(array $jobs): array
    {
        $id = 5;
        $counter = 0;
        $initialRowPanelPositionY = 4;
        $nextRowPanelPositionY = 4;
        $rowPanelHeight = 1;
        $rowPanelWidth = 24;
        $rowPanelPositionX = 0;
        $subPanelHeight = 10;
        $subPanelWidth = 12;
        $subPanelPositionX = 0;

        $jobPanels = [];

        foreach ($jobs as $job) {
            $rowPanelPositionY = ($counter === 0) ? $initialRowPanelPositionY : $nextRowPanelPositionY;
            $subPanelPositionY = $rowPanelPositionY + $rowPanelHeight;
            $nextRowPanelPositionY = ($rowPanelPositionY + $rowPanelHeight) + $subPanelHeight;

            // ID's
            $rowPanelId = $id;
            $succeededSubPanelId = $rowPanelId + 1;
            $failedSubPanelId = $succeededSubPanelId + 1;

            // Row panel
            $jobPanels[] = $this->panelFactory->build(
                $rowPanelId,
                false,
                $job['name'],
                $rowPanelHeight,
                $rowPanelWidth,
                $rowPanelPositionX,
                $rowPanelPositionY
            );

            // Succeeded jobs sub panel
            $jobPanels[] = $this->subPanelFactory->buildJobSubPanel(
                $succeededSubPanelId,
                'Succeeded Jobs',
                'Sum of succeeded jobs',
                sprintf(static::ACTIVE_JOBS_QUERY, $job['name']),
                $subPanelHeight,
                $subPanelWidth,
                $subPanelPositionX,
                $subPanelPositionY
            );

            // Failed jobs sub panel
            $jobPanels[] = $this->subPanelFactory->buildJobSubPanel(
                $failedSubPanelId,
                'Failed Jobs',
                'Sum of failed jobs',
                sprintf(static::FAILED_JOBS_QUERY, $job['name']),
                $subPanelHeight,
                $subPanelWidth,
                $subPanelPositionX + $subPanelWidth,
                $subPanelPositionY
            );

            // Increase counter
            $counter++;

            // Increase ID
            $id = $failedSubPanelId + 1;
        }

        return $jobPanels;
    }
}
