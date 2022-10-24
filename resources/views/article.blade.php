@extends('layouts.app')

@section('content')
<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
  <div class="pcoded-wrapper">
      <div class="pcoded-content">
          <div class="pcoded-inner-content">
              <!-- [ breadcrumb ] start -->
              <div class="page-header">
                  <div class="page-block">
                      <div class="row align-items-center">
                          <div class="col-md-12">
                              <div class="page-header-title">
                                  <h5 class="m-b-10">Data Article</h5>
                              </div>
                              <ul class="breadcrumb">
                                  <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="feather icon-home"></i></a></li>                                  
                                  <li class="breadcrumb-item"><a href="#!">Data Article</a></li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- [ breadcrumb ] end -->
              <div class="main-body">
                  <div class="page-wrapper">
                      <!-- [ Main Content ] start -->
                      <div class="row">
                          <!-- [ HTML5 Export button ] start -->
                          <div class="col-sm-12">
                              <div class="card">
                                  <div class="card-header">
                                      <h5>Article</h5>
                                  </div>
                                  <div class="card-block">
                                      <div class="text-right">
                                          <a href="#" class="btn btn-info my-2" id="addArticle">Add Article</a>
                                      </div>
                                      <div class="table-responsive">
                                          <table id="key-act-button" class="display table nowrap table-striped table-hover" style="width:100%">
                                              <thead>
                                                  <tr>
                                                      <th>ID Article</th>
                                                      <th>Title</th>
                                                      <th>Content</th>
                                                      <th>image_url</th>
                                                      <th>ID User</th>
                                                      <th>ID Category</th>
                                                      <th>Action</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                              </tbody>
                                              <tfoot>
                                                  <tr>
                                                      <th>ID Article</th>
                                                      <th>Title</th>
                                                      <th>Content</th>
                                                      <th>image_url</th>
                                                      <th>ID User</th>
                                                      <th>ID Category</th>
                                                      <th>Action</th>
                                                  </tr>
                                              </tfoot>
                                          </table>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- [ HTML5 Export button ] end -->
                      </div>
                      <!-- [ Main Content ] end -->
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
<div class="modal fade" id="modalArticle" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="formTitle">Form Gambar</h4>
                <button type="button" class="close" data-dismiss="modal" id="closeButton" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="formAddArticle" method="POST">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">                        
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control mb-1" id="title" placeholder="Enter Title" name="title"> 
                        <label for="content" class="form-label">Content</label>
                        <input type="text" class="form-control mb-1" id="content" placeholder="Enter Content" name="content">                    
                        <label for="id_user" class="form-label">User</label>
                        <select name="id_user" id="id_user" class="form-control mb-1">
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        <label for="id_category" class="form-label">Category</label>
                        <select name="id_category" id="id_category" class="form-control mb-1">
                            @foreach ($categories as $category)                                
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        <label for="image" class="form-label">File</label>
                        <input type="file" class="form-control mb-1" id="image" placeholder="Select image" name="image">
                    </div>
                    <div class="text-right">
                        <button type="submit" id="submitButton" class="btn btn-success waves-effect waves-light mr-2">Submit</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
@endsection

@push('article')
    <script src="{{url('admin/assets/js/pages/article-crud.js')}}"></script>
    <script src="{{url('admin/assets/plugins/data-tables/js/datatables.min.js')}}"></script>
@endpush