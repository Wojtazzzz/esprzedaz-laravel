<?php

declare(strict_types=1);

namespace Src\Modules\Pets\Api\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Src\Common\Exceptions\DomainException;
use Src\Modules\Pets\Api\Requests\StoreRequest;
use Src\Modules\Pets\Api\Requests\UpdateRequest;
use Src\Modules\Pets\Application\Services\PetService;
use Throwable;

class PetController extends Controller
{
    public function __construct(
        private readonly PetService $petService
    )
    {
        $this->loadViews([
            'pets' => __DIR__ . '/../Views/'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pets::create_pet');
    }

    /**
     * Store a newly created resource in storage.
     * @throws DomainException
     */
    public function store(StoreRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $createPetDto = $request->toDto();

        $petId = $this->petService->createPet($createPetDto);

        return redirect()->route('pets.show', ['id' => $petId])->with('message', 'Pet created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $pet = null;

        if ($request->query('id')) {
            $pet = $this->petService->getPetById($request->query('id'));
        }

        return view('pets::show_pet', [
            'pet' => $pet
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @throws Throwable
     */
    public function edit(string $id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $pet = $this->petService->getPetById($id);

        abort_if(!$pet, 404);

        return view('pets::edit_pet', [
            'pet' => $pet
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @throws Throwable
     */
    public function update(UpdateRequest $request, string $id): RedirectResponse
    {
        $updatePetDto = $request->toDto();

        $this->petService->updatePet($updatePetDto);

        return redirect()->route('pets.show', ['id' => $id])->with('message', 'Pet update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        if ($this->petService->deletePetById($id)) {
            return redirect()->route('pets.show')->with('message', "Pet {$id} deleted successfully!");
        }

        return redirect()->route('pets.show', ['id' => $id])->with('error', "Pet {$id} not found!");
    }
}
