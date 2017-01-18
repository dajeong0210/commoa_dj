@foreach( $products as $product)
    {{ $product->id }} <br>
    {{ $product->name }} <br>
    {{ $product->image }} <br>
    {{ $product->price }} <br><br>
@endforeach