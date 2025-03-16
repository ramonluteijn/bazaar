<?php

namespace App\Services;

use App\Http\Requests\ContractRequest;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\LaravelPdf\PdfBuilder;
use Spatie\LaravelPdf\Facades\Pdf;


class ContractService
{
    public function updateContract(ContractRequest $request, $id): void
    {
        $data = $request->validated();
        $contract = Contract::findOrFail($id);
        $contract->update($data);
    }

    public function storeContract(ContractRequest $request): void
    {
        $data = $request->validated();
        $data['owner_id'] = User::role('owner')->first()->id;
        Contract::create($data);
    }

    public function deleteContract($id): void
    {
        Contract::findOrFail($id)->delete();
    }

    public function downloadContract($id): PdfBuilder
    {
        $contract = Contract::findOrFail($id);

        $fileName = $contract->title;
        if ($contract->businessAdvertiser) {
            $fileName .= '_'.$contract->businessAdvertiser->name;
        }
        if ($contract->title == '') {
            $fileName = 'Contract_'.$contract->businessAdvertiser->name;
        }

        return Pdf::view('pdfs.contract', ['contract' => $contract])
            ->format('a4')
            ->name($fileName.'.pdf')
            ->download();
    }


    public function createContract(Request $request): void
    {
        $data = $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'signed_at' => 'nullable|date',
        ]);

        $data['business_advertiser_id'] = $request->user()->id;
        $data['owner_id'] = User::role('owner')->first()->id;

        Contract::create($data);
    }

}
