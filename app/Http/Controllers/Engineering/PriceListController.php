<?php

namespace App\Http\Controllers\Engineering;

use App\Http\Controllers\Controller;
use App\Http\Requests\Engineering\PriceList\CreatePriceListRequest;
use App\Services\Engineering\PriceListService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PriceListController extends Controller
{
    public function __construct(
        protected PriceListService $service
    )
    {
    }

    public function index(): Response
    {
        return Inertia::render('Engineering/EngineeringPage',
            [
                'priceLists' => $this->service->getAll()
            ]
        );
    }

    public function create(CreatePriceListRequest $request): RedirectResponse
    {
        $this->service->create($request->validated());

        return redirect()->back()->with('success', 'Berhasil Membuat Kelompok Harga Satuan');
    }
}
