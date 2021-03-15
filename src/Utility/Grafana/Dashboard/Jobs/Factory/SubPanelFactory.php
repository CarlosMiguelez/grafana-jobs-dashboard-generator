<?php declare(strict_types = 1);

namespace Utility\Grafana\Dashboard\Jobs\Factory;

class SubPanelFactory
{
    public function buildJobOverviewSubPanel(
        int $id,
        string $title,
        string $description,
        string $query,
        int $h,
        int $w,
        int $x,
        int $y
    ): array {
        return [
            'cacheTimeout' => null,
            'colorBackground' => false,
            'colorValue' => false,
            'colors' => [
                0 => '#299c46',
                1 => 'rgba(237, 129, 40, 0.89)',
                2 => '#d44a3a',
            ],
            'datasource' => 'Prometheus',
            'description' => $description,
            'fieldConfig' => [
                'defaults' => [
                    'custom' => [
                    ],
                ],
                'overrides' => [
                ],
            ],
            'format' => 'none',
            'gauge' => [
                'maxValue' => 100,
                'minValue' => 0,
                'show' => false,
                'thresholdLabels' => false,
                'thresholdMarkers' => true,
            ],
            'gridPos' => [
                'h' => $h,
                'w' => $w,
                'x' => $x,
                'y' => $y,
            ],
            'id' => $id,
            'interval' => null,
            'links' => [
            ],
            'mappingType' => 1,
            'mappingTypes' => [
                0 => [
                    'name' => 'value to text',
                    'value' => 1,
                ],
                1 => [
                    'name' => 'range to text',
                    'value' => 2,
                ],
            ],
            'maxDataPoints' => 100,
            'nullPointMode' => 'connected',
            'nullText' => null,
            'postfix' => '',
            'postfixFontSize' => '50%',
            'prefix' => '',
            'prefixFontSize' => '50%',
            'rangeMaps' => [
                0 => [
                    'from' => 'null',
                    'text' => 'N/A',
                    'to' => 'null',
                ],
            ],
            'sparkline' => [
                'fillColor' => 'rgba(31, 118, 189, 0.18)',
                'full' => false,
                'lineColor' => 'rgb(31, 120, 193)',
                'show' => true,
            ],
            'tableColumn' => '',
            'targets' => [
                0 => [
                    'expr' => $query,
                    'format' => 'time_series',
                    'interval' => '',
                    'intervalFactor' => 1,
                    'legendFormat' => '',
                    'refId' => 'A',
                ],
            ],
            'thresholds' => '',
            'title' => $title,
            'type' => 'singlestat',
            'valueFontSize' => '80%',
            'valueMaps' => [
                0 => [
                    'op' => '=',
                    'text' => 'N/A',
                    'value' => 'null',
                ],
            ],
            'valueName' => 'current',
        ];
    }

    public function buildJobSubPanel(
        int $id,
        string $title,
        string $description,
        string $query,
        int $h,
        int $w,
        int $x,
        int $y
    ): array {
        return [
            'aliasColors' => [
            ],
            'bars' => false,
            'dashLength' => 10,
            'dashes' => false,
            'datasource' => null,
            'description' => $description,
            'fieldConfig' => [
                'defaults' => [
                    'custom' => [
                    ],
                ],
                'overrides' => [
                ],
            ],
            'fill' => 1,
            'fillGradient' => 0,
            'gridPos' => [
                'h' => $h,
                'w' => $w,
                'x' => $x,
                'y' => $y,
            ],
            'hiddenSeries' => false,
            'id' => $id,
            'legend' => [
                'avg' => false,
                'current' => false,
                'max' => false,
                'min' => false,
                'show' => true,
                'total' => false,
                'values' => false,
            ],
            'lines' => true,
            'linewidth' => 1,
            'nullPointMode' => 'null',
            'options' => [
                'alertThreshold' => true,
            ],
            'percentage' => false,
            'pluginVersion' => '7.4.2',
            'pointradius' => 2,
            'points' => false,
            'renderer' => 'flot',
            'seriesOverrides' => [
            ],
            'spaceLength' => 10,
            'stack' => false,
            'steppedLine' => false,
            'targets' => [
                0 => [
                    'expr' => $query,
                    'instant' => false,
                    'interval' => '',
                    'legendFormat' => '',
                    'refId' => 'A',
                ],
            ],
            'thresholds' => [
            ],
            'timeFrom' => null,
            'timeRegions' => [
            ],
            'timeShift' => null,
            'title' => $title,
            'tooltip' => [
                'shared' => true,
                'sort' => 0,
                'value_type' => 'individual',
            ],
            'type' => 'graph',
            'xaxis' => [
                'buckets' => null,
                'mode' => 'time',
                'name' => null,
                'show' => true,
                'values' => [
                ],
            ],
            'yaxes' => [
                0 => [
                    'format' => 'short',
                    'label' => null,
                    'logBase' => 1,
                    'max' => null,
                    'min' => null,
                    'show' => true,
                ],
                1 => [
                    'format' => 'short',
                    'label' => null,
                    'logBase' => 1,
                    'max' => null,
                    'min' => null,
                    'show' => true,
                ],
            ],
            'yaxis' => [
                'align' => false,
                'alignLevel' => null,
            ],
        ];
    }
}
