<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Product Details</h2>
        <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm mb-2">Back</a>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Name: {{ $product->name }}</h5>
                <p class="card-text"><strong>Description:</strong> {{ $product->description }}</p>
                <p class="card-text"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>
                <p class="card-text"><strong>Categories:</strong>
                    @if($product->categories->isEmpty())
                        No categories assigned.
                    @else
                        <ul>
                            @foreach($product->categories as $category)
                                <li>{{ $category->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                </p>
                <div class="mb-3">
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
