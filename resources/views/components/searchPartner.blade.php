<form action="{{ isset($action) ? $action : '' }}" class="search-partner">
    <input name="query" type="text" value="{{ (isset($value)?$value:'') }}" placeholder="{{ isset($placeholder) ? $placeholder : "Cari disini... (tekan '/' untuk mencari)" }}">
    <button class="search-icon-container">
        <i class="bi bi-search pointer"></i>
    </button>
</form>