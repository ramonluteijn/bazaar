<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContractRequest;
use App\Models\Contract;
use App\Services\ContractService;

class ContractController extends Controller
{
    private ContractService $contractService;
    private array $types = ['pending', 'signed', 'rejected'];

    public function __construct(ContractService $contractService)
    {
        $this->contractService = $contractService;
    }

    public function index()
    {
        $contracts = Contract::all();
        return view('account.contracts', ['contracts' => $contracts]);
    }

    public function contract($id)
    {
        $contract = Contract::findOrFail($id);
        return view('account.contract', ['contract' => $contract, 'types' => $this->types]);
    }

    public function createContract()
    {
        return view('account.contract', ['types' => $this->types]);
    }

    public function storeContract(ContractRequest $request)
    {
        $this->contractService->storeContract($request);
        return to_route('contracts.index');
    }

    public function updateContract(ContractRequest $request, $id)
    {
        $this->contractService->updateContract($request, $id);
        return to_route('contract.show', $id);
    }

    public function deleteContract($id)
    {
        $this->contractService->deleteContract($id);
        return to_route('contracts.index');
    }

    public function downloadContract($id)
    {
        return $this->contractService->downloadContract($id);
    }
}
