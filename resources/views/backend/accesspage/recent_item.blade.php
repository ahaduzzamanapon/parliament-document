    @foreach($documents as $i => $document)
        @php
            $p_cat_id = isset($document->category->parent_category_id)?$document->category->parent_category_id: '';
        @endphp

        <div data-id="{{ $p_cat_id }}" data-own="1" data-name="{{ $document->event_name}}" data-type="folder" onClick="fetch_data('{{ $p_cat_id}}')" class="cursor-pointer flex items-center gap-3">
            <span class="text-16 font-solaimans font-medium">{{$i + 1}}.</span>
            <h1 class="text-16 font-solaimans font-medium">{{ $document->event_name}}</h1>
        </div>
    @endforeach