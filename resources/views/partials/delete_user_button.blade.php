<form action="{{route('user.delete')}}" method="post" ref="deleteUserForm">
    @csrf
    <delete-user-button @delete_user="$refs.deleteUserForm.submit();"></delete-user-button>
</form>