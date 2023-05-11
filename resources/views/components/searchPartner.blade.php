<form action="{{ isset($action) ? $action : '' }}" class="search-container">
    <input name="search" type="text" value="{{ (isset($value)?$value:'') }}" placeholder="{{ isset($placeholder) ? $placeholder : "Cari disini... (tekan '/' untuk mencari)" }}">
    <button class="search-icon-container">
        <i class="bi bi-search pointer"></i>
    </button>
</form>