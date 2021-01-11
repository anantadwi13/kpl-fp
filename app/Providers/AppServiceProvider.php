<?php

namespace App\Providers;

use App\Core\Domain\Repository\KategoriRepository;
use App\Core\Domain\Repository\ReportRepository;
use App\Core\Domain\Repository\ReservasiRepository;
use App\Core\Domain\Repository\RuanganRepository;
use App\Core\Domain\Repository\UserRepository;
use App\Core\UseCase\Dashboard\CountKategori;
use App\Core\UseCase\Dashboard\CountReport;
use App\Core\UseCase\Dashboard\CountReservasi;
use App\Core\UseCase\Dashboard\CountRuangan;
use App\Core\UseCase\Dashboard\CountUser;
use App\Core\UseCase\Kategori\GetListKategori;
use App\Core\UseCase\Report\GetListReport;
use App\Core\UseCase\Reservasi\GetListReservasi;
use App\Core\UseCase\Ruangan\GetListRuangan;
use App\Core\UseCase\User\GetListUser;
use App\Repository\KategoriRepositoryImpl;
use App\Repository\ReportRepositoryImpl;
use App\Repository\ReservasiRepositoryImpl;
use App\Repository\RuanganRepositoryImpl;
use App\Repository\UserRepositoryImpl;
use App\Transformer\KategoriTransformer;
use App\Transformer\KecamatanTransformer;
use App\Transformer\KotaKabTransformer;
use App\Transformer\ProvinsiTransformer;
use App\Transformer\ReportTransformer;
use App\Transformer\ReservasiTransformer;
use App\Transformer\RuanganTransformer;
use App\Transformer\UserTransformer;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $this->app->singleton(KecamatanTransformer::class);
        $this->app->singleton(KotaKabTransformer::class);
        $this->app->singleton(ProvinsiTransformer::class);
        $this->app->singleton(UserTransformer::class);
        $this->app->singleton(KategoriTransformer::class);
        $this->app->singleton(ReportTransformer::class);
        $this->app->singleton(RuanganTransformer::class);
        $this->app->singleton(ReservasiTransformer::class);

        $this->app->singleton(KategoriRepository::class, function () use ($app) {
            return $app->make(KategoriRepositoryImpl::class);
        });
        $this->app->singleton(ReportRepository::class, function () use ($app) {
            return $app->make(ReportRepositoryImpl::class);
        });
        $this->app->singleton(ReservasiRepository::class, function () use ($app) {
            return $app->make(ReservasiRepositoryImpl::class);
        });
        $this->app->singleton(RuanganRepository::class, function () use ($app) {
            return $app->make(RuanganRepositoryImpl::class);
        });
        $this->app->singleton(UserRepository::class, function () use ($app) {
            return $app->make(UserRepositoryImpl::class);
        });

        $this->app->singleton(CountKategori::class);
        $this->app->singleton(CountReport::class);
        $this->app->singleton(CountReservasi::class);
        $this->app->singleton(CountRuangan::class);
        $this->app->singleton(CountUser::class);
        $this->app->singleton(GetListKategori::class);
        $this->app->singleton(GetListReport::class);
        $this->app->singleton(GetListReservasi::class);
        $this->app->singleton(GetListRuangan::class);
        $this->app->singleton(GetListUser::class);
    }
}
