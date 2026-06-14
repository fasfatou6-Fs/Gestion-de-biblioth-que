<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Catalogue des Livres') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 flex justify-between items-center bg-gradient-to-r from-pink-50 to-purple-50 border-b border-purple-100">
                    <h3 class="text-lg font-bold text-slate-800">Liste des livres</h3>
                    <a href="{{ route('livres.create') }}" class="px-4 py-2 bg-pink-500 hover:bg-pink-600 text-white font-semibold rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
                        + Ajouter un livre
                    </a>
                </div>
                
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mx-6 mt-4 rounded shadow-sm transition-opacity" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <div class="p-6">
                    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                            <thead>
                                <tr class="text-left bg-purple-100 text-purple-700 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 cursor-pointer">Titre</th>
                                    <th class="py-3 px-6 cursor-pointer">Auteur</th>
                                    <th class="py-3 px-6 cursor-pointer">Année</th>
                                    <th class="py-3 px-6 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                @forelse ($livres as $livre)
                                    <tr class="border-b border-gray-200 hover:bg-pink-50 transition duration-150">
                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="font-medium text-gray-800">{{ $livre->titre }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            <span>{{ $livre->auteur }}</span>
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            <span>{{ $livre->annee }}</span>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex item-center justify-center space-x-3">
                                                <a href="{{ route('livres.edit', $livre->id) }}" class="w-4 mr-2 transform hover:text-pink-500 hover:scale-110 transition duration-150">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>
                                                <form action="{{ route('livres.destroy', $livre->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Êtes-vous sûr ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-4 transform hover:text-red-500 hover:scale-110 transition duration-150">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-6 px-6 text-center text-gray-500">Aucun livre disponible.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $livres->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
