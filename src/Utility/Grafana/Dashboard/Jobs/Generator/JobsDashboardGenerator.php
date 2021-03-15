<?php declare(strict_types = 1);

namespace Utility\Grafana\Dashboard\Jobs\Generator;

use Utility\Grafana\Dashboard\Jobs\Factory\DashboardFactory;
use Utility\Grafana\Dashboard\Jobs\Factory\PanelFactory;
use Utility\Grafana\Dashboard\Jobs\Factory\SubPanelFactory;

class JobsDashboardGenerator
{
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

        $dashboard = $this->dashboardFactory->build($dashboardPanels);

        return json_encode($dashboard, JSON_THROW_ON_ERROR);
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
                'sum(kube_job_status_active{namespace=~"$namespace", job_name=~"sh.*"})',
                4,
                8,
                0,
                1
            ),
            $this->subPanelFactory->buildJobOverviewSubpanel(
                3,
                'Jobs Failed',
                'Number of Failed Jobs',
                'sum(kube_job_status_failed{namespace=~"$namespace", job_name=~"sh.*"})',
                4,
                8,
                8,
                1
            ),
            $this->subPanelFactory->buildJobOverviewSubpanel(
                4,
                'Jobs Succeeded',
                'Number of Succeeded Jobs',
                'sum(kube_job_status_succeeded{namespace=~"$namespace", job_name=~"sh.*"})',
                4,
                8,
                16,
                1
            ),
        ];
    }
    
    private function generateJobPanels(array $jobs): array
    {
        $id = 4;
        $counter = 0;
        $initialPositionY = 4;
        $rowPanelHeight = 1;
        $rowPanelWidth = 24;
        $rowPanelPositionX = 0;
        $subPanelHeight = 10;
        $subPanelWidth = 12;
        $subPanelPositionX = 0;

        $jobPanels = [];

        foreach ($jobs as $job) {
            $rowPanelPositionY = ($counter === 0) ? $initialPositionY : $initialPositionY + $subPanelHeight;
            $subPanelPositionY = $rowPanelPositionY + $rowPanelHeight;

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
                '',
                $subPanelHeight,
                $subPanelWidth,
                $subPanelPositionX,
                $subPanelPositionY
            );

            // Failed jobs sub panel
            $this->subPanelFactory->buildJobSubPanel(
                $failedSubPanelId,
                'Failed Jobs',
                'Sum of failed jobs',
                '',
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
