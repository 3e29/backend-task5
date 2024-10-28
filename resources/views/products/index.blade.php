<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Products List</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Products List</h2>
        <a href="/" class="btn btn-primary">Home</a>
        <a href="{{ route('products.create') }}" class="btn btn-success">Add New Product</a>
        <div class="row mt-5">
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                            <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>
                            @if(!$product->deleted_at)
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">Show</a>
                            @endif
                            @if($product->deleted_at)
                                <form action="{{ route('products.restore', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-info">Restore</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
