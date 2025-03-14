<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContractRequest;
use App\Models\Contract;
use App\Services\ContractService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\LaravelPdf\PdfBuilder;

class ContractController
{
    private ContractService $contractService;
    private array $types = ['pending' => 'pending', 'signed' => 'signed', 'rejected' => 'rejected'];

    public function __construct(ContractService $contractService)
    {
        $this->contractService = $contractService;
    }

    public function index(): View
    {
        $contracts = Contract::all();
        return view('contract.index', ['contracts' => $contracts]);
    }

    public function show($id): View
    {
        $contract = Contract::findOrFail($id);
        return view('contract.show', ['contract' => $contract, 'types' => $this->types]);
    }

    public function create(): View
    {
        return view('contract.show', ['types' => $this->types]);
    }

    public function store(ContractRequest $request): RedirectResponse
    {
        $this->contractService->storeContract($request);
        return to_route('contracts.index');
    }

    public function update(ContractRequest $request, $id): RedirectResponse
    {
        $this->contractService->updateContract($request, $id);
        return to_route('contracts.show', $id);
    }

    public function delete($id): RedirectResponse
    {
        $this->contractService->deleteContract($id);
        return to_route('contracts.index');
    }

    public function download($id): PdfBuilder
    {
        return $this->contractService->downloadContract($id);
    }
}
