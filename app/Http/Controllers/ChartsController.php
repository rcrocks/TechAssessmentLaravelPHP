<?php

namespace App\Http\Controllers;

use App\Repository\Contracts\OnboardingStatusRepositoryInterface;

class ChartsController extends Controller {

    /**
     * ChartsController constructor.
     * @param OnboardingStatusRepositoryInterface $onboardingStatusRepository
     */
    public function __construct(OnboardingStatusRepositoryInterface $onboardingStatusRepository)
    {
        $this->onBoardRepo = $onboardingStatusRepository;
    }

    /**
     * Handles the default view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getView()
    {
        return view('chart');

    }

    /**
     * Returns the chart data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData()
    {
        return response()->json([
            $this->onBoardRepo->getWeeklyData()
        ]);
    }

}