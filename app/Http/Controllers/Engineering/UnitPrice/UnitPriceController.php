<?php

namespace App\Http\Controllers\Engineering\UnitPrice;

use App\Http\Controllers\Controller;
use App\Services\Engineering\PriceListService;
use App\Services\Engineering\UnitPriceService;
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

    public function index(int $priceListId): Response
    {
        $priceList = $this->priceListService->getDetailWithPrices($priceListId);
        return Inertia::render('Engineering/UnitPrice/UnitPricePage', [
            'unitPrice' => $priceList,
            'items' => $this->unitPriceService->getAllItemDetails()
        ]);
    }
}
