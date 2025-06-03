<x-app-layout title="{{ __('Confirm Order') }}">

    <x-slot name="main">

        <div class="border border-rounded px-2">
            <h1 class="h2 text-muted"> {{ __('Confirm Order') }}</h1>
        </div>

        <div class="border border-rounded my-4 p-4">

            <form action="{{route('buy.finish')}}" method="POST">

                @csrf
                @method('POST')

                <input type="hidden" id="email" name="email" value="{{ $order['email'] }}">
                <input type="hidden" id="cupom_id" name="cupom_id" value="{{ $order['cupom_id'] }}">
                <input type="hidden" id="buy" name="buy" value="{{ $order['buy'] }}">
                <input type="hidden" id="frete" name="frete" value="{{ $order['frete'] }}">
                <input type="hidden" id="cupom" name="cupom" value="{{ $order['cupom'] }}">                
                <input type="hidden" id="subtotal" name="subtotal" value="{{ $order['initial'] }}">
                <input type="hidden" id="status" name="status" value="{{ 'finished' }}">
                <input type="hidden" id="payment_method" name="payment_method" value="{{ 'card' }}">

                @foreach ($collection as $vproduct)

                    @if(!$loop->last) 
                        <input type="hidden" name="items[{{$vproduct->variant->id}}][product_id]"  value="{{$vproduct->product->id}}">
                        <input type="hidden" name="items[{{$vproduct->variant->id}}][variant_id]"  value="{{$vproduct->variant->id}}">
                        <input type="hidden" name="items[{{$vproduct->variant->id}}][unit_price]"  value="{{$vproduct->price}}">
                        <input type="hidden" name="items[{{$vproduct->variant->id}}][quantity]"    value="{{$vproduct->units}}">
                        <input type="hidden" name="items[{{$vproduct->variant->id}}][total_price]" value="{{$vproduct->subtotal}}">
                    @endif
                    
                @endforeach

                <div class="mb-4">
                    <div class="border border-rounded px-2">
                        <h1 class="h3 text-muted"> {{ __('Cofirm Datas') }}</h1>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="border border-rounded px-2">
                        <h1 class="h5 text-muted"> {{ __('E-mail : :content', ['content' => $order['email']]) }}</h1>
                    </div>
                </div>

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

                <div class="mb-4">
                    <div class="border border-rounded px-2">
                        <h1 class="h3 text-muted"> {{ __('Cofirm Datas') }}</h1>
                    </div>
                </div>

                <div class="border border-rounded px-2 my-4">

                    <table class="table table-hover text-center align-middle">

                        <tbody>
                            <tr>
                                <th></th>
                                <th scope="row"> {{ __('Frete') }}</th>
                                <th scope="row"> {{ $order['fmt_frete'] }}</th>
                            </tr>

                            <tr>
                                <th></th>
                                <th scope="row"> {{ __('Cupom') }}</th>
                                <th scope="row"> {{ $order['fmt_cupom'] }}</th>
                            </tr>

                            <tr>
                                <th></th>
                                <th scope="row"> {{ __('Subtotal') }}</th>
                                <th scope="row"> {{ $order['fmt_subtotal'] }}</th>
                            </tr>

                            <tr>
                                <th scope="row"> {{ __('Total') }} </th>
                                <th scope="row"> {{ __('Buy Value') }}</th>
                                <th scope="row"> {{ $order['fmt_buy'] }}</th>
                            </tr>
                        </tbody>
                    
                    </table>

                </div>

                <div class="text-end">
                    <div class="btn-group">

                        <div class="mx-1">
                            <a href="{{ route('cart.create') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left-circle"></i> {{ __('Back') }}
                            </a>
                        </div>

                        <div class="mx-1">
                            <button type="submit" class="btn btn-outline-success" onclick="return confirm('Após confirmar o pedido uma compra será efetuada, tem certeza de que deseja continuar?')">
                                <i class="bi bi-bag-check"></i> {{ __('Confirm Order') }}
                            </button>
                        </div>

                    </div>
                </div>

            </form>

        </div>

    </x-slot>

</x-app-layout>
