@if ($message = Session::get('success'))
<div class="alert alert-icon-left alert-arrow-left alert-success alert-dismissible mb-2">
  <span class="alert-icon"><i class="fa fa-check" aria-hidden="true"></i></span>
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('error'))
<div class="alert alert-icon-left alert-arrow-left alert-danger alert-dismissible mb-2">
  <span class="alert-icon"><i class="fa fa-exclamation" aria-hidden="true"></i></span>
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('status'))
<div class="alert alert-info alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>{{ $message }}</strong>
</div>
@endif
