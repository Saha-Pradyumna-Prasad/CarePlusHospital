<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Doctor;
use App\Models\PA;
use App\Models\Staff;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\LabTest;
use App\Observers\DoctorObserver;
use App\Observers\PAObserver;
use App\Observers\StaffObserver;
use App\Observers\PatientObserver;
use App\Observers\AppointmentObserver;
use App\Observers\LabTestObserver;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register observers
        Doctor::observe(DoctorObserver::class);
        PA::observe(PAObserver::class);
        Staff::observe(StaffObserver::class);
        Patient::observe(PatientObserver::class);
        Appointment::observe(AppointmentObserver::class);
        LabTest::observe(LabTestObserver::class);

        // Force HTTPS in production (for Render hosting)
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
    }
}