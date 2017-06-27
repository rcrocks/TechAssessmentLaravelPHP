<?php

namespace App\Repositories;


use App\Models\UserStats;
use App\Repository\Contracts\OnboardingStatusRepositoryInterface;
use Illuminate\Support\Facades\DB;

/**
 * @property UserStats userStatus
 */
class OnboardingStatusRepository implements OnboardingStatusRepositoryInterface
{

    /**
     * OnboardingStatusRepository constructor.
     * @param UserStats $userStats
     */
    public function __construct(UserStats $userStats)
    {
        $this->userStatus = $userStats;
    }

    /**
     * Returns weekly on-boarding steps data
     * @return mixed
     */
    public function getWeeklyData()
    {
        $results = DB::select("
        SELECT 
        q0.weeknumber,
        q0.week_start_date,
        (
            SUM(IFNULL(q1.create_account, 0)) 
        + SUM(IFNULL(q2.activate_account, 0))
        + SUM(IFNULL(q3.profile_information, 0))
        + SUM(IFNULL(q4.jobs_interested, 0))
        + SUM(IFNULL(q5.experience, 0))
        + SUM(IFNULL(q6.freelancer, 0))
        + SUM(IFNULL(q7.approval_waiting, 0))
        + SUM(IFNULL(q8.approval, 0))
        ) AS cohort_size,
        IFNULL(q1.create_account, 0) AS create_account,
        IFNULL(q2.activate_account, 0) AS activate_account,
        IFNULL(q3.profile_information, 0) AS profile_information,
        IFNULL(q4.jobs_interested, 0) AS jobs_interested,
        IFNULL(q5.experience, 0) AS experience,
        IFNULL(q6.freelancer, 0) AS freelancer,
        IFNULL(q7.approval_waiting, 0) AS approval_waiting,
        IFNULL(q8.approval, 0) AS approval
        FROM (
        
            SELECT WEEK(created_at, 1) AS weeknumber,
            created_at AS week_start_date
            FROM user_stats
            GROUP BY weeknumber
        
        ) as q0
        LEFT JOIN (
        
            SELECT WEEK(created_at, 1) weeknumber,
            COUNT(user_id) as create_account
            FROM user_stats
            WHERE onboarding_percentage = " . config('onboarding-steps')['create_account'] ."
            GROUP BY weeknumber
        
        ) as q1
        ON q0.weeknumber = q1.weeknumber
        LEFT JOIN (
        
            SELECT WEEK(created_at, 1) weeknumber,
            COUNT(user_id) as activate_account
            FROM user_stats
            WHERE onboarding_percentage = " . config('onboarding-steps')['activate_account'] ."
            GROUP BY weeknumber
        
        ) as q2
        ON q0.weeknumber = q2.weeknumber
        LEFT JOIN (
        
            SELECT WEEK(created_at, 1) weeknumber,
            COUNT(user_id) as profile_information
            FROM user_stats
            WHERE onboarding_percentage = " . config('onboarding-steps')['profile_information'] ."
            GROUP BY weeknumber
        
        ) as q3
        ON q0.weeknumber = q3.weeknumber
        LEFT JOIN (
        
            SELECT WEEK(created_at, 1) weeknumber,
            COUNT(user_id) as jobs_interested
            FROM user_stats
            WHERE onboarding_percentage = " . config('onboarding-steps')['jobs_interested'] ."
            GROUP BY weeknumber
        
        ) as q4
        ON q0.weeknumber = q4.weeknumber
        LEFT JOIN (
        
            SELECT WEEK(created_at, 1) weeknumber,
            COUNT(user_id) as experience
            FROM user_stats
            WHERE onboarding_percentage = " . config('onboarding-steps')['experience'] ."
            GROUP BY weeknumber
        
        ) as q5
        ON q0.weeknumber = q5.weeknumber
        LEFT JOIN (
        
            SELECT WEEK(created_at, 1) weeknumber,
            COUNT(user_id) as freelancer
            FROM user_stats
            WHERE onboarding_percentage = " . config('onboarding-steps')['freelancer'] ."
            GROUP BY weeknumber
        
        ) as q6
        ON q0.weeknumber = q6.weeknumber
        LEFT JOIN (
        
            SELECT WEEK(created_at, 1) weeknumber,
            COUNT(user_id) as approval_waiting
            FROM user_stats
            WHERE onboarding_percentage = " . config('onboarding-steps')['approval_waiting'] ."
            GROUP BY weeknumber
        
        ) as q7
        ON q0.weeknumber = q7.weeknumber
        LEFT JOIN (
        
            SELECT WEEK(created_at, 1) weeknumber,
            COUNT(user_id) as approval
            FROM user_stats
            WHERE onboarding_percentage = " . config('onboarding-steps')['approval'] ."
            GROUP BY weeknumber
        
        ) as q8
        ON q0.weeknumber = q8.weeknumber
        GROUP BY q0.weeknumber
         ");

        return $results;
    }

}