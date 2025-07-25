
@extends('layouts.admin')
@section('content')
<div class="main-content-inner">
                            <div class="main-content-wrap">
                                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                                    <h3>Categoría información</h3>
                                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                                        <li>
                                            <a href="{{route('admin.index')}}">
                                                <div class="text-tiny">Dashboard</div>
                                            </a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <a href="{{route('admin.categories')}}">
                                                <div class="text-tiny">Categrías</div>
                                            </a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <div class="text-tiny">Nueva Categoría</div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- new-category -->
                                <div class="wg-box">
                                    <form class="form-new-product form-style-1" action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <fieldset class="name">
                                            <div class="body-title">Nombre de Categoría<span class="tf-color-1">*</span></div>
                                            <input class="flex-grow" type="text" placeholder="Nombre de categoría" name="name" tabindex="0" value="{{old('name')}}" aria-required="true" required="">
                                        </fieldset>
                                        @error('name')<span class= "alert alert-danger text-center">{{$message}}</span> @enderror
                                        <fieldset class="name">
                                            <div class="body-title">Slug Categoría <span class="tf-color-1">*</span></div>
                                            <input class="flex-grow" type="text" placeholder=" Slug" name="slug" tabindex="0" value="{{old('slug')}}" aria-required="true" required="">
                                        </fieldset>
                                        @error('slug')<span class= "alert alert-danger text-center">{{$message}}</span>@enderror
                                            <fieldset>
                                            <div class="body-title">Descarga la imagen <span class="tf-color-1">*</span>
                                            </div>
                                            <div class="upload-image flex-grow">
                                                <div class="item" id="imgpreview" style="display:none">
                                                    <img src="upload-1.html" class="effect8" alt="">
                                                </div>
                                                <div id="upload-file" class="item up-load">
                                                    <label class="uploadfile" for="myFile">
                                                        <span class="icon">
                                                            <i class="icon-upload-cloud"></i>
                                                        </span>
                                                        <span class="body-text">Coloca tus imágenes aquí o selecciona <span
                                                                class="tf-color">Haz clic para buscar</span></span>
                                                        <input type="file" id="myFile" name="image" accept="image/*">
                                                    </label>
                                                </div>
                                            </div>
                                        </fieldset>
                                        @error('image')<span class= "alert alert-danger text-center">{{$message}}</span>@enderror

                                        <div class="bot">
                                            <div></div>
                                            <button class="tf-button w208" type="submit">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
@endsection
@push('scripts')
<script>
    $(function(){
        $("#myFile").on("change", function(e){
            const photoInp = $("#myFile");
            const [file] = this.files;
            if(file) {
                $("#imgpreview img").attr('src', URL.createObjectURL(file));
                $("#imgpreview").show();
            }
         
        });

        $("input[name='name']").on("change", function(){
            $("input[name='slug']").val(StringToSlug($(this).val()));
        }); 
    });

    function StringToSlug(Text) {
        return Text.toLowerCase()
        .replace(/[^\w ]+/g, "")
        .replace(/ +/g, "-");
    }
</script>
@endpush
