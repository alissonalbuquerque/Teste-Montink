<x-app-layout title="{{ __('Cart') }}">

    <x-slot name="main">

        <div class="border border-rounded px-2">
            <h1 class="h2 text-muted"> {{ __('Cart') }}</h1>
        </div>

        <div class="border border-rounded my-4 p-4">

            <form action="{{route('cart.order')}}" method="POST">

                @csrf
                @method('POST')

                @foreach ($collection as $vproduct)

                    @if(!$loop->last) 
                        <input type="hidden" name="items[{{$vproduct->variant->id}}][variant_id]" value="{{$vproduct->variant->id}}">
                        <input type="hidden" name="items[{{$vproduct->variant->id}}][price]"      value="{{$vproduct->price}}">
                        <input type="hidden" name="items[{{$vproduct->variant->id}}][units]"      value="{{$vproduct->units}}">
                        <input type="hidden" name="items[{{$vproduct->variant->id}}][subtotal]"   value="{{$vproduct->subtotal}}">
                    @endif
                    
                @endforeach

                <div class="border border-rounded px-2 my-4">

                    <table class="table table-hover text-center align-middle">
                    
                        <thead>
                            <tr>
                                <th class="text-muted" scope="col">{{__('#')}}</th>
                                <th class="text-muted" scope="col">{{__('Product')}}</th>
                                <th class="text-muted" scope="col">{{__('Price')}}</th>
                                <th class="text-muted" scope="col">{{__('Units')}}</th>
                                <th class="text-muted" scope="col">{{__('SubTotal')}}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($collection as $vproduct)
                                <tr>
                                    <th scope="row"> @if(!$loop->last) {{ $loop->iteration }} @else {{ __('Total') }} @endif </th>
                                    <td> {{ $vproduct->fmt_variation }}</td>
                                    <td> {{ $vproduct->fmt_price }}</td>
                                    <td> {{ $vproduct->units }}</td>
                                    <td> {{ $vproduct->fmt_subtotal }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    
                    </table>

                </div>

                <div class="text-end">
                    <div class="btn-group">

                        <div class="mx-1">
                            <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left-circle"></i> {{ __('Back') }}
                            </a>
                        </div>

                        <div class="mx-1">
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="bi bi-cart-check"></i> {{ __('Close :action', ['action' => __('Cart')]) }}
                            </button>
                        </div>

                    </div>
                </div>

            </form>

        </div>

    </x-slot>

</x-app-layout>
