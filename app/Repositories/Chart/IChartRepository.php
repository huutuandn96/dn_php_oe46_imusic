<?php

namespace App\Repositories\Chart;

interface IChartRepository
{
    public function albumChart($data);
    public function SongChart($data);
}
