<?php

/*
    |--------------------------------------------------------------------------
    | On-boarding percentages
    |--------------------------------------------------------------------------
    |
    | Here you define the percentage for each On-boarding step. Define them like
    | this helps to override them in testing environment.
    |
    */
return [

    'create_account'    =>  env('CREATE_ACCOUNT_ONBOARDING_PERCENTAGE', 0),
    'activate_account'  =>  env('ACTIVATE_ACCOUNT_ONBOARDING_PERCENTAGE', 20),
    'profile_information'   =>  env('PROFILE_INFORMATION_ONBOARDING_PERCENTAGE', 40),
    'jobs_interested'   =>  env('JOBS_INTERESTED_ONBOARDING_PERCENTAGE', 50),
    'experience' => env('EXPERINCE_ONBOARDING_PERCENTAGE', 70),
    'freelancer'    =>  env('FREELANCER_ONBOARDING_PERCENTAGE', 90),
    'approval_waiting'  =>  env('APPROVAL_WAITING_ONBOARDING_PERCENTAGE', 99),
    'approval'  =>  env('APPROVAL_ONBOARDING_PERCENTAGE', 100)

];
