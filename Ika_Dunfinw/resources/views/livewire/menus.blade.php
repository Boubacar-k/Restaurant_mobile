<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Menus') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
            <button wire:click="create()" class="bg-red-100 hover:bg-red-100 text-black font-bold py-2 px-4 rounded my-3">Create New Menu</button>
            @if($isOpen)
                @include('livewire.create')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">Number</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Url</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menus as $menu)
                    <tr>
                        <td class="border px-4 py-2">{{ $menu->id }}</td>
                        <td class="border px-4 py-2">{{ $menu->nom }}</td>
                        <td class="border px-4 py-2">{{ $menu->prix }}</td>
                        <td class="border px-4 py-2">{{ $menu->url }}</td>
                        <td class="border px-4 py-2">
                        <button wire:click="edit({{ $menu->id }})" class="bg-red-100 hover:bg-red-100 text-black font-bold py-2 px-4 rounded">Edit</button>
                            <button wire:click="delete({{ $menu->id }})" class="bg-red-100 hover:bg-red-100 text-black font-bold py-2 px-4 rounded">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>