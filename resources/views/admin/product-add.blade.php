@extends('layouts.admin')
@section('content')

<div class="main-content-inner">
    <!-- main-content-wrap -->
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Agregar Producto</h3>
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
                    <a href="{{route('admin.products')}}">
                        <div class="text-tiny">Productos</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Agregar producto</div>
                </li>
            </ul>
        </div>
        <!-- form-add-product -->
        <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data" action="{{route('admin.product.store')}}">
            @csrf
            <div class="wg-box">
                <fieldset class="name">
                    <div class="body-title mb-10">Nombre del Producto <span class="tf-color-1">*</span>
                    </div>
                    <input class="mb-10" type="text" placeholder="Nombre" name="name" tabindex="0" value="{{old('name')}}" aria-required="true" required="">
                    <div class="text-tiny">No excedas los 100 caracteres al ingresar el nombre del producto..</div>
                </fieldset>
                @error('name') <span class="alert alert-danger text-center">{{$message}} @enderror
                

                <fieldset class="name">
                    <div class="body-title mb-10">Slug <span class="tf-color-1">*</span></div>
                    <input class="mb-10" type="text" placeholder="slug" name="slug" tabindex="0" value="{{old('slug')}}" aria-required="true" required="">
                    
                </fieldset>
                @error('slug') <span class="alert alert-danger text-center">{{$message}} @enderror

                <div class="gap22 cols">
                    <fieldset class="category">
                        <div class="body-title mb-10">Categoría <span class="tf-color-1">*</span>
                        </div>
                        <div class="select">
                            <select class="" name="category_id" id="category_id">
                                <option>Elige una categoría</option>
                                @foreach ($categories as $category )
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="category-alert" class="alert alert-warning text-center mb-2" style="display:none;">
                            Debes seleccionar una categoría.
                        </div>
                    </fieldset>
                    @error('category_id') <span class="alert alert-danger text-center">{{$message}} @enderror
                    <fieldset class="brand">
                        <div class="body-title mb-10">Marca <span class="tf-color-1">*</span>
                        </div>
                        <div class="select">
                            <select class="" name="brand_id" id="brand_id">
                                <option>Elige una marca</option>
                                @foreach ($brands as $brand )
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="brand-alert" class="alert alert-warning text-center mb-2" style="display:none;">
                            Debes seleccionar una marca.
                        </div>
                    </fieldset>
                    @error('brand_id') <span class="alert alert-danger text-center">{{$message}} @enderror
                </div>

                <fieldset class="shortdescription">
                    <div class="body-title mb-10">Descripción corta <span class="tf-color-1">*</span></div>
                    <textarea class="mb-10 ht-150" name="short_description" placeholder="Descripción corta" tabindex="0" aria-required="true" required="">{{old('short_description')}}</textarea>
                    <div class="text-tiny">No excedas los 100 caracteres al ingresar el nombre del producto.</div>
                </fieldset>
                
                   
                @error('short_description') <span class="alert alert-danger text-center">{{$message}} @enderror
                <fieldset class="description">
                    <div class="body-title mb-10">Descripción <span class="tf-color-1">*</span>
                    </div>
                    <textarea class="mb-10" name="description" placeholder="Descripción" tabindex="0" aria-required="true" required="">{{old('description')}}</textarea>
                    <div class="text-tiny">No excedas los 100 caracteres al ingresar el nombre del producto.</div>
                </fieldset>
                
                @error('description') <span class="alert alert-danger text-center">{{$message}} @enderror
            </div>
            <div class="wg-box">
                <fieldset>
                    <div class="body-title">Cargar imagen <span class="tf-color-1">*</span>
                    </div>
                    <div class="upload-image flex-grow">
                        <div class="item" id="imgpreview" style="display:none">
                            <img src="../../../localhost_8000/images/upload/upload-1.png" class="effect8" alt="">
                        </div>
                        <div id="upload-file" class="item up-load">
                            <label class="uploadfile" for="myFile">
                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>
                                <span class="body-text">Seleciona tus imagenes <span class="tf-color">Haz clic para buscar</span></span>
                                <input type="file" id="myFile" name="image" accept="image/*">
                            </label>
                        </div>
                    </div>
                </fieldset>

                @error('image') <span class="alert alert-danger text-center">{{$message}} @enderror
                <fieldset>
                    <div class="body-title mb-10">Subir imágenes para la galería</div>
                    <div class="upload-image mb-16">
                        <!-- Alerta solo si no hay imágenes seleccionadas en el input de galería -->
                        <div id="gallery-alert" class="alert alert-warning text-center mb-2" style="display:none;">
                            Debes agregar al menos una imagen a la galería.
                        </div>
                        <!-- <div class="item">
                                <img src="images/upload/upload-1.png" alt="">
                            </div>                                                 -->
                        <div id="galUpload" class="item up-load">
                            <label class="uploadfile" for="gFile">
                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>
                                <span class="text-tiny">selecina tus imagenes <span
                                        class="tf-color">Haz clic para buscar</span></span>
                                <input type="file" id="gFile" name="images[]" accept="image/*" multiple="">
                            </label>
                        </div>
                    </div>
                </fieldset>
                @error('images') <span class="alert alert-danger text-center">{{$message}} @enderror
                <div class="cols gap22">
                    <fieldset class="name">
                        <div class="body-title mb-10">Precio regular <span
                                class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" placeholder="Precio regular" name="regular_price" tabindex="0" value="{{old('regular_price')}}" aria-required="true" required="">
                    </fieldset>
                    @error('regular_price') <span class="alert alert-danger text-center">{{$message}} @enderror
                    <fieldset class="name">
                        <div class="body-title mb-10">Precio de oferta <span
                                class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" placeholder="Precio de oferta" name="sale_price" tabindex="0" value="{{old('sale_price')}}" aria-required="true" required="">
                    </fieldset>
                    
                    @error('sale_price') <span class="alert alert-danger text-center">{{$message}} @enderror
                </div>


                <div class="cols gap22">
                    <fieldset class="name">
                        <div class="body-title mb-10">SKU <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10" type="text" placeholder="SKU" name="SKU" tabindex="0" value="{{old('SKU')}}" aria-required="true" required="">
                    </fieldset>
                    @error('SKU') <span class="alert alert-danger text-center">{{$message}} @enderror
                    <fieldset class="name">
                        <div class="body-title mb-10">Cantidad <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10" type="text" placeholder="Cantidad" name="quantity" tabindex="0" value="{{old('quantity')}}" aria-required="true"
                            required="">
                    </fieldset>
                    
                    @error('quantity') <span class="alert alert-danger text-center">{{$message}} @enderror
                </div>

                <div class="cols gap22">
                    <fieldset class="name">
                        <div class="body-title mb-10">Stock</div>
                        <div class="select mb-10">
                            <select class="" name="stock_status">
                                <option value="instock">en Stock</option>
                                <option value="outofstock">fuera del  Stock</option>
                            </select>
                        </div>
                    </fieldset>
                    
                    @error('stock_status') <span class="alert alert-danger text-center">{{$message}} @enderror
                    <fieldset class="name">
                        <div class="body-title mb-10">Destacado</div>
                        <div class="select mb-10">
                            <select class="" name="featured">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                    </fieldset>
                    
                    @error('featured') <span class="alert alert-danger text-center">{{$message}} @enderror
                </div>
                <div class="cols gap10">
                    <button class="tf-button w-full" type="submit">Agregar Producto</button>
                </div>
            </div>
        </form>
        <!-- /form-add-product -->
    </div>
    <!-- /main-content-wrap -->
