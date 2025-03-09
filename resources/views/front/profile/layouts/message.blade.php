@if (Session::has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <h4><i class="icon fa fa-ban"></i> Success!</h4>
    <span>{{ Session::get('error') }}</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
    
@if (Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <h4><i class="icon fa fa-check"></i> Success!</h4>
    <span>{{ Session::get('success') }}</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
