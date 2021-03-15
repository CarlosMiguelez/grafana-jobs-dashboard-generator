<?php declare(strict_types = 1);

namespace Utility\Grafana\Dashboard\Jobs\Factory;

class DashboardFactory
{
    public function build(array $panels): string
    {
        $dashboard = [
            'title' => 'K8s Cluster Job Metrics',
            'description' => 'Overview of all succeeded, active and failed Jobs within Kubernetes.',
            'uid' => 'CaMiKzClG',
            'iteration' => 1615831806,
            'editable' => true,
            'gnetId' => null,
            'graphTooltip' => 1,
            'style' => 'dark',
            'refresh' => false,
            'timezone' => 'browser',
            'annotations' => [
                'list' => [
                    0 => [
                        'builtIn' => 1,
                        'datasource' => '-- Grafana --',
                        'enable' => true,
                        'hide' => true,
                        'iconColor' => 'rgba(0, 211, 255, 1)',
                        'name' => 'Annotations & Alerts',
                        'type' => 'dashboard',
                    ],
                ],
            ],
            'panels' => $panels,
            'templating' => [
                'list' => [
                    0 => [
                        'current' => [
                            'selected' => false,
                            'text' => 'Loki-Prom',
                            'value' => 'Loki-Prom',
                        ],
                        'description' => null,
                        'error' => null,
                        'hide' => 0,
                        'includeAll' => false,
                        'label' => null,
                        'multi' => false,
                        'name' => 'cluster',
                        'options' => [
                        ],
                        'query' => 'prometheus',
                        'queryValue' => '',
                        'refresh' => 1,
                        'regex' => '',
                        'skipUrlSync' => false,
                        'type' => 'datasource',
                    ],
                    1 => [
                        'allValue' => null,
                        'current' => [
                            'selected' => false,
                            'text' => 'None',
                            'value' => '',
                        ],
                        'datasource' => 'Prometheus',
                        'definition' => '',
                        'description' => null,
                        'error' => null,
                        'hide' => 2,
                        'includeAll' => false,
                        'label' => '',
                        'multi' => false,
                        'name' => 'ds',
                        'options' => [
                        ],
                        'query' => [
                            'query' => 'datasource',
                            'refId' => 'Prometheus-ds-Variable-Query',
                        ],
                        'refresh' => 1,
                        'regex' => '',
                        'skipUrlSync' => false,
                        'sort' => 0,
                        'tagValuesQuery' => '',
                        'tags' => [
                        ],
                        'tagsQuery' => '',
                        'type' => 'query',
                        'useTags' => false,
                    ],
                    2 => [
                        'current' => [
                            'selected' => false,
                            'text' => 'default',
                            'value' => 'default',
                        ],
                        'description' => null,
                        'error' => null,
                        'hide' => 2,
                        'includeAll' => false,
                        'label' => '',
                        'multi' => false,
                        'name' => 'datasource',
                        'options' => [
                        ],
                        'query' => 'prometheus',
                        'refresh' => 1,
                        'regex' => '/$ds/',
                        'skipUrlSync' => false,
                        'type' => 'datasource',
                    ],
                    3 => [
                        'allValue' => null,
                        'current' => [
                            'selected' => false,
                            'text' => [
                                0 => 'sh-spryker',
                            ],
                            'value' => [
                                0 => 'sh-spryker',
                            ],
                        ],
                        'datasource' => 'Prometheus',
                        'definition' => '',
                        'description' => null,
                        'error' => null,
                        'hide' => 0,
                        'includeAll' => true,
                        'label' => null,
                        'multi' => true,
                        'name' => 'namespace',
                        'options' => [
                        ],
                        'query' => [
                            'query' => 'label_values(kube_pod_info, namespace)',
                            'refId' => 'Prometheus-namespace-Variable-Query',
                        ],
                        'refresh' => 1,
                        'regex' => '',
                        'skipUrlSync' => false,
                        'sort' => 0,
                        'tagValuesQuery' => null,
                        'tags' => [
                        ],
                        'tagsQuery' => null,
                        'type' => 'query',
                        'useTags' => false,
                    ],
                ],
            ],
            'time' => [
                'from' => 'now-7d',
                'to' => 'now',
            ],
            'timepicker' => [
                'refresh_intervals' => [
                    0 => '5s',
                    1 => '10s',
                    2 => '30s',
                    3 => '1m',
                    4 => '5m',
                    5 => '15m',
                    6 => '30m',
                    7 => '1h',
                    8 => '2h',
                    9 => '1d',
                ],
                'time_options' => [
                    0 => '5m',
                    1 => '15m',
                    2 => '1h',
                    3 => '6h',
                    4 => '12h',
                    5 => '24h',
                    6 => '2d',
                    7 => '7d',
                    8 => '30d',
                ],
            ],
        ];

        return json_encode($dashboard, JSON_THROW_ON_ERROR);
    }
}
