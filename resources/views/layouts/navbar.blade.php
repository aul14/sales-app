@php
    $logo=asset(Storage::url('logo/'));
    $profile=asset(Storage::url('avatar/'));
    $users=\Auth::user();
@endphp
<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
     <a href="{{ route('home') }}">
      <img src="{{$logo.'/logo.png'}}" class="logo-icon" alt="logo icon">
      <h5 class="logo-text">{{(Utility::getValByName('company_name')) ? Utility::getValByName('company_name'): config()}}</h5>
    </a>
  </div>
  <div class="user-details">
   <div class="media align-items-center user-pointer collapsed" data-toggle="collapse" data-target="#user-dropdown">
     <div class="avatar"><img class="mr-3 side-user-img" src="{{(!empty($users->avatar)? $profile.'/'.$users->avatar : $profile.'/avatar.png')}}" alt="user avatar"></div>
      <div class="media-body">
      <h6 class="side-user-name">{{\Auth::user()->name}}</h6>
     </div>
      </div>
    <div id="user-dropdown" class="collapse">
     <ul class="user-setting-menu">
           <li><a href="{{route('profile')}}"><i class="icon-user text-warning"></i>Profile</a></li>
     <li>
         <a href="{{ url('/logout') }}"
            onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><i class="icon-power text-danger"></i>Logout</a></li>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>
     </ul>
    </div>
     </div>
  <ul class="sidebar-menu">
      @permission('manage-module')
     <li class="sidebar-header">Dashboard</li>
     @endpermission
     <li class="{{ set_active(['home'])}}">
        <a href="{{ route('home') }}" class="waves-effect">
          <i class="icon-home icons text-secondary"></i> <span>Home</span>
        </a>
      </li>

   </ul>

  <ul class="sidebar-menu">
      @permission('manage-user|manage-nasabah')
     <li class="sidebar-header">Master</li>
     @endpermission
     
     @permission('manage-user')
     <li class="{{ set_active(['user.index', 'user.create', 'user.edit'])}}">
       <a href="{{ route('user.index') }}" class="waves-effect">
         <i class="icon-user-follow icons text-secondary"></i> <span>Pengguna</span>
       </a>
     </li>
     @endpermission

     @permission('manage-nasabah')
     <li class="{{ set_active(['nasabah.index', 'nasabah.create', 'nasabah.edit'])}}">
       <a href="{{ route('nasabah.index') }}" class="waves-effect">
         <i class="icon-user icons text-secondary"></i> <span>Nasabah</span>
       </a>
     </li>
     @endpermission
   </ul>
   
  <ul class="sidebar-menu">
      @permission('manage-module|manage-setting|manage-permission|manage-role')
     <li class="sidebar-header">System Setting</li>
     @endpermission
    
     @permission('manage-setting')
     <li class="{{ set_active(['company.setting'])}}">
       <a href="{{ route('company.setting') }}" class="waves-effect">
         <i class="icon-settings icons text-secondary"></i> <span>Setting</span>
       </a>
     </li>
     @endpermission
     @permission('manage-module')
     <li class="{{ set_active(['module.index'])}}">
       <a href="{{ route('module.index') }}" class="waves-effect">
         <i class="icon-shield icons text-secondary"></i> <span>Module</span>
       </a>
     </li>
     @endpermission
     @permission('manage-permission')
     <li class="{{ set_active(['permission.index'])}}">
       <a href="{{ route('permission.index') }}" class="waves-effect">
         <i class="icon-social-pinterest icons text-secondary"></i> <span>Permission</span>
       </a>
     </li>
     @endpermission
     @permission('manage-role')
     <li class="{{ set_active(['role.index', 'role.create', 'role.edit'])}}">
       <a href="{{ route('role.index') }}" class="waves-effect">
         <i class="icon-organization icons text-secondary"></i> <span>Role</span>
       </a>
     </li>
     @endpermission
   </ul>

  </div>
