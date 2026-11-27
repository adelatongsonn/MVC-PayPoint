<label>Product Name</label>
<input
    type="text"
    name="name"
    value="{{ old('name', $product->name ?? '') }}"
    required
>

<br><br>

<label>Price</label>
<input
    type="number"
    name="price"
    step="0.01"
    min="0.01"
    value="{{ old('price', $product->price ?? '') }}"
    required
>

<br><br>

<label>Stock Quantity</label>
<input
    type="number"
    name="stock_quantity"
    min="0"
    value="{{ old('stock_quantity', $product->stock_quantity ?? 0) }}"
    required
>

<br><br>

<label>Product Image</label>
<input
    type="file"
    name="image"
    accept="image/*"
>

<br><br>