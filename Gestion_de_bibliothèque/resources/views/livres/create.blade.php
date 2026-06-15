<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un Livre') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    <h3 class="text-2xl font-extrabold text-slate-800 mb-6 border-b pb-4">Nouveau Livre</h3>
                    
                    <form action="{{ route('livres.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="titre" class="block text-sm font-medium text-gray-700 mb-1">Titre</label>
                                <input type="text" name="titre" id="titre" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 transition duration-200 @error('titre') border-red-500 @enderror" value="{{ old('titre') }}" required>
                                @error('titre')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="auteur" class="block text-sm font-medium text-gray-700 mb-1">Auteur</label>
                                <input type="text" name="auteur" id="auteur" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 transition duration-200 @error('auteur') border-red-500 @enderror" value="{{ old('auteur') }}" required>
                                @error('auteur')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="md:col-span-2">
                                <label for="annee" class="block text-sm font-medium text-gray-700 mb-1">Année d'édition</label>
                                <input type="number" name="annee" id="annee" class="w-full md:w-1/2 rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 transition duration-200 @error('annee') border-red-500 @enderror" value="{{ old('annee') }}">
                                @error('annee')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <textarea name="description" id="description" rows="4" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 transition duration-200 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 pt-5 border-t border-gray-100">
                            <a href="{{ route('livres.index') }}" class="text-gray-500 hover:text-gray-700 mr-4 transition duration-150">Annuler</a>
                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 text-white font-bold rounded-xl shadow-lg transform hover:-translate-y-1 transition duration-300">
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
