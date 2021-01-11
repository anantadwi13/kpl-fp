<?php

namespace App\Http\Controllers;

use App\Core\Domain\Model\Entity\UserAdmin;
use App\Core\UseCase\Dashboard\CountKategori;
use App\Core\UseCase\Dashboard\CountReport;
use App\Core\UseCase\Dashboard\CountReservasi;
use App\Core\UseCase\Dashboard\CountRuangan;
use App\Core\UseCase\Dashboard\CountUser;

class DashboardController extends Controller
{
    private CountKategori $countKategori;
    private CountReport $countReport;
    private CountReservasi $countReservasi;
    private CountRuangan $countRuangan;
    private CountUser $countUser;

    /**
     * DashboardController constructor.
     * @param CountKategori $countKategori
     * @param CountReport $countReport
     * @param CountReservasi $countReservasi
     * @param CountRuangan $countRuangan
     * @param CountUser $countUser
     */
    public function __construct(
        CountKategori $countKategori,
        CountReport $countReport,
        CountReservasi $countReservasi,
        CountRuangan $countRuangan,
        CountUser $countUser
    ) {
        $this->countKategori = $countKategori;
        $this->countReport = $countReport;
        $this->countReservasi = $countReservasi;
        $this->countRuangan = $countRuangan;
        $this->countUser = $countUser;
    }

    public function index()
    {
        $viewData = [
            'totalKategori' => $this->countKategori->execute(),
            'totalReport' => $this->getUser() ? $this->countReport->execute($this->getUser()) : null,
            'totalReservasi' => $this->getUser() ? $this->countReservasi->execute($this->getUser()) : null,
            'totalRuangan' =>  $this->countRuangan->execute($this->getUser()),
            'totalUser' => $this->getUser() instanceof UserAdmin ? $this->countUser->execute() : null,
        ];

        return view('dashboard.index', $viewData);
    }
}
