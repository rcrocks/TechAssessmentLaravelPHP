<?php

namespace Tests\Feature;

use App\Models\UserStats;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class getChartDataTest extends TestCase
{

    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->beginDatabaseTransaction();
    }

    /**
     * Check JSON with empty data set
     *
     * @return void
     */
    public function testGetDataWithEmptyDatabase()
    {
        $response = $this->json('GET', 'chartdata');
        $response->assertStatus(200);
        $response->assertJson([]);
    }

    /**
     * Check JSON with single on-boarding record
     *
     * @return void
     */
    public function testGetDataWithSingleOnBoarding()
    {
        UserStats::create([
            'user_id'   =>  100,
            'created_at'    =>  '2017-06-20',
            'onboarding_percentage' =>  40
        ]);

        $response = $this->json('GET', 'chartdata');
        $response->assertStatus(200);
        $response->assertJson([[
            'weeknumber'    =>  25,
            'week_start_date'   =>  "2017-06-20",
            'cohort_size'   =>  1,
            'create_account'    =>  0,
            'activate_account'  =>  0,
            'profile_information'   =>  1,
            'jobs_interested'   =>  0,
            'experience'    =>  0,
            'freelancer'    =>  0,
            'approval_waiting'  =>  0,
            'approval'  =>  0
        ]]);
    }

    /**
     * Verify weekly cohort size
     *
     * @return void
     */
    public function testVerifyCohortSize()
    {
        $records = [
            [
                'user_id'   =>  100,
                'created_at'    =>  '2017-06-01',
                'onboarding_percentage' =>  20
            ],
            [
                'user_id'   =>  101,
                'created_at'    =>  '2017-06-02',
                'onboarding_percentage' =>  90
            ],
            [
                'user_id'   =>  102,
                'created_at'    =>  '2017-06-03',
                'onboarding_percentage' =>  100
            ],
            [
                'user_id'   =>  102,
                'created_at'    =>  '2017-06-08',
                'onboarding_percentage' =>  99
            ],
        ];

        UserStats::insert($records);
        $response = $this->json('GET', 'chartdata');
        $response->assertStatus(200);
        $response->assertJson([[
            "cohort_size"   => 3
        ]]);
    }
}
