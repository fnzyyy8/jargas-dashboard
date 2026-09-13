<?php

namespace App\Http\Controllers\Engineering\UnitPrice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Engineering\UnitPrice\SyncUnitPriceRequest;
use App\Models\Engineering\PriceList\PriceList;
use App\Services\Engineering\PriceListService;
use App\Services\Engineering\UnitPriceService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class UnitPriceController extends Controller
{
    public function __construct(
        protected PriceListService $priceListService,
        protected UnitPriceService $unitPriceService
    )
    {
    }

    public function index(PriceList $priceList): Response
    {

        return Inertia::render('Engineering/UnitPrice/UnitPricePage',
            [
                'priceList' => $priceList,
                'unitPrice' => $this->unitPriceService->getPriceByPriceListId($priceList->id),
                'items' => $this->unitPriceService->getAllItemDetails()
            ]);
    }

    public function sync(SyncUnitPriceRequest $request, PriceList $priceList): RedirectResponse
    {
        $this->unitPriceService->sync(
            $priceList->id,
            $request->validated('item_detail_ids')
        );

        return redirect()
            ->back()
            ->with('success', 'Unit prices synchronized successfully.');

    }
}
