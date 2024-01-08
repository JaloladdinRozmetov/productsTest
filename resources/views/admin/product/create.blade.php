@extends('admin.layout')

@section('title', 'Home')

@section('content')
    <div class="container">
        <form action="{{ route('products.store') }}" method="post" class="bg-dark">
            @csrf
            <h2 class="text-white m-3">Добовит продукт</h2>
            <div class="mb-3 row">
                <label for="email" class="ml-2 col-md-2 col-form-label text-md-end text-start text-light">Артикул</label><br>
                <div class="col-md-4">
                    <input type="text" class="form-control @error('article') is-invalid @enderror" id="article" name="article" value="{{ old('article') }}">
                    @if ($errors->has('article'))
                        <span class="text-danger">{{ $errors->first('article') }}</span>
                    @endif
                </div>
            </div>
            <div class="mb-3 row">
                <label for="name" class="ml-2 col-md-2 col-form-label text-md-end text-start text-light">Называние</label>
                <div class="col-md-4">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>
            <div class="mb-3 row">
                <label for="status" class="ml-2 col-md-2 col-form-label text-md-end text-start text-light">Статус:</label>
                <div class="col-md-4">
                    <select name="status" id="status" class="form-control" required>
                        <option value="available">Доступен</option>
                        <option value="unavailable">Не доступен</option>
                    </select>
                </div>
            </div>
            <div class="form-group" id="attributeContainer">
                <h3 class=" text-light ml-2">Атрибуты</h3>
                <div class="attribute-row">
                    <div class="col-md-3">
                        <button type="button" class="btn btn-link add-attribute">+ Добовит атрибут</button>
                    </div>
                </div>
            </div>
            <div class="mb-3 row">
                <input type="submit" class="col-md-2 btn btn-primary m-4" value="Добовит">
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
            });

            function addAttributeRow() {
                const attributeRow = document.createElement('div');
                attributeRow.className = 'attribute-row row m-2';

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
                    attributeContainer.removeChild(attributeRow);
                });

                attributeRow.appendChild(attributeNameInput);
                attributeRow.appendChild(attributeValueInput);
                attributeRow.appendChild(removeButton);
                attributeContainer.appendChild(attributeRow);
            }
        });
    </script>
@endsection
