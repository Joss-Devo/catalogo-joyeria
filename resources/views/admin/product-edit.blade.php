@extends('layouts.admin')
@section('content')

<div class="main-content-inner" style="overflow:auto; max-height:90vh;">
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
                    <div class="text-tiny">Editar producto</div>
                </li>
            </ul>
        </div>
        <!-- form-add-product -->
        <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data" action="{{route('admin.product.update')}}">
            @csrf 
            @method('PUT')
            <input type= "hidden" name="id" value = "{{$product->id}}"/>
            <div class="wg-box">
                <fieldset class="name">
                    <div class="body-title mb-10">Product name <span class="tf-color-1">*</span>
                    </div>
                    <input class="mb-10" type="text" placeholder="Enter product name" name="name" tabindex="0" value="{{$product->name}}" aria-required="true" required="">
                    <div class="text-tiny">Do not exceed 100 characters when entering the product name.</div>
                </fieldset>
                @error('name') <span class="alert alert-danger text-center">{{$message}} @enderror
                

                <fieldset class="name">
                    <div class="body-title mb-10">Slug <span class="tf-color-1">*</span></div>
                    <input class="mb-10" type="text" placeholder="Enter product slug" name="slug" tabindex="0" value="{{$product->slug}}" aria-required="true" required="">
                    <div class="text-tiny">Do not exceed 100 characters when entering the product name.</div>
                </fieldset>
                @error('slug') <span class="alert alert-danger text-center">{{$message}} @enderror

                <div class="gap22 cols">
                    <fieldset class="category">
                        <div class="body-title mb-10">Categoría <span class="tf-color-1">*</span>
                        </div>
                        <div class="select">
                            <select class="" name="category_id">
                                <option>Choose category</option>
                                @foreach ($categories as $category )
                                <option value="{{$category->id}}"{{$product->category_id == $category->id ?"selected":""}}>{{$category->name}}</option>
                                @endforeach


                            </select>
                        </div>
                    </fieldset>
                    @error('category_id') <span class="alert alert-danger text-center">{{$message}} @enderror
                    <fieldset class="brand">
                        <div class="body-title mb-10">Brand <span class="tf-color-1">*</span>
                        </div>
                        <div class="select">
                            <select class="" name="brand_id">
                                <option>Choose brand</option>
                                @foreach ($brands as $brand )
                                <option value="{{$brand->id}}"{{$product->brand_id == $brand->id ?"selected":""}}>{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </fieldset>
                    @error('brand_id') <span class="alert alert-danger text-center">{{$message}} @enderror
                </div>

                <fieldset class="shortdescription">
                    <div class="body-title mb-10">Short Description <span class="tf-color-1">*</span></div>
                    <textarea class="mb-10 ht-150" name="short_description" placeholder="Short Description" tabindex="0" aria-required="true" required="">{{$product->short_description}}</textarea>
                    <div class="text-tiny">Do not exceed 100 characters when entering the
                        product name.</div>
                </fieldset>
                
                   
                @error('short_description') <span class="alert alert-danger text-center">{{$message}} @enderror
                <fieldset class="description">
                    <div class="body-title mb-10">Description <span class="tf-color-1">*</span>
                    </div>
                    <textarea class="mb-10" name="description" placeholder="Description" tabindex="0" aria-required="true" required="">{{$product->description}}</textarea>
                    <div class="text-tiny">Do not exceed 100 characters when entering the product name.</div>
                </fieldset>
                
                @error('description') <span class="alert alert-danger text-center">{{$message}} @enderror
            </div>
            <div class="wg-box">
                <fieldset>
                    <div class="body-title">Upload images <span class="tf-color-1">*</span>
                    </div>
                    <div class="upload-image flex-grow">
                        
                        @if($product->image)
                        <div class="item" id="imgpreview">
                            <img src="{{asset('uploads/products')}}/{{$product->image}}" class="effect8" alt="{{$product->name}}">
                        </div>
                        @endif
                        <div id="upload-file" class="item up-load">
                            <label class="uploadfile" for="myFile">
                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>
                                <span class="body-text">Drop your images here or select <span class="tf-color">click to browse</span></span>

                                <input type="file" id="myFile" name="image" accept="image/*">
                            </label>
                        </div>
                    </div>
                </fieldset>

                @error('image') <span class="alert alert-danger text-center">{{$message}} @enderror
                <fieldset>
                    <div class="body-title mb-10">Upload Gallery Images</div>
                    <div class="upload-image mb-16">
                        <!-- Alerta solo si no hay imágenes seleccionadas en el input de galería -->
                        <div id="gallery-alert" class="alert alert-warning text-center mb-2" style="display:none;">
                            Debes agregar al menos una imagen a la galería.
                        </div>
                        @if($product->images)
                        @foreach (explode(',',$product->images) as $img)
                        <div class="item gitems">
                            <img src="{{asset('uploads/products')}}/{{trim($img)}}" alt="">
                        </div>
                        @endforeach
                        @endif
                        <div id="galUpload" class="item up-load">
                            <label class="uploadfile" for="gFile">
                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>
                                <span class="text-tiny">Drop your images here or select <span
                                        class="tf-color">click to browse</span></span>
                                <input type="file" id="gFile" name="images[]" accept="image/*" multiple="">
                            </label>
                        </div>
                    </div>
                </fieldset>

                @error('images') <span class="alert alert-danger text-center">{{$message}} @enderror
                <div class="cols gap22">
                    <fieldset class="name">
                        <div class="body-title mb-10">Regular Price <span
                                class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" placeholder="Enter regular price" name="regular_price" tabindex="0" value="{{$product->regular_price}}" aria-required="true" required="">
                    </fieldset>
                    @error('regular_price') <span class="alert alert-danger text-center">{{$message}} @enderror
                    <fieldset class="name">
                        <div class="body-title mb-10">Sale Price <span
                                class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" placeholder="Enter sale price" name="sale_price" tabindex="0" value="{{$product->sale_price}}" aria-required="true" required="">
                    </fieldset>
                    
                    @error('sale_price') <span class="alert alert-danger text-center">{{$message}} @enderror
                </div>


                <div class="cols gap22">
                    <fieldset class="name">
                        <div class="body-title mb-10">SKU <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10" type="text" placeholder="Enter SKU" name="SKU" tabindex="0" value="{{$product->SKU}}" aria-required="true" required="">
                    </fieldset>
                    @error('SKU') <span class="alert alert-danger text-center">{{$message}} @enderror
                    <fieldset class="name">
                        <div class="body-title mb-10">Quantity <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10" type="text" placeholder="Enter quantity" name="quantity" tabindex="0" value="{{$product->quantity}}" aria-required="true"
                            required="">
                    </fieldset>
                    
                    @error('quantity') <span class="alert alert-danger text-center">{{$message}} @enderror
                </div>

                <div class="cols gap22">
                    <fieldset class="name">
                        <div class="body-title mb-10">Stock</div>
                        <div class="select mb-10">
                            <select class="" name="stock_status">
                                <option value="instock"{{$product->stock_status == "instock" ? "selected":""}}>InStock</option>
                                <option value="outofstock"{{$product->stock_status == "outofstock" ? "selected":""}}>Out of Stock</option>
                            </select>
                        </div>
                    </fieldset>
                    
                    @error('stock_status') <span class="alert alert-danger text-center">{{$message}} @enderror
                    <fieldset class="name">
                        <div class="body-title mb-10">Featured</div>
                        <div class="select mb-10">
                            <select class="" name="featured">
                                <option value="0"{{$product->featured == "0" ? "selected":""}}>No</option>
                                <option value="1"{{$product->featured == "1" ? "selected":""}}>Yes</option>
                            </select>
                        </div>
                    </fieldset>
                    
                    @error('featured') <span class="alert alert-danger text-center">{{$message}} @enderror
                </div>
                <div class="cols gap10">
                    <button class="tf-button w-full" type="submit">Actualizar Producto</button>
                </div>
            </div>
        </form>
        <!-- /form-add-product -->
    </div>
    <!-- /main-content-wrap -->
</div>
@endsection



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

        // OCULTAR archivos existentes de la galería al cargar la página
        $(".gitems").each(function(){
            if(!$(this).hasClass('new')) {
                $(this).hide();
            }
        });

        // Agrega la X para eliminar en imágenes existentes de la galería
        $(".gitems").each(function(){
            if(!$(this).hasClass('new')) {
                const $img = $(this).find('img');
                // Asegura que la imagen tenga src absoluto solo si es relativo
                if ($img.length && !$img.attr('src').startsWith('http') && !$img.attr('src').startsWith(window.location.origin)) {
                    $img.attr('src', "{{ asset('uploads/products') }}/" + $img.attr('src').split('/').pop());
                }
                const imgName = $img.attr('src').split('/').pop();
                $(this).addClass('existing').attr('data-img', imgName);
                if($(this).find('.remove-image').length === 0) {
                    $(this).append(`<span class="remove-image" style="
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
                    ">&times;</span>`);
                    $(this).css('position', 'relative');
                }
            }
        });

        // Eliminar imágenes existentes de la galería (del producto)
        $(document).on('click', '.gitems.existing .remove-image', function () {
            const imgName = $(this).closest('.gitems').data('img');
            $('<input>').attr({
                type: 'hidden',
                name: 'delete_gallery_images[]',
                value: imgName
            }).appendTo('form.form-add-product');
            $(this).closest('.gitems').remove();
        });

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
            $("#galUpload .gitems.new").remove();
            galleryFiles.forEach(function(file, idx) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imgHtml = `
                        <div class="item gitems new position-relative" data-idx="${idx}">
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

        // Eliminar imagen de la galería (solo nuevas)
        $(document).on('click', '.gitems.new .remove-image', function () {
            const idx = $(this).closest('.gitems').data('idx');
            galleryFiles.splice(idx, 1);
            renderGallery();
        });

        // Antes de enviar el formulario, valida si hay imágenes en la galería
        $("form.form-add-product").on("submit", function(e) {
            if (galleryFiles.length === 0 && $(".gitems:visible").length === 0) {
                $("#gallery-alert").show();
                e.preventDefault();
                return false;
            }
            // Crear un nuevo input file dinámico
            const dt = new DataTransfer();
            galleryFiles.forEach(function(file) {
                dt.items.add(file);
            });
            $("#gFile")[0].files = dt.files;
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
