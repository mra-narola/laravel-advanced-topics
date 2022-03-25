<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cart Example</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

</head>
<body>
    <div class="container pt-4">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <p class="m-0">{{ session('success') }}</p>
            </div>
        @endif
        <div class="jumbotron">
            <section>
                <h4>Add New Item</h4>
                <form action="{{ route('cart-item.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" placeholder="Item Name" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" name="price" id="price" placeholder="Item Price" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" name="quantity" id="quantity" placeholder="Item quantity" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="quantity">Options</label>

                                <div class="form-check">
                                    <input class="form-check-input" name="options" type="radio" value="cod" id="cod">
                                    <label class="form-check-label" for="cod">COD</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="options" type="radio" value="net-banking" id="online">
                                    <label class="form-check-label" for="net-banking">Net Banking</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="options" type="radio" value="" id="cc-dc">
                                    <label class="form-check-label" for="cc-dc">Credit Card / Debit Card</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Add" class="btn btn-primary" />
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>

    <div class="container pt-4">
        <div class="jumbotron">
            <section>
                <h4>Items List</h4>
                <div class="w-1/4">
                    <div class="p-5 mx-2 my-2 max-w-md rounded border-2">
                        @if ($content->count() > 0)
                            @foreach ($content as $id => $item)
                                <p class="text-2xl text-right mb-2">
                                    <button class="text-sm p-2 border-2 rounded border-gray-200 hover:border-gray-300 bg-gray-200 hover:bg-gray-300"> - </button>
                                    {{ $item->get('name') }} x {{ $item->get('quantity') }}
                                    <button class="text-sm p-2 border-2 rounded border-gray-200 hover:border-gray-300 bg-gray-200 hover:bg-gray-300"> + </button>
                                    <button class="text-sm p-2 border-2 rounded border-red-500 hover:border-red-600 bg-red-500 hover:bg-red-600">Remove</button>
                                </p>
                            @endforeach
                            <hr class="my-2">
                            <p class="text-xl text-right mb-2">Total: ${{ $total }}</p>
                            <button class="w-full p-2 border-2 rounded border-red-500 hover:border-red-600 bg-red-500 hover:bg-red-600">Clear Cart</button>
                        @else
                            <p class="text-3xl mb-2">cart is empty!</p>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </div>

</body>
</html>