</div>
@endsection


<!--@push("scripts")
    <script>
            $(function(){
                $("#myFile").on("change",function(e){
                    const photoInp = $("#myFile");                    
                    const [file] = this.files;
                    if (file) {
                        $("#imgpreview img").attr('src',URL.createObjectURL(file));
                        $("#imgpreview").show();                        
                    }
                });
                $("#gFile").on("change",function(e){
                    
                    const photoInp = $("#gFile");
                    const gphotos = this.files;                    
                    $.each(gphotos,function(key,val){                        
                        $("#galUpload").prepend(`<div class="item gitems"><img src="${URL.createObjectURL(val)}" alt=""></div>`);                        
                    });                    
                });
                $("input[name='name']").on("change",function(){
                    $("input[name='slug']").val(StringToSlug($(this).val()));
                });
                
            });
            function StringToSlug(Text) {
                return Text.toLowerCase()
                .replace(/[^\w ]+/g, "")
                .replace(/ +/g, "-");
            }      
    </script>
@endpush -->
@push("scripts")
<script>
    $(function () {
        // Imagen principal
        $("#myFile").on("change", function (e) {
            const [file] = this.files;
            if (file) {
                $("#imgpreview img").attr('src', URL.createObjectURL(file));
                $("#imgpreview").show();
            }
        });

        // Galería avanzada
        let galleryFiles = [];

        $("#gFile").on("change", function (e) {
            galleryFiles = [];
            for (let i = 0; i < this.files.length; i++) {
                galleryFiles.push(this.files[i]);
            }
            renderGallery();
            this.value = "";
            // Oculta la alerta si hay imágenes seleccionadas
            if (galleryFiles.length > 0) {
                $("#gallery-alert").hide();
            }
        });

        function renderGallery() {
            $("#galUpload .gitems").remove();
            galleryFiles.forEach(function(file, idx) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imgHtml = `
                        <div class="item gitems position-relative" data-idx="${idx}">
                            <img src="${e.target.result}" alt="" />
                            <span class="remove-image" style="
                                position: absolute;
                                top: 5px;
                                right: 5px;
                                background: rgba(0,0,0,0.5);
                                color: white;
                                padding: 2px 6px;
                                border-radius: 50%;
                                cursor: pointer;
                                font-size: 14px;
                                line-height: 1;
                            ">&times;</span>
                        </div>
                        <input type="hidden" name="gallery_indexes[]" value="${idx}" class="gallery-index" />
                    `;
                    $("#galUpload").append(imgHtml);
                };
                reader.readAsDataURL(file);
            });
        }

        // Eliminar imagen de la galería
        $(document).on('click', '.remove-image', function () {
            const idx = $(this).closest('.gitems').data('idx');
            galleryFiles.splice(idx, 1);
            renderGallery();
        });

        // Antes de enviar el formulario, valida si hay imágenes en la galería
        $("form.form-add-product").on("submit", function(e) {
            let valid = true;
            // Categoría
            if ($("#category_id").val() === "Elige una categoría" || !$("#category_id").val()) {
                $("#category-alert").show();
                valid = false;
            } else {
                $("#category-alert").hide();
            }
            // Marca
            if ($("#brand_id").val() === "Elige una marca" || !$("#brand_id").val()) {
                $("#brand-alert").show();
                valid = false;
            } else {
                $("#brand-alert").hide();
            }
            // Galería
            if (galleryFiles.length === 0) {
                $("#gallery-alert").show();
                valid = false;
            } else {
                $("#gallery-alert").hide();
            }
            if (!valid) {
                e.preventDefault();
                return false;
            }
            // Crear un nuevo input file dinámico
            const dt = new DataTransfer();
            galleryFiles.forEach(function(file) {
                dt.items.add(file);
            });
            // Reemplazar el input original por uno nuevo solo con los archivos seleccionados
            const $gFile = $("#gFile");
            $gFile[0].files = dt.files;
        });

        // Autogenerar slug
        $("input[name='name']").on("change", function () {
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