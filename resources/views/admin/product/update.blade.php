@extends('admin.layout')

@section('title', 'Home')

@section('content')
    <div class="container">
        <form action="{{ route('products.update',$product->id) }}" method="POST" class="bg-dark">
            @csrf
            @method('POST')
            <h2 class="text-white m-3">Редактировать {{$product->name}}</h2>
            <div class="mb-3 row">
                <label for="email" class="ml-2 col-md-2 col-form-label text-md-end text-start text-light">Артикул</label>
                <div class="col-md-4">
                    <input type="text" class="form-control @error('article') is-invalid @enderror" id="article" name="article" value="{{ $product->article}}">
                    @if ($errors->has('article'))
                        <span class="text-danger">{{ $errors->first('article') }}</span>
                    @endif
                </div>
            </div>
            <div class="mb-3 row">
                <label for="name" class="col-md-2 col-form-label text-md-end text-start text-light ml-2">Называние</label>
                <div class="col-md-4">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $product->name}}">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>
            <div class="mb-3 row">
                <label for="status" class="col-md-2 col-form-label text-md-end text-start text-light ml-2">Статус:</label>
                <div class="col-md-4">
                    <select name="status" id="status" class="form-control" required>
                        @if($product->status == 'available')
                            <option value="available" selected>Доступен</option>
                            <option value="unavailable">Не доступен</option>
                        @elseif($product->status == 'unavailable')
                            <option value="available">Доступен</option>
                            <option value="unavailable" selected>Не доступен</option>
                        @endif

                    </select>
                </div>
            </div>
            <div class="form-group" id="attributeContainer">
            <h3 class="text-light ml-2">Атрибуты</h3>
                <div class="attribute-row">
                    <div class="col-md-3">
                        <button type="button" class="btn btn-link add-attribute">+ Добовит атрибут</button>
                    </div>
                </div>
                    <?php $jsonData = json_decode($product->data) ?>
                @if($jsonData !==null)
                    @foreach($jsonData as $key=>$value)
                        <div class="attribute-row row ml-2">
                            <input type="text" name="attributes_name[]" class="form-control col-md-2" placeholder="Называние атрибута" value="{{ ucfirst($key) }}" required="">
                            <input type="text" name="attributes_value[]" class="form-control col-md-2" placeholder="Значения" value="{{$value}}" required="">
                            <button type="button" class="btn btn-danger remove-attribute ml-1">Удалит</button>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="mb-3 row">
                <input type="submit" class="col-md-2 btn btn-primary m-4" value="Сохранит">
            </div>

        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const attributeContainer = document.getElementById('attributeContainer');

            attributeContainer.addEventListener('click', function (event) {
                if (event.target.classList.contains('add-attribute')) {
                    addAttributeRow();
                }

                if (event.target.classList.contains('remove-attribute')) {
                    removeAttributeRow(event.target.closest('.attribute-row'));
                }
            });

            function addAttributeRow() {
                const attributeRow = document.createElement('div');
                attributeRow.className = 'attribute-row row';

                const attributeNameInput = document.createElement('input');
                attributeNameInput.type = 'text';
                attributeNameInput.name = 'attributes_name[]';
                attributeNameInput.className = 'form-control col-md-2';
                attributeNameInput.placeholder = 'Называние атрибута';
                attributeNameInput.required = true;

                const attributeValueInput = document.createElement('input');
                attributeValueInput.type = 'text';
                attributeValueInput.name = 'attributes_value[]';
                attributeValueInput.className = 'form-control col-md-2';
                attributeValueInput.placeholder = 'Значения';
                attributeValueInput.required = true;

                const removeButton = document.createElement('button');
                removeButton.type = 'button';
                removeButton.className = 'btn btn-danger remove-attribute ml-1';
                removeButton.innerText = 'Удалит';

                removeButton.addEventListener('click', function () {
                    removeAttributeRow(attributeRow);
                });

                attributeRow.appendChild(attributeNameInput);
                attributeRow.appendChild(attributeValueInput);
                attributeRow.appendChild(removeButton);
                attributeContainer.appendChild(attributeRow);
            }

            function removeAttributeRow(attributeRow) {
                attributeContainer.removeChild(attributeRow);
            }
        });
    </script>
@endsection
