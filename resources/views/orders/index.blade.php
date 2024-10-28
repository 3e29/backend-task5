<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Orders List</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Orders List</h2>
        <a href="/" class="btn btn-primary">Home</a>
        <div class="row mt-5">
            @foreach($orders as $order)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order ID: {{ $order->id }}</h5>
                            <p class="card-text"><strong>User:</strong> {{ $order->user->name }}</p>
                            <p class="card-text"><strong>Product:</strong> {{ $order->product->name }}</p>
                            <p class="card-text"><strong>Status:</strong> {{ $order->status }}</p>
                            <p class="card-text"><strong>Created At:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
