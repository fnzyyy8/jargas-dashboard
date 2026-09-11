<?php

namespace App\Http\Controllers\ProjectControl;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectControl\ItemDetail\CreateItemDetailRequest;
use App\Http\Requests\ProjectControl\ItemDetail\UpdateItemDetailRequest;
use App\Services\ProjectControl\ItemDetailService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class ItemDetailController extends Controller
{
    public function __construct(
        protected ItemDetailService $service
    )
    {
    }

    public function index()
    {
        return Inertia::render('projectControl/ItemDetail/ItemDetailPage', [

        ]);
    }

    public function create(CreateItemDetailRequest $request): RedirectResponse
    {
        $this->service->create($request->validated());
        return to_route('item-details.index')
            ->with('success', 'Item detail created successfully.');
    }

}
