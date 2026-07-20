{{--
    Edit view simply includes the create view with $role pre-bound.
    The create.blade.php template is fully shared — it detects $role via isset().
--}}
@include('admin.roles.create')
