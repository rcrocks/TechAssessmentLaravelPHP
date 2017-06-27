<?php

namespace App\Repository\Contracts;


interface OnboardingStatusRepositoryInterface
{
    /**
     * Returns weekly on-boarding steps data
     * @return mixed
     */
    public function getWeeklyData();
}