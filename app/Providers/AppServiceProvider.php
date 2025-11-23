<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\InnerTransaction;
use App\Models\Invoice;
use App\Models\LogisticTeam;
use App\Models\Office;
use App\Models\OuterTransaction;
use App\Models\TechnicalTeam;
use App\Models\Workshop;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

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
    Relation::morphMap([
      'employee' => Employee::class,
      'invoice' => Invoice::class,
      'customer' => Customer::class,
      'admin' => Admin::class,
      'workshop' => Workshop::class,
      'office' => Office::class,
      'innerTransaction' => InnerTransaction::class,
      'outerTransaction' => OuterTransaction::class,
      'LogisticTeam' => LogisticTeam::class,
      'TechnicalTeam' => TechnicalTeam::class,
    ]);
  }
}
