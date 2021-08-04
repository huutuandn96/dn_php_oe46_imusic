<?php

namespace App\Http\Controllers\Admin;

use App\Models\Album;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Chart\IChartRepository;

class HomeController extends Controller
{
    protected $chartRepository;

    public function __construct(IChartRepository $chartRepository)
    {
        return $this->chartRepository = $chartRepository;
    }

    public function index()
    {
        return view('admin.index');
    }

    public function albumChart(Request $request)
    {
        $albumChart = $this->chartRepository->albumChart($request->all());

        return view('admin.index', compact('albumChart'));
    }
}
