<?php declare(strict_types = 1);

namespace Utility\Grafana\Dashboard\Jobs\Factory;

class PanelFactory
{
    public function build(int $id, bool $collapse, string $title, int $h, int $w, int $x, int $y): array
    {
        return [
            'collapse' => $collapse,
            'datasource' => null,
            'gridPos' => [
                'h' => $h,
                'w' => $w,
                'x' => $x,
                'y' => $y,
            ],
            'id' => $id,
            'panels' => [],
            'title' => $title,
            'type' => 'row',
        ];
    }
}
