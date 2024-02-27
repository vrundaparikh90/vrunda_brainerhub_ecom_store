@extends('layouts.design')

@section('content')
      <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Products</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Create Product</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="add-cat-form" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{route('products_store')}}">
                      {{ csrf_field() }}
                      <input type="hidden" id="category_ids" name="category_ids" value="">
                      <input type="hidden" id="category_level" name="category_level" value="">
                      <div class="form-group" id="parent_cat_id1">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Parent Category
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <select id="parent_id1" name="parent_id1" class="parent_id form-control" multiple>
                          <!-- <option value="0">Select Parent Category</option> -->
                          @if(count($parentCategoryData) > 0)
                            @foreach($parentCategoryData as $k => $v)
                              <option value="{{$v->id}}">{{$v->name}}</option>
                            @endforeach
                          @endif
                          </select>
                          <div id="catError" class="error" style="display:none; margin-top: 4px;">Please select category.</div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Product Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="name"  class="form-control col-md-7 col-xs-12" value="{{old('name')}}">
                          <div id="nameError" class="error" style="display:none; margin-top: 4px;">Please enter product name.</div>
                          @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Product Description<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
                          <div id="descriptionError" class="error" style="display:none; margin-top: 4px;">Please enter product description.</div> 
                          @if ($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Product Quantity<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="quantity" name="quantity"  class="form-control col-md-7 col-xs-12" value="{{old('quantity')}}" min="1" step="1">
                          <div id="quantityError" class="error" style="display:none; margin-top: 4px;">Please enter product quantity.</div>
                          @if ($errors->has('quantity'))
                            <span class="text-danger">{{ $errors->first('quantity') }}</span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Product Price<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="price" name="price" class="form-control col-md-7 col-xs-12" value="{{old('price')}}" min="1" step=".01">
                          <div id="priceError" class="error" style="display:none; margin-top: 4px;">Please enter product price.</div>
                          @if ($errors->has('price'))
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                          @endif
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="{{route('products')}}" class="btn btn-primary">Cancel</a>
                          <button type="button" id="save" name="save" class="btn btn-success">Save</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                </div>
              </div>
            </div>
@endsection
@section('footer')
<!-- Datatables -->
<script src="{{asset('js/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/datatable/dataTables.bootstrap.min.js')}}"></script>
<!-- <script src="{{asset('js/parsleyjs/dist/parsley.min.js')}}"></script> -->
<script language="javascript" src="//momentjs.com/downloads/moment.js"></script>
<script language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript">
  $('document').ready(function() {

    $(document).on('click','#save',function() {
      var name = $('#name').val();
      var description = $('#description').val();
      var price = $('#price').val();
      var quantity = $('#quantity').val();
      var category_ids = $('#category_ids').val();

      if($.trim(name) == '' || $.trim(description) == '' || $.trim(price) == '' || $.trim(quantity) == '' || $.trim(category_ids) == ''){
         $.trim(name) == '' ? $('#nameError').show() : $('#nameError').hide();
         $.trim(description) == '' ? $('#descriptionError').show() : $('#descriptionError').hide();
         $.trim(price) == '' ? $('#priceError').show() : $('#priceError').hide();
         $.trim(quantity) == '' ? $('#quantityError').show() : $('#quantityError').hide();
         $.trim(category_ids) == '' ? $('#catError').show() : $('#catError').hide();
      }  
      else{
        $('#nameError').hide();
        $('#descriptionError').hide();
        $('#priceError').hide();
        $('#quantityError').hide();
        $('#catError').hide();
        $('#add-cat-form').submit();
      }
    });   

    $(document).on('change','.parent_id',function() {
        $('#category_ids').val($(this).val());
        var old_category_level = $(this).attr('id').replace('parent_id','');
        $('#category_level').val(old_category_level);
        var category_level = $(this).attr('id').replace('parent_id','');
        category_level++;
        var parent_cat_ids = $(this).val();
        if(parent_cat_ids != "" && parent_cat_ids != 0){
          $.ajax({
            type: "GET",
            url: "{{route('getSubCategories')}}",
            data: {parent_cat_ids:parent_cat_ids},
            success: function(result) {
              
              if(result.categories_array.length > 0){
                  var html = "";
                  $('#parent_cat_id'+category_level).remove();
                  html += "<div id='parent_cat_id"+category_level+"' class='form-group'>";
                  html += "<label class='control-label col-md-3 col-sm-3 col-xs-12'>Sub Category </label>";
                  html += "<div class='col-md-4 col-sm-4 col-xs-12'>";
                  html += "<select id='parent_id"+category_level+"' name='parent_id"+category_level+"' class='parent_id form-control' multiple>";
                  $.each(result.categories_array, function(key,val) {
                      html += "<option value='"+val.id+"'>";
                      html += val.name;
                      html += "</option>";
                  });
                  html += "</select></div></div>";
                  $('#parent_cat_id'+old_category_level).after(html);
              }else{
                  $('#parent_cat_id'+category_level).html('');
              }
            }
        });
       
        }
    });
  

  });
</script>
@endsection
