@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h4>
                {{ $product->exists ? 'Edit Product' : 'Create Product' }}
            </h4>
        </section>

        <!-- Main content -->
        <section class="content" id="productApp">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                @include('errors.form-error')
                <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Product</h3>
                        </div>
                        <!-- form start -->
                        {!! Form::model($product, [
                            'route' => $product->exists ? ['admin.product.update', $product->id]: 'admin.product.store',
                            'method' => $product->exists? 'put':'post',
                            'files' => true
                            ])
                        !!}
                        <div class="box-body">
                            <div class="form-group">
                                {!! Form::label('title') !!}
                                {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Description') !!}
                                {!! Form::textarea('description',
                                 null,
                                 ['class' => 'form-control', 'rows' => 4, 'required'])
                                 !!}
                            </div>
                            @if($product->exists)
                                @foreach($product->categories as $category)
                                    <div class="form-group">
                                        <table class="table table-hover table-bordered">
                                            <tr>
                                                <td>Main Category</td>
                                                <td>Sub Category</td>
                                            </tr>
                                            <tr>
                                                <td><span class="text-left"><strong></strong>{{ App\Eshop\Models\Category::findOrFail($category->parent_id)->title }}</span></td>
                                                <td><span class="text-right padding-40">{{ $category->title }}</span></td>
                                            </tr>
                                        </table>
                                    </div>
                                @endforeach
                            @endif

                            <div class="form-group">
                                {!! Form::label('Choose Categories') !!}
                                <select
                                        name="main-category"
                                        class="form-control"
                                @change = "getSubCategories($event)"
                                >
                                <option value="0">Choose Categories</option>
                                <option
                                        v-for="category in mainCategories"
                                        :value="category.id"
                                        v-text="category.title"
                                >
                                </option>
                                </select>
                            </div>
                            <div class="form-group">
                                {!! Form::label('Choose Sub Categories') !!}
                                <select name="category[]" id="" class="form-control">
                                    <option v-if="subCategories.length" v-for="category in subCategories" :value="category.id" v-text="category.title"></option>
                                </select>
                            </div>
                            <div class="form-group">
                                {!! Form::label('Code') !!}
                                {!! Form::text('code', null, ['class' => 'form-control', 'required']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('Price') !!}
                                {!! Form::text('price', null, ['class' => 'form-control','required']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('Published') !!}
                                {!! Form::select('published',[1=>"Yes",0=>"No"],1, ['class' => 'form-control',
                                'required']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('discount_percentage') !!}
                                {!! Form::text('discount_percentage', null, ['class' => 'form-control', 'required']) !!}
                                <span>Enter The discount percentage e.g. 5</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('images','Choose Images') !!}
                                {!! Form::file('images[]', ['class' => 'form-control product-image-button', 'multiple' => true]) !!}
                            </div>
                            <ul class="showImageName"></ul>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        {!! Form::close() !!}

                    </div>
                    <!-- /.box -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


@section('scripts')
    <script type="text/javascript" src="{{ webpack('build/productApp.js') }}"></script>
@endsection