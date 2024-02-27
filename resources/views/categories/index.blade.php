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
                    <h2> <a id="" title="Create Category" href="{{route('categories_create')}}" style="cursor: pointer;"><i class="fa fa-plus-circle"></i></a> Create Category</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @if (Session::has('flash_message_success'))
                        <div class="alert alert-success alert-block customClass">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{!!session('flash_message_success')!!}</strong>
                        </div>
                    @endif
                    <!-- </div> -->
                    <table id="datatable-cat" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th width="">Category Name</th>
                          <th width="">Parent Category Name</th>
                          <th width="10%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($categoryData as $k => $v)
                            <tr id="{{$v['id']}}_li" >
                              <td align="center">{{$v->id}}</td>
                              <td>{{$v->name}}</td>
                              <td>{{$v->parent_category->name ?? '-' }}</td>
                              <td align="center">
                                <a href="{{route('categories_edit',$v->id)}}" class="edit_cat" title="Edit" ><i class="fa fa-pencil text-primary"></i></a>&nbsp;&nbsp;
                                <a id="{{$v->id}}_del" class="delete_cat red" title="Delete" style="cursor: pointer;"><i class="fa fa-close"></i></a>
                              </td>
                            </tr>
                          @endforeach
                      </tbody>
                    </table>
                    </div>
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
<script language="javascript" src="//momentjs.com/downloads/moment.js"></script>
<script language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
  $('document').ready(function() {

    $('#datatable-cat').DataTable({
        'order': [[0, "asc"]],
        'columnDefs': [{
        'targets': [3], /* column index */
        'orderable': false, /* true or false */
      }]
    });

    $(document).on('click','.delete_cat',function() {
          var conf = confirm('Are you sure want to delete this category?');
          if(conf){
            var idArray = $(this).attr('id');
            var id = idArray.split("_");
            $.ajax({
                type: "POST",
                url: "categories/delete/"+id[0],
                data: {id:id[0], "_token": "{{ csrf_token() }}"},
                success: function(data) {
                    location.reload(true);
                }
            });
        }
    });
  });

  
</script>
@endsection
