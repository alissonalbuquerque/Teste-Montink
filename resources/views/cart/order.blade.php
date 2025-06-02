<x-app-layout title="{{ __('Order') }}">

    <x-slot name="main">

        <div class="border border-rounded px-2">
            <h1 class="h2 text-muted"> {{ __('Order') }}</h1>
        </div>

        <div class="border border-rounded my-4 p-4">

            <form action="{{route('buy.order')}}" method="POST">

                @csrf
                @method('POST')

                <div>

                    <input type="hidden" id="buy" name="buy" value="{{ 0.00 }}">
                    <input type="hidden" id="frete" name="frete" value="{{ 0.00 }}">
                    <input type="hidden" id="cupom" name="cupom" value="{{ 0.00 }}">
                    <input type="hidden" id="cupom_id" name="cupom_id" value="">
                    <input type="hidden" id="subtotal" name="subtotal" value="{{ 0.00 }}">

                    <input type="hidden" id="initial" name="initial" value="{{ $order['subtotal'] }}">
                    
                    @foreach ($collection as $vproduct)

                        @if(!$loop->last) 
                            <input type="hidden" name="orders[{{$vproduct->variant->id}}][variant_id]" value="{{$vproduct->variant->id}}">
                            <input type="hidden" name="orders[{{$vproduct->variant->id}}][price]"      value="{{$vproduct->price}}">
                            <input type="hidden" name="orders[{{$vproduct->variant->id}}][units]"      value="{{$vproduct->units}}">
                            <input type="hidden" name="orders[{{$vproduct->variant->id}}][subtotal]"   value="{{$vproduct->subtotal}}">
                        @endif
                        
                    @endforeach

                    <div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{__('Buy E-mail')}}</label>
                            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" aria-describedby="buy.email" value="{{ old('email') }}">
                            @error('email')
                                 <div class="invalid-feedback"> {{$message}} </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="field_cupom" class="form-label">{{__('Cupom (Code)')}}</label>
                            <input id="field_cupom" name="field_cupom" type="text" class="form-control @error('field_cupom') is-invalid @enderror" aria-describedby="buy.field_cupom" value="{{ old('field_cupom') }}">
                            @error('field_cupom')
                                 <div class="invalid-feedback"> {{$message}} </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="field_cupom_value" class="form-label text-muted">{{__('Cupom (Discount)')}}</label>
                            <input id="field_cupom_value" name="field_cupom_value" type="text" class="form-control @error('field_cupom_value') is-invalid @enderror" aria-describedby="buy.field_cupom_value" value="{{ old('field_cupom_value') }}" disabled>
                            @error('field_cupom_value')
                                 <div class="invalid-feedback"> {{$message}} </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="field_frete" class="form-label text-muted">{{__('Frete')}}</label>
                            <input id="field_frete" name="field_frete" type="text" class="form-control @error('field_frete') is-invalid @enderror" aria-describedby="buy.field_frete" value="{{ old('field_frete') }}" disabled>
                            @error('field_frete')
                                 <div class="invalid-feedback"> {{$message}} </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="field_subtotal" class="form-label text-muted">{{__('Subtotal')}}</label>
                            <input id="field_subtotal" name="field_subtotal" type="text" class="form-control @error('field_subtotal') is-invalid @enderror" aria-describedby="buy.field_subtotal" value="{{ $order['fmt_subtotal'] }}" disabled>
                            @error('field_subtotal')
                                 <div class="invalid-feedback"> {{$message}} </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="field_buy" class="form-label text-muted">{{__('Buy Value')}}</label>
                            <input id="field_buy" name="field_buy" type="text" class="form-control @error('field_buy') is-invalid @enderror" aria-describedby="field_buy" value="{{ old('field_buy') }}" disabled>
                            @error('field_buy')
                                 <div class="invalid-feedback"> {{$message}} </div>
                            @enderror
                        </div>

                    </div>

                </div>

                <div class="text-end">
                    <div class="btn-group">

                        <div class="mx-1">
                            <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left-circle"></i> {{ __('Back') }}
                            </a>
                        </div>

                        <div class="mx-1">
                            <button type="submit" class="btn btn-outline-success">
                                <i class="bi bi-bag-check"></i> {{ __('Close :action', ['action' => __('Order')]) }}
                            </button>
                        </div>

                    </div>
                </div>

            </form>

        </div>

    </x-slot>

    @section('script')
        <script type="text/javascript">

            const app = {

                ajax_setup : () => {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                },

                flt_val : (value) => {
                    return Number(value) || 0.00
                },

                formatter : (value) => {
                    const formatter = new Intl.NumberFormat('pt-BR', {
                        currency: 'BRL',
                        style: 'currency'
                    });
                    return formatter.format(value);
                },                

                cupom_value : () => {

                    $.ajax({
                        url: `http://localhost:8000/coupons/recover`,
                        method: 'POST',
                        data: {
                            'code'         : $('#field_cupom').val(),
                            'minimal_value': $('#initial').val()
                        },
                        dataType: 'json',
                        success: function(data) {
                            const id = data.id
                            const value = app.flt_val(data.value)
                            const fmt_value = app.formatter(value)

                            $('#cupom_id').val(id)
                            $('#cupom').val(value)
                            $('#field_cupom_value').val(fmt_value)

                            app.buy_value()
                            app.frete_value()
                        },
                        error: function(xhr, status, error) {
                            $('#resultado').html(`<p>Erro: ${error}</p>`);
                        }
                    });

                },

                frete_value : () => {
                    
                    app.subtotal_value();

                    $.ajax({
                        url: `http://localhost:8000/frete/calculate`,
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            price: $('#subtotal').val()
                        },
                        success: function(data) {

                            const frete = app.flt_val(data.frete)
                            const fmt_frete = app.formatter(frete)
                            
                            $('#frete').val(frete);
                            $('#field_frete').val(fmt_frete);
                        },
                        error: function(xhr, status, error) {
                            $('#resultado').html(`<p>Erro: ${error}</p>`);
                        }
                    });

                },

                subtotal_value : () => {

                    const initial  = app.flt_val($('#initial').val())
                    const cupom    = app.flt_val($('#cupom').val())

                    const subtotal = initial - cupom

                    $('#subtotal').val(subtotal)
                },

                buy_value : () => {

                    const initial = app.flt_val($('#initial').val())
                    const frete   = app.flt_val($('#frete').val())
                    const cupom   = app.flt_val($('#cupom').val())

                    const buy =  initial + frete - cupom

                    const fmt_buy = app.formatter(buy)

                    $('#buy').val(buy)
                    $('#field_buy').val(fmt_buy)

                }

            }

            app.ajax_setup()

            app.subtotal_value()

            app.frete_value()

            app.buy_value()

            $('#field_cupom').on('change', function() {
                app.cupom_value()
            })

        </script>
    @endsection

</x-app-layout>
