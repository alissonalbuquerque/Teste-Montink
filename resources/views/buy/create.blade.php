<x-app-layout title="{{ __('Buy') }}">

    <x-slot name="main">

        <div class="row">

            <div class="border border-rounded px-2">
                <h1 class="h2 text-muted"> {{ $model->name }}</h1>
            </div>

            <div class="border border-rounded px-4 py-4 mt-2">
                <form action="{{route('buy.store')}}" method="POST">

                    @csrf
                    @method('POST')

                    <input type="hidden" id="price" name="price" value="0">

                    <div class="row">

                        <div class="col">

                            <div class="mb-3">
                                <label for="active" class="form-label">{{__('Variant')}}</label>
                                <select id="variant_id" name="variant_id" class="form-select" aria-label="variant">
                                    @foreach($model->variants as $variant)
                                        <option value="{{$variant->id}}">{{ (string) $variant }}</option>
                                    @endforeach
                                </select>
                                @error('variant_id')
                                        <div class="invalid-feedback"> {{$message}} </div>
                                @enderror
                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col">

                            <div class="mb-3">
                                <label for="fmt_price" class="form-label">{{__('Price')}}</label>
                                <input id="fmt_price" name="fmt_price" type="text" class="form-control @error('fmt_price') is-invalid @enderror" aria-describedby="buy.fmt_price" value="R$ 0,00" disabled>
                                @error('fmt_price')
                                        <div class="invalid-feedback"> {{$message}} </div>
                                @enderror
                            </div>

                        </div>
                        
                        <div class="col">

                            <div class="mb-3">
                                <label for="units" class="form-label">{{__('Units')}}</label>
                                <input id="units" name="units" type="number" min="1" max="" class="form-control @error('units') is-invalid @enderror" aria-describedby="buy.units" value="{{ old('units') }}">
                                @error('units')
                                    <div class="invalid-feedback"> {{$message}} </div>
                                @enderror
                            </div>

                        </div>

                        <div class="col">

                            <div class="mb-3">
                                <label for="subtotal" class="form-label">{{__('Total')}}</label>
                                <input id="subtotal" name="subtotal" type="text" class="form-control @error('subtotal') is-invalid @enderror" aria-describedby="buy.subtotal" value="R$ 0,00" disabled>
                                @error('subtotal')
                                        <div class="invalid-feedback"> {{$message}} </div>
                                @enderror
                            </div>
                            
                        </div>

                    </div>

                    <hr>

                    <div class="text-end">
                        <div class="btn-group">

                            <div class="mx-1">
                                <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left-circle"></i> {{ __('Back') }}
                                </a>
                            </div>

                            <div class="mx-1">
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="bi bi-cart-plus"></i> {{ __('Add Cart') }}
                                </button>
                            </div>

                        </div>
                    </div>

                </form>
            </div>

        </div>

    </x-slot>

    @section('script')
        <script type="text/javascript">
            
            $('#variant_id').change(function() {
                    
                const variant_id = $(this).val()
                
                $.ajax({
                    url: `http://localhost:8000/variants/search/${variant_id}`,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {

                        const price     = data.price
                        const stock     = data.stock
                        const fmt_price = data.format.price
                        
                        $('#price').val(price)
                        $('#units').attr('max', stock)
                        $('#fmt_price').val(fmt_price)
                    },
                    error: function(xhr, status, error) {
                        $('#resultado').html(`<p>Erro: ${error}</p>`);
                    }
                });
                
            }).change();

            $('#units').change(function() {

                const units = $(this).val()

                const price = $('#price').val()

                const subtotal = units * price

                const formatter = new Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'});

                const fmt_subtotal = formatter.format(subtotal)

                $('#subtotal').val(fmt_subtotal)
            });

        </script>
    @endsection

</x-app-layout>
