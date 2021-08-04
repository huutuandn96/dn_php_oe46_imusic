<?php

namespace App\Repositories\Chart;

use App\Models\Album;
use App\Charts\AlbumChart;
use App\Repositories\BaseRepository;

class ChartRepository extends BaseRepository implements IChartRepository
{
    public function getModel()
    {
        return Album::class;
    }

    public function albumChart($data)
    {
        $time = strtotime("january");
    
        $jan = date("Y-m-d", strtotime(date("Y-m-d", $time)));  
        $feb = date("Y-m-d", strtotime(date("Y-m-d", $time)  . " +1 month"));
        $mar = date("Y-m-d", strtotime(date("Y-m-d", $time)  . " +2 month"));
        $apr = date("Y-m-d", strtotime(date("Y-m-d", $time)  . " +3 month"));
        $may = date("Y-m-d", strtotime(date("Y-m-d", $time)  . " +4 month"));
        $jun = date("Y-m-d", strtotime(date("Y-m-d", $time)  . " +5 month"));
        $jul = date("Y-m-d", strtotime(date("Y-m-d", $time)  . " +6 month"));
        $aug = date("Y-m-d", strtotime(date("Y-m-d", $time)  . " +7 month"));
        $sep = date("Y-m-d", strtotime(date("Y-m-d", $time)  . " +8 month"));
        $oct = date("Y-m-d", strtotime(date("Y-m-d", $time)  . " +9 month"));
        $nov = date("Y-m-d", strtotime(date("Y-m-d", $time)  . " +10 month"));
        $dec = date("Y-m-d", strtotime(date("Y-m-d", $time)  . " +11 month"));
        $janNextYear = date("Y-m-d", strtotime(date("Y-m-d", $time)  . " +12 month"));

        $albumChart = new AlbumChart();

        if ($data['time2'] == 'm' ) {
            $albumJan = $this->model::whereBetween('created_at', [$jan, $feb])->count();
            $albumFeb = $this->model::whereBetween('created_at', [$feb, $mar])->count();
            $albumMar = $this->model::whereBetween('created_at', [$mar, $apr])->count();
            $albumApr = $this->model::whereBetween('created_at', [$apr, $may])->count();
            $albumMay = $this->model::whereBetween('created_at', [$may, $jun])->count();
            $albumJun = $this->model::whereBetween('created_at', [$jun, $jul])->count();
            $albumJul = $this->model::whereBetween('created_at', [$jul, $aug])->count();
            $albumAug = $this->model::whereBetween('created_at', [$aug, $sep])->count();
            $albumSep = $this->model::whereBetween('created_at', [$sep, $oct])->count();
            $albumOct = $this->model::whereBetween('created_at', [$oct, $nov])->count();
            $albumNov = $this->model::whereBetween('created_at', [$nov, $dec])->count();
            $albumDec = $this->model::whereBetween('created_at', [$dec, $janNextYear])->count();

            $dataset = [
                $albumJan,
                $albumFeb,
                $albumMar,
                $albumApr,
                $albumMay,
                $albumJun,
                $albumJul,
                $albumAug,
                $albumSep,
                $albumOct,
                $albumNov,
                $albumDec,
            ];
            $albumChart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
        }

        if ($data['time2'] == 'Q') {

            $albumFirstQuarter = $this->model::whereBetween('created_at', [$jan, $apr])->count();
            $albumSecondQuarter = $this->model::whereBetween('created_at', [$apr, $jul])->count();
            $albumThirdQuarter = $this->model::whereBetween('created_at', [$jul, $oct])->count();
            $albumForthQuarter = $this->model::whereBetween('created_at', [$oct, $jan])->count();
    
            $dataset = [
                $albumFirstQuarter,
                $albumSecondQuarter,
                $albumThirdQuarter,
                $albumForthQuarter,
            ];

            $albumChart->labels(['First Quarter','Second Quarter', 'Third Quater', 'Fourth Quater']);       
        }

        if ($data['time2'] == 'Y') {

            $oldYear     = date("Y-m-d", strtotime(date("Y-m-d", $time)  . " -24 month"));
            $lastYear    = date("Y-m-d", strtotime(date("Y-m-d", $time)  . " -12 month"));
            $currentYear = date("Y-m-d", strtotime(date("Y-m-d", $time)));
            $nextYear    = date("Y-m-d", strtotime(date("Y-m-d", $time)  . " +12 month"));

            $albumOldYear  = $this->model::whereBetween('created_at', [$oldYear, $lastYear])->count();
            $albumLastYear = $this->model::whereBetween('created_at', [$lastYear, $currentYear])->count();
            $albumYear  = $this->model::whereBetween('created_at', [$currentYear, $nextYear])->count();

            $dataset = [
                $albumOldYear,
                $albumLastYear,
                $albumYear
            ];

            $albumChart->labels([$oldYear, $lastYear, $currentYear]);
        }

        $albumChart->dataset('News Album', 'bar', $dataset)
                ->color("#00CCCC")
                ->backgroundcolor("#00CCCC");

        return $albumChart;
    }
}
