@if ($errors->any())
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <p><span class="font-medium">Ошибки при сохранении:</span></p>
        <ul class="mt-2 space-y-1 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
        data-tabs-toggle="#default-tab-content" role="tablist">
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="info-tab" data-tabs-target="#info-tab-content"
                    type="button" role="tab" aria-controls="info-tab" aria-selected="false">Основное
            </button>
        </li>
        <li class="me-2" role="presentation">
            <button
                class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                id="spec-tab" data-tabs-target="#spec-tab-content" type="button" role="tab"
                aria-controls="spec-tab-content"
                aria-selected="false">Технические параметры
            </button>
        </li>
        <li class="me-2" role="presentation">
            <button
                class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                id="cabin-categories-tab" data-tabs-target="#cabin-categories-tab-content" type="button" role="tab"
                aria-controls="cabin-categories-tab-content"
                aria-selected="false">Каюты
            </button>
        </li>
        <li class="me-2" role="presentation">
            <button
                class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                id="gallery-tab" data-tabs-target="#gallery-tab-content" type="button" role="tab"
                aria-controls="gallery-tab-content"
                aria-selected="false">Галерея
            </button>
        </li>
    </ul>
</div>
<div id="default-tab-content">
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800"
         id="info-tab-content"
         role="tabpanel"
         aria-labelledby="info-tab">
        <ship-info title="{{ old('title', $ship->title ?? null) }}"
                   description="{{ old('description', $ship->description ?? null) }}"/>
    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="cabin-categories-tab-content" role="tabpanel"
         aria-labelledby="cabin-categories-tab">
        <ship-cabin-categories-list
            :cabin-categories="{{ json_encode(array_values(old('cabins', $ship->cabinCategories->toArray() ?? []))) }}"
            :types="{{ json_encode($cabinCategoryTypes) }}"
        ></ship-cabin-categories-list>
    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="spec-tab-content" role="tabpanel"
         aria-labelledby="spec-tab">
        <ship-spec :spec="{{ json_encode(old('spec', $ship->spec ?? [])) }}"></ship-spec>
    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="gallery-tab-content" role="tabpanel"
         aria-labelledby="gallery-tab">
        <ship-gallery :items="{{ json_encode(array_values(old('gallery', $ship->gallery->toArray() ?? []))) }}"/>
    </div>
</div>
