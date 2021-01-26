<?php

namespace App\Http\Controllers;

use App\Core\Domain\Exception\EntityInvalidAttributeException;
use App\Core\Domain\Exception\RepositoryDeleteException;
use App\Core\Domain\Exception\RepositoryPersistException;
use App\Core\Domain\Model\Entity\UserAdmin;
use App\Core\Domain\Model\Entity\UserPenyedia;
use App\Core\UseCase\Kategori\GetListKategori;
use App\Core\UseCase\Ruangan\DeleteRuangan;
use App\Core\UseCase\Ruangan\EditRuangan;
use App\Core\UseCase\Ruangan\EditRuanganParams;
use App\Core\UseCase\Ruangan\EntryRuangan;
use App\Core\UseCase\Ruangan\EntryRuanganParams;
use App\Core\UseCase\Ruangan\GetListRuangan;
use App\Core\UseCase\Ruangan\GetRuangan;
use App\Core\UseCase\Wilayah\GetListKecamatan;
use App\Core\UseCase\Wilayah\GetListKotaKab;
use App\Core\UseCase\Wilayah\GetListProvinsi;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class RuanganController extends Controller
{
    private GetListRuangan $getListRuangan;
    private GetListKategori $getListKategori;
    private GetListProvinsi $getListProvinsi;
    private GetListKotaKab $getListKotaKab;
    private GetListKecamatan $getListKecamatan;
    private EntryRuangan $entryRuangan;
    private GetRuangan $getRuangan;
    private EditRuangan $editRuangan;
    private DeleteRuangan $deleteRuangan;

    /**
     * RuanganController constructor.
     * @param GetListRuangan $getListRuangan
     * @param GetListKategori $getListKategori
     * @param GetListProvinsi $getListProvinsi
     * @param GetListKotaKab $getListKotaKab
     * @param GetListKecamatan $getListKecamatan
     * @param EntryRuangan $entryRuangan
     * @param GetRuangan $getRuangan
     * @param EditRuangan $editRuangan
     * @param DeleteRuangan $deleteRuangan
     */
    public function __construct(
        GetListRuangan $getListRuangan,
        GetListKategori $getListKategori,
        GetListProvinsi $getListProvinsi,
        GetListKotaKab $getListKotaKab,
        GetListKecamatan $getListKecamatan,
        EntryRuangan $entryRuangan,
        GetRuangan $getRuangan,
        EditRuangan $editRuangan,
        DeleteRuangan $deleteRuangan
    ) {
        $this->getListRuangan = $getListRuangan;
        $this->getListKategori = $getListKategori;
        $this->getListProvinsi = $getListProvinsi;
        $this->getListKotaKab = $getListKotaKab;
        $this->getListKecamatan = $getListKecamatan;
        $this->entryRuangan = $entryRuangan;
        $this->getRuangan = $getRuangan;
        $this->editRuangan = $editRuangan;
        $this->deleteRuangan = $deleteRuangan;

        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('penyedia.ruangan.only')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|Application|Response|View
     */
    public function index()
    {
        $dataRuangan = $this->getListRuangan->execute($this->getAuthenticatedUser());

        $user = $this->getAuthenticatedUser();

        return view('ruangan.index')->with(compact('dataRuangan', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|Application|Response|View
     */
    public function create()
    {
        $kategori = $this->getListKategori->execute();

        $provinsi = $this->getListProvinsi->execute();
        $kota = old('provinsi') ? $this->getListKotaKab->execute(old('provinsi')) : [];
        $kecamatan = old('kota') ? $this->getListKecamatan->execute(old('kota')) : [];

        return view('ruangan.create')->with(compact('kategori', 'provinsi', 'kota', 'kecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Application|RedirectResponse|Response|Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string',
            'kode' => 'nullable',
            'kategori' => 'required|exists:kategori,id',
            'alamat' => 'required_with:provinsi,kota,kecamatan|nullable|string',
            'provinsi' => 'required_with:alamat|nullable|exists:provinsi,id',
            'kota' => 'required_with:alamat|nullable|exists:kota_kab,id',
            'kecamatan' => 'required_with:alamat|nullable|exists:kecamatan,id',
        ], [
            'nama.required' => 'Nama harus diisi!',
            'kategori.required' => 'Kategori harus diisi!',
            'kategori.exists' => 'Kategori tidak sesuai!',
            'alamat.required_with' => 'Alamat harus diisi ketika provinsi/kota/kecamatan terisi!',
            'provinsi.required_with' => 'Provinsi harus diisi ketika alamat terisi!',
            'provinsi.exists' => 'Provinsi tidak sesuai!',
            'kota.required_with' => 'Kota harus diisi ketika alamat terisi!',
            'kota.exists' => 'Kota tidak sesuai!',
            'kecamatan.required_with' => 'Kecamatan harus diisi ketika alamat terisi!',
            'kecamatan.exists' => 'Kecamatan tidak sesuai!',
        ]);

        $params = new EntryRuanganParams();
        $params->nama = $request->input('nama');
        $params->kode = $request->input('kode');
        $params->idKategori = $request->input('kategori');
        $params->penyedia = $this->getAuthenticatedUser();
        $params->alamatJalan = $request->input('alamat');
        $params->idKecamatan = $request->input('kecamatan');

        try {
            $this->entryRuangan->execute($params);
            return redirect(route("ruangan.index"))->with('success', 'Ruangan berhasil dimasukkan!');
        } catch (EntityInvalidAttributeException $exception) {
            return redirect()->back()->withErrors(['Harap lengkapi formulir!']);
        } catch (Exception $exception) {
            return redirect()->back()->withErrors(['Gagal menyimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return Factory|Application|RedirectResponse|View
     */
    public function show(Request $request)
    {
        $ruangan = $this->getRuangan->execute($request->ruangan);

        if (!$ruangan) {
            return redirect()->back()->withErrors(['Ruangan tidak ditemukan!']);
        }

        return view('ruangan.show')->with(compact('ruangan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @return Factory|Application|RedirectResponse|View
     */
    public function edit(Request $request)
    {
        $ruangan = $this->getRuangan->execute($request->ruangan);

        if (!$ruangan) {
            return redirect()->back()->withErrors(['Ruangan tidak ditemukan!']);
        }

        if (!$this->getAuthenticatedUser() instanceof UserPenyedia && !$this->getAuthenticatedUser() instanceof UserAdmin) {
            return redirect()->withErrors(['Unauthorized page!']);
        }

        $kategori = $this->getListKategori->execute();
        $provinsi = $this->getListProvinsi->execute();
        $idKecamatan = $ruangan->getAlamat() ? $ruangan->getAlamat()->getKecamatan()->getId() : null;
        $idKota = $ruangan->getAlamat() ? $ruangan->getAlamat()->getKotaKab()->getId() : null;
        $idProvinsi = $ruangan->getAlamat() ? $ruangan->getAlamat()->getProvinsi()->getId() : null;
        $kota = $ruangan->getAlamat() ? $this->getListKotaKab->execute($idProvinsi->getValue()) : [];
        $kecamatan = $ruangan->getAlamat() ? $this->getListKecamatan->execute($idKota->getValue()) : [];

        return view('ruangan.edit')->with(compact('ruangan', 'kategori', 'provinsi', 'kota',
            'kecamatan', 'idKecamatan', 'idKota', 'idProvinsi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse|Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $ruangan = $this->getRuangan->execute($request->ruangan);

        if (!$ruangan) {
            return redirect()->back()->withErrors(['Ruangan tidak ditemukan!']);
        }

        if (!$this->getAuthenticatedUser() instanceof UserPenyedia && !$this->getAuthenticatedUser() instanceof UserAdmin) {
            return redirect()->withErrors(['Unauthorized page!']);
        }

        $this->validate($request, [
            'nama' => 'required|string',
            'kode' => 'nullable',
            'status' => 'required|boolean',
            'kategori' => 'required|exists:kategori,id',
            'alamat' => 'required_with:provinsi,kota,kecamatan|nullable|string',
            'provinsi' => 'required_with:alamat|nullable|exists:provinsi,id',
            'kota' => 'required_with:alamat|nullable|exists:kota_kab,id',
            'kecamatan' => 'required_with:alamat|nullable|exists:kecamatan,id',
        ], [
            'nama.required' => 'Nama harus diisi!',
            'status.required' => 'Status harus diisi!',
            'status.boolean' => 'Status tidak valid!',
            'kategori.required' => 'Kategori harus diisi!',
            'kategori.exists' => 'Kategori tidak sesuai!',
            'alamat.required_with' => 'Alamat harus diisi ketika provinsi/kota/kecamatan terisi!',
            'provinsi.required_with' => 'Provinsi harus diisi ketika alamat terisi!',
            'provinsi.exists' => 'Provinsi tidak sesuai!',
            'kota.required_with' => 'Kota harus diisi ketika alamat terisi!',
            'kota.exists' => 'Kota tidak sesuai!',
            'kecamatan.required_with' => 'Kecamatan harus diisi ketika alamat terisi!',
            'kecamatan.exists' => 'Kecamatan tidak sesuai!',
        ]);

        $params = new EditRuanganParams();
        $params->latestRuangan = $ruangan;
        $params->nama = $request->input('nama');
        $params->kode = $request->input('kode');
        $params->idKategori = $request->input('kategori');
        $params->alamatJalan = $request->input('alamat');
        $params->idKecamatan = $request->input('kecamatan');
        $params->status = $request->input('status');

        try {
            $this->editRuangan->execute($params);
            return redirect(route("ruangan.index"))->with('success', 'Ruangan berhasil diupdate!');
        } catch (EntityInvalidAttributeException $e) {
            return redirect()->back()->withErrors(['Harap lengkapi formulir!']);
        } catch (RepositoryPersistException $e) {
            return redirect()->back()->withErrors(['Gagal menyimpan!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function destroy(Request $request)
    {
        $ruangan = $this->getRuangan->execute($request->ruangan);

        if (!$ruangan) {
            return redirect()->back()->withErrors(['Ruangan tidak ditemukan!']);
        }

        if (!$this->getAuthenticatedUser() instanceof UserPenyedia && !$this->getAuthenticatedUser() instanceof UserAdmin) {
            return redirect()->withErrors(['Unauthorized page!']);
        }

        try {
            $this->deleteRuangan->execute($ruangan);
            return redirect(route("ruangan.index"))->with('success', 'Ruangan berhasil dihapus!');
        } catch (RepositoryDeleteException $e) {
            return redirect()->back()->withErrors(['Gagal menghapus Ruangan!']);
        }
    }
}
