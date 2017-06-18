<style type="text/css">
	#delete {
		padding-left: 6px; 
	}
</style>

<td>
	<a type="button" href="{{ route($page.'.show', $id) }}" class="btn btn-default btn-xs"><i class="fa fa-search"></i></a>
	<a type="button" href="{{ route($page.'.edit', $id) }}" class="btn btn-default btn-xs"><i class="lnr lnr-pencil"></i></a>

	<form id="delete" action="{{ route($page.'.destroy', [$id]) }}" method="POST" class="col-sm-4">
	    <input type="hidden" name="_method" value="DELETE">
	    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	    <button type="button" type='submit' class="btn btn-default btn-xs" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message='{{ $message }}'><i class="lnr lnr-trash"></i></button>
	</form>
</td>

 @include('confirm_delete')
