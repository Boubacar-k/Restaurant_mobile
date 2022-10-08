<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Commandes') }}
    </h2>
</x-slot>

<div class="py-12">
    <div>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
        
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">Numéro</th>
                        <th class="px-4 py-2 w-20">Client</th>
                        <th class="px-4 py-2">Menu</th>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Prix</th>
                        <th class="px-4 py-2">Paiement</th>
                        <th class="px-4 py-2">Adresse</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commandes as $commande)
                    <tr>
                        <td class="border px-4 py-2">{{ $commande->id }}</td>
                        <td class="border px-4 py-2">{{ $commande->name }}</td>
                        <td class="border px-4 py-2">{{ $commande->nom }}</td>
                        <td class="border px-4 py-2">{{ $commande->nombre }}</td>
                        <td class="border px-4 py-2">{{ $commande->prix }}</td>
                        <td class="border px-4 py-2">{{ $commande->payement }}</td>
                        <td class="border px-4 py-2">{{ $commande->adresse }}</td>
                        <td class="border px-4 py-2">
                        <button wire:click="edit({{ $commande->id }})" class="bg-red-100 hover:bg-red-100 text-black font-bold py-2 px-4 rounded">Valider</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>