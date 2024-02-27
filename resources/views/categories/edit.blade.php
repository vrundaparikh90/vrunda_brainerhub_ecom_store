@extends('layouts.design')

@section('content')
      <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Categories</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Category</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="add-cat-form" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{route('categories_update',$categoryData->id)}}">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Parent Category
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <select id="parent_id" name="parent_id" class="form-control">
                          <option value="0">Select Parent Category</option>
                          @if(count($parentCategoryData) > 0)
                            @foreach($parentCategoryData as $k => $v)
                              <option value="{{$v->id}}" <?php if($v->id === $categoryData->parent_id) echo 'selected'; ?>>{{$v->name}}</option>
                            @endforeach
                          @endif
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Category Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="name"  class="form-control col-md-7 col-xs-12" value="{{old('name',$categoryData->name)}}">
                          <div id="nameError" class="error" style="display:none; margin-top: 4px;">Please enter category name.</div>
                          @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                          @endif
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="{{route('categories')}}" class="btn btn-primary">Cancel</a>
                          <button type="button" id="save" name="save" class="btn btn-success">Update</button>
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

      if($.trim(name) == ''){
         $.trim(name) == '' ? $('#nameError').show() : $('#nameError').hide();
      }  
      else{
        $('#nameError').hide();
        $('#add-cat-form').submit();
      }
    });
  });
</script>
@endsection
