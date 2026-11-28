{{-- ── Product Form Fields (shared partial) ── --}}

<div class="prod-field mb-4">
    <label for="sku" class="prod-label">
        <i class="bi bi-upc me-1"></i> Product ID / SKU
    </label>
    @if (isset($product))
        <input
            id="sku"
            type="text"
            name="sku"
            class="form-control prod-input @error('sku') is-invalid @enderror"
            value="{{ old('sku', $product->sku) }}"
            maxlength="50"
            pattern="[A-Za-z0-9][A-Za-z0-9._\-]*"
            required
        >
    @else
        <select
            id="sku"
            name="sku"
            class="form-control prod-input @error('sku') is-invalid @enderror"
            onchange="const option = this.selectedOptions[0]; this.form.elements.name.value = option.dataset.name || ''; this.form.elements.price.value = option.dataset.price || '';"
        >
            <option value="">Add by name — generate ID for new products</option>
            @foreach ($existingProducts as $existingProduct)
                <option
                    value="{{ $existingProduct->sku }}"
                    data-name="{{ $existingProduct->name }}"
                    data-price="{{ $existingProduct->price }}"
                    @selected(old('sku') === $existingProduct->sku)
                >{{ $existingProduct->name }} ({{ $existingProduct->sku }})</option>
            @endforeach
        </select>
    @endif
    @error('sku')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <div class="prod-hint">
        @if (isset($product))
            Each product must have a unique ID.
        @else
            A new name gets an automatic Product ID. An existing name adds stock to the original product, even with different capitalization or extra spaces.
            To restock, select an existing product and enter the quantity to add.
            Its name, price, and image will stay unchanged.
        @endif
    </div>
</div>
<div class="prod-field mb-4">
    <label for="name" class="prod-label">
        <i class="bi bi-tag me-1"></i> Product Name
    </label>
    <input
        id="name"
        type="text"
        name="name"
        class="form-control prod-input @error('name') is-invalid @enderror"
        value="{{ old('name', $product->name ?? '') }}"
        placeholder="e.g. Mineral Water 500ml"
        required
    >
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="prod-field">
            <label for="price" class="prod-label">
                <i class="bi bi-currency-exchange me-1"></i> Price (₱)
            </label>
            <div class="input-group">
                <span class="prod-input-prefix">₱</span>
                <input
                    id="price"
                    type="number"
                    name="price"
                    step="0.01"
                    min="0.01"
                    class="form-control prod-input prod-input-addon @error('price') is-invalid @enderror"
                    value="{{ old('price', $product->price ?? '') }}"
                    placeholder="0.00"
                    required
                >
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="prod-field">
            <label for="stock_quantity" class="prod-label">
                <i class="bi bi-layers me-1"></i> Stock Quantity
            </label>
            <input
                id="stock_quantity"
                type="number"
                name="stock_quantity"
                min="0"
                class="form-control prod-input @error('stock_quantity') is-invalid @enderror"
                value="{{ old('stock_quantity', $product->stock_quantity ?? 0) }}"
                placeholder="0"
                required
            >
            @error('stock_quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="prod-field mb-1">
    <label for="image" class="prod-label">
        <i class="bi bi-image me-1"></i> Product Image
        <span class="prod-label-optional">optional</span>
    </label>
    <input
        id="image"
        type="file"
        name="image"
        accept="image/*"
        class="form-control prod-input @error('image') is-invalid @enderror"
    >
    <div class="prod-hint">Accepted formats: JPG, PNG, GIF, WebP — max 2 MB.</div>
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @if (!empty($product?->image))
        <div class="prod-current-image mt-3">
            <img
                src="{{ asset('storage/' . $product->image) }}"
                alt="{{ $product->name }}"
                class="prod-image-preview"
                onerror="this.outerHTML='<span class=\'pos-thumb-empty\' style=\'width:72px;height:72px;font-size:1.5rem;\'><i class=\'bi bi-image\'></i></span>'"
            >
            <div class="prod-current-image-label">
                <div class="prod-current-image-title">Current image</div>
                <div class="prod-current-image-hint">Upload a new file to replace it</div>
                <div class="form-check mt-2">
                    <input
                        id="remove_image"
                        type="checkbox"
                        name="remove_image"
                        value="1"
                        class="form-check-input @error('remove_image') is-invalid @enderror"
                        aria-describedby="remove_image-hint"
                        @checked(old('remove_image'))
                    >
                    <label for="remove_image" class="form-check-label small text-danger">Remove current image</label>
                    @error('remove_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div id="remove_image-hint" class="prod-hint">Save to return to the placeholder. If you select a new file, it replaces the image instead.</div>
            </div>
        </div>
    @endif
</div>
