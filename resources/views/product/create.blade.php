<x-app-layout title="{{ __('Products') }}">

    <x-slot name="main">

        <div class="border border-rounded px-2">
            <h1 class="h2 text-muted"> {{ __('Product - :action', ['action' => __('Create')]) }}</h1>
        </div>

        <div class="border border-rounded my-4 p-4">

            <form action="{{route('product.store')}}" method="POST">

                @csrf
                @method('POST')

                <div class="row">
                    <div class="col">

                        <div class="mb-3">
                            <label for="name" class="form-label">{{__('Name')}}</label>
                            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" aria-describedby="product.name" value="{{ old('name') }}">
                            @error('name')
                                 <div class="invalid-feedback"> {{$message}} </div>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="text-end">
                    <div class="btn-group">

                        <div class="mx-1">
                            <a href="{{ route('product.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left-circle"></i> {{ __('Back') }}
                            </a>
                        </div>

                        <div class="mx-1">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-plus-circle"></i> {{ __('Create') }}
                            </button>
                        </div>

                    </div>
                </div>

            </form>

        </div>

    </x-slot>

</x-app-layout>